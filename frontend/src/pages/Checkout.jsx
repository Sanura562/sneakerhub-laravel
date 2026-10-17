import { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom'
import { getProduct, placeOrder } from '../services/api'
import { money, useStore } from '../services/store'
import { NotFound } from './ProductView'

// Port of resources/views/livewire/checkout-page.blade.php (CheckoutPage.php)
export default function Checkout() {
  const { id } = useParams()
  const navigate = useNavigate()
  const { user } = useStore()
  const [product, setProduct] = useState(undefined)
  const [address, setAddress] = useState('')
  const [paymentMethod, setPaymentMethod] = useState('cod')
  const [error, setError] = useState('')

  useEffect(() => {
    getProduct(id).then(setProduct).catch(() => setProduct(null))
  }, [id])

  if (product === undefined) return <div className="bg-gray-100 min-h-screen py-10 px-4 text-center text-gray-500">Loading...</div>
  if (product === null) return <NotFound />

  const subtotal = Number(product.Discount_Price ?? product.Price)
  const shipping = 0
  const total = subtotal + shipping

  const submit = async () => {
    // same rule as $this->validate(['address' => 'required|string|min:5'])
    if (address.trim().length < 5) {
      setError(address.trim() ? 'The address field must be at least 5 characters.' : 'The address field is required.')
      return
    }
    setError('')
    await placeOrder({
      user_id: user?.id ?? null,
      items: [{ ProductID: product._id, Name: product.Name, Price: subtotal }],
      address,
      total,
      payment_method: paymentMethod,
    })
    navigate('/thank-you')
  }

  return (
    <div>
      <div className="bg-gray-100 min-h-screen py-10 px-4 sm:px-8">
        <div className="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 space-y-6">
          <h2 className="text-2xl font-bold text-gray-800">Checkout</h2>

          <div className="border-b pb-4">
            <h3 className="text-lg font-semibold text-gray-700">Product</h3>
            <div className="flex justify-between text-gray-800 mt-2">
              <span>{product.Name ?? 'Unknown Product'}</span>
              <span>${money(subtotal)}</span>
            </div>
          </div>

          <div>
            <label htmlFor="address" className="block font-semibold mb-1">
              Shipping Address
            </label>
            <textarea id="address" value={address} onChange={(e) => setAddress(e.target.value)} className="w-full border rounded p-2" />
            {error && <span className="text-red-500 text-sm">{error}</span>}
          </div>

          <div>
            <label htmlFor="payment" className="block font-semibold mb-1">
              Payment Method
            </label>
            <select id="payment" value={paymentMethod} onChange={(e) => setPaymentMethod(e.target.value)} className="w-full border rounded p-2">
              <option value="cod">Cash on Delivery</option>
              <option value="card">Credit/Debit Card</option>
            </select>
          </div>

          <div className="border-t pt-4">
            <div className="flex justify-between">
              <span>Subtotal</span>
              <span>${money(subtotal)}</span>
            </div>
            <div className="flex justify-between">
              <span>Shipping</span>
              <span>${money(shipping)}</span>
            </div>
            <div className="flex justify-between font-semibold text-lg">
              <span>Total</span>
              <span>${money(total)}</span>
            </div>
          </div>

          <button
            type="button"
            onClick={submit}
            className="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded w-full"
          >
            Place Order
          </button>
        </div>
      </div>
    </div>
  )
}
