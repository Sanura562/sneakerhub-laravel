import { useEffect, useState } from 'react'
import { Link, useParams } from 'react-router-dom'
import { getProduct } from '../services/api'
import { money, useStore } from '../services/store'

// Port of resources/views/livewire/product-view.blade.php (ProductView.php)
export default function ProductView() {
  const { id } = useParams()
  const { addToCart } = useStore()
  const [product, setProduct] = useState(undefined)

  useEffect(() => {
    getProduct(id).then(setProduct).catch(() => setProduct(null))
  }, [id])

  if (product === undefined) return <div className="bg-gray-100 min-h-screen py-10 px-4 text-center text-gray-500">Loading...</div>
  if (product === null) return <NotFound />

  const discounted = product.Discount_Price && product.Discount_Price < product.Price

  return (
    <div className="bg-gray-100 min-h-screen py-10 px-4 sm:px-8">
      <div className="max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden grid md:grid-cols-2 gap-6 p-6">
        {/* Product Image */}
        <div className="flex justify-center items-center">
          <img src={product.img_url} alt={product.Name} className="w-full h-auto object-contain rounded-md" />
        </div>

        {/* Product Info */}
        <div className="flex flex-col justify-between">
          <div>
            <h1 className="text-3xl font-bold text-gray-800 mb-2">{product.Name}</h1>
            <p className="text-gray-500 text-sm mb-1">
              <strong>Brand:</strong> {product.Brand}
            </p>
            <p className="text-gray-500 text-sm mb-1">
              <strong>Category:</strong> {product.Category}
            </p>

            <div className="mt-4 mb-2">
              {discounted ? (
                <>
                  <span className="text-2xl text-indigo-600 font-semibold">${money(product.Discount_Price)}</span>
                  <span className="line-through text-gray-400 text-sm ml-2">${money(product.Price)}</span>
                </>
              ) : (
                <span className="text-2xl text-indigo-600 font-semibold">${money(product.Price)}</span>
              )}
            </div>

            <p className="text-gray-600 leading-relaxed mt-4">{product.Description}</p>
          </div>

          <div className="mt-6">
            <button
              type="button"
              onClick={() => addToCart(product)}
              className="w-full bg-black hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg transition"
            >
              Add to Cart
            </button>
            <Link
              to={`/checkout/${product._id}`}
              className="mt-4 block w-full bg-black hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg text-center transition"
            >
              Buy Now
            </Link>
          </div>
        </div>
      </div>
    </div>
  )
}

export function NotFound() {
  return (
    <div className="min-h-[60vh] flex items-center justify-center bg-gray-100 px-4">
      <div className="text-center">
        <h1 className="text-3xl font-bold text-gray-800 mb-2">404</h1>
        <p className="text-gray-600 mb-6">Not Found</p>
        <Link to="/store" className="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Continue Shopping
        </Link>
      </div>
    </div>
  )
}
