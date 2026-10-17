import { Link } from 'react-router-dom'
import { money, useStore } from '../services/store'

// Port of resources/views/livewire/shopping-cart.blade.php (ShoppingCart.php)
export default function Cart() {
  const { cartItems, increment, decrement, remove } = useStore()
  const subtotal = cartItems.reduce((s, i) => s + i.total, 0)
  // The original "Proceed to Checkout" link pointed at /checkout-page, which has no route;
  // checkout in the app is per product (/checkout/{id}), so this goes to the first item's checkout.
  const checkoutHref = cartItems.length ? `/checkout/${cartItems[0].product_id}` : '/store'

  return (
    <div>
      <div className="bg-gray-100 min-h-screen py-10 px-4 sm:px-8">
        <div className="max-w-6xl mx-auto">
          <h1 className="text-3xl font-bold mb-6 text-gray-800">Your Shopping Cart</h1>

          <div className="grid md:grid-cols-3 gap-6">
            <div className="md:col-span-2 bg-white rounded-lg shadow-md p-6">
              {cartItems.length ? (
                cartItems.map((item) => (
                  <div key={item.id} className="flex flex-wrap gap-4 items-center justify-between border-b pb-4 mb-4">
                    <div className="flex items-center space-x-4">
                      <img src={item.img_url} className="h-20 w-20 object-contain rounded" alt={item.product_name} />
                      <div>
                        <p className="font-semibold text-gray-800">{item.product_name}</p>
                        <p className="text-gray-500">$ {money(item.price)}</p>
                      </div>
                    </div>

                    <div className="flex items-center space-x-2">
                      <button
                        type="button"
                        onClick={() => decrement(item.id)}
                        className="px-3 py-1 bg-gray-300 text-gray-800 rounded"
                        aria-label={`Decrease ${item.product_name}`}
                      >
                        -
                      </button>
                      <span>{item.quantity}</span>
                      <button
                        type="button"
                        onClick={() => increment(item.id)}
                        className="px-3 py-1 bg-gray-300 text-gray-800 rounded"
                        aria-label={`Increase ${item.product_name}`}
                      >
                        +
                      </button>
                    </div>

                    <div className="text-right">
                      <p className="text-gray-700">$ {money(item.total)}</p>
                      <button type="button" onClick={() => remove(item.id)} className="text-red-500 text-sm mt-1 hover:underline">
                        Remove
                      </button>
                    </div>
                  </div>
                ))
              ) : (
                <p className="text-center text-gray-500">Your cart is empty.</p>
              )}
            </div>

            <div className="bg-white rounded-lg shadow-md p-6 h-fit">
              <h2 className="text-xl font-semibold mb-4">Order Summary</h2>
              <div className="flex justify-between mb-2">
                <span>Subtotal</span>
                <span>$ {money(subtotal)}</span>
              </div>
              <div className="flex justify-between mb-4">
                <span>Shipping</span>
                <span>$0.00</span>
              </div>
              <hr className="mb-4" />
              <div className="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span>$ {money(subtotal)}</span>
              </div>

              <Link
                to={checkoutHref}
                className="mt-6 block bg-black text-white text-center py-2 rounded hover:bg-gray-800 transition"
              >
                Proceed to Checkout
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
