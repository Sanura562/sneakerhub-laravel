import { createContext, useCallback, useContext, useEffect, useMemo, useState } from 'react'
import * as api from './api'

// Auth + cart state shared by every page. The cart follows CartPage.php / ShoppingCart.php:
// items of { id, product_id, product_name, img_url, price, quantity, total }.
const StoreContext = createContext(null)

const loadCart = () => {
  try {
    return JSON.parse(localStorage.getItem('shub_cart')) || []
  } catch {
    return []
  }
}

export function StoreProvider({ children }) {
  const [user, setUser] = useState(null)
  const [authReady, setAuthReady] = useState(false)
  const [cartItems, setCartItems] = useState(loadCart)
  const [flash, setFlash] = useState(null)

  useEffect(() => {
    const t = localStorage.getItem('shub_token')
    if (!t) {
      setAuthReady(true)
      return
    }
    api
      .me(t)
      .then((r) => setUser(r.user))
      .catch(() => localStorage.removeItem('shub_token'))
      .finally(() => setAuthReady(true))
  }, [])

  useEffect(() => {
    try {
      localStorage.setItem('shub_cart', JSON.stringify(cartItems))
    } catch {
      /* ignore */
    }
  }, [cartItems])

  // Same 3 second toast the Livewire store page shows from session('message').
  const notify = useCallback((message) => {
    setFlash(message)
    window.clearTimeout(notify.t)
    notify.t = window.setTimeout(() => setFlash(null), 3000)
  }, [])

  const signIn = useCallback(({ token, user }) => {
    localStorage.setItem('shub_token', token)
    setUser(user)
  }, [])

  const signOut = useCallback(async () => {
    await api.logout()
    localStorage.removeItem('shub_token')
    setUser(null)
  }, [])

  const addToCart = useCallback(
    (product) => {
      const price = Number(product.Discount_Price ?? product.Price)
      setCartItems((items) => {
        const existing = items.find((i) => i.product_id === String(product._id))
        if (existing) {
          return items.map((i) =>
            i === existing ? { ...i, quantity: i.quantity + 1, total: (i.quantity + 1) * i.price } : i,
          )
        }
        return [
          ...items,
          {
            id: crypto.randomUUID?.() ?? String(Date.now()),
            product_id: String(product._id),
            product_name: product.Name,
            img_url: product.img_url,
            price,
            quantity: 1,
            total: price,
          },
        ]
      })
      notify('Product added to cart!')
    },
    [notify],
  )

  const increment = (id) =>
    setCartItems((items) => items.map((i) => (i.id === id ? { ...i, quantity: i.quantity + 1, total: (i.quantity + 1) * i.price } : i)))

  const decrement = (id) =>
    setCartItems((items) =>
      items.flatMap((i) => {
        if (i.id !== id) return [i]
        if (i.quantity <= 1) return []
        return [{ ...i, quantity: i.quantity - 1, total: (i.quantity - 1) * i.price }]
      }),
    )

  const remove = (id) => setCartItems((items) => items.filter((i) => i.id !== id))
  const clearCart = () => setCartItems([])

  const value = useMemo(
    () => ({ user, authReady, signIn, signOut, cartItems, addToCart, increment, decrement, remove, clearCart, flash, notify }),
    // eslint-disable-next-line react-hooks/exhaustive-deps
    [user, authReady, cartItems, flash],
  )

  return <StoreContext.Provider value={value}>{children}</StoreContext.Provider>
}

export const useStore = () => useContext(StoreContext)

export const money = (n) =>
  Number(n || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
