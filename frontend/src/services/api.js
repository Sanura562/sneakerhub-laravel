import axios from 'axios'
import * as demo from './demoApi'

// Demo mode (VITE_DEMO_MODE=true at build time): use built-in data and the browser's
// storage instead of calling the Laravel backend. See demoApi.js.
export const DEMO = import.meta.env.VITE_DEMO_MODE === 'true'

// Laravel app (routes/api.php). Locally that is `php artisan serve` on port 8000.
const api = axios.create({
  baseURL: `${import.meta.env.VITE_API_URL || 'http://localhost:8000'}/api`,
  headers: { Accept: 'application/json' },
})

api.interceptors.request.use((config) => {
  const t = localStorage.getItem('shub_token')
  if (t) config.headers.Authorization = `Bearer ${t}`
  return config
})

// ---------- Products: apiController ----------

export async function getProducts() {
  if (DEMO) return demo.getProducts()
  return (await api.get('/products')).data
}

export async function getProduct(id) {
  if (DEMO) return demo.getProduct(id)
  return (await api.get(`/products/${id}`)).data
}

export async function createProduct(data) {
  if (DEMO) return demo.createProduct(data)
  return (await api.post('/products', data)).data
}

export async function updateProduct(id, data) {
  if (DEMO) return demo.updateProduct(id, data)
  return (await api.put(`/products/${id}`, data)).data
}

export async function deleteProduct(id) {
  if (DEMO) return demo.deleteProduct(id)
  return (await api.delete(`/products/${id}`)).data
}

// ---------- Auth: AuthController (JWT) ----------

export async function register(form) {
  if (DEMO) return demo.register(form)
  return (await api.post('/register', form)).data
}

export async function login(form) {
  if (DEMO) return demo.login(form)
  return (await api.post('/login', form)).data
}

export async function me(token) {
  if (DEMO) return demo.me(token)
  return (await api.get('/me')).data
}

export async function logout() {
  if (DEMO) return
  try {
    await api.post('/logout')
  } catch {
    /* token already invalid: nothing to do */
  }
}

export async function listUsers() {
  if (DEMO) return demo.listUsers()
  return (await api.get('/users')).data
}

// ---------- Orders ----------
// The Laravel app saves orders from the Livewire CheckoutPage component and has no
// JSON endpoint for them, so the frontend keeps orders in the browser in both modes.

export const placeOrder = demo.placeOrder
export const listOrders = demo.listOrders

/** Turns a Laravel validation / auth error into a list of messages. */
export function errorMessages(err) {
  const data = err?.response?.data
  if (data?.errors) return Object.values(data.errors).flat()
  if (data?.error) return [data.error]
  if (data?.message) return [data.message]
  return ['Could not reach the server. Is the Laravel app running?']
}
