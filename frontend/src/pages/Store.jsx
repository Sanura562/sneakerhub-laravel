import { useEffect, useMemo, useState } from 'react'
import { Link } from 'react-router-dom'
import { getProducts } from '../services/api'
import { money, useStore } from '../services/store'

const limit = (s = '', n = 100) => (s.length > n ? `${s.slice(0, n)}...` : s)

// Port of resources/views/livewire/storepage.blade.php (Storepage.php)
export default function Store() {
  const { addToCart } = useStore()
  const [products, setProducts] = useState(null)
  const [filter, setFilter] = useState('all')

  useEffect(() => {
    getProducts().then(setProducts).catch(() => setProducts([]))
  }, [])

  const categories = useMemo(() => [...new Set((products ?? []).map((p) => p.Category).filter(Boolean))], [products])
  const shown = (products ?? []).filter((p) => filter === 'all' || p.Category === filter)

  return (
    <div>
      <div className="container mx-auto px-4 mt-6">
        <div className="flex justify-start items-center">
          <label htmlFor="category" className="mr-2 font-semibold text-gray-700">
            Filter:
          </label>
          <select
            value={filter}
            onChange={(e) => setFilter(e.target.value)}
            id="category"
            name="category"
            className="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
            <option value="all">All</option>
            {categories.map((c) => (
              <option key={c} value={c}>
                {c}
              </option>
            ))}
          </select>
        </div>
      </div>

      <main className="container mx-auto px-4 py-8 flex-grow">
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
          {products === null ? (
            <p className="col-span-full text-center text-gray-500">Loading...</p>
          ) : shown.length ? (
            shown.map((product) => (
              <Link key={product._id} to={`/product/${product._id}`} className="block">
                <div className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                  <img src={product.img_url} alt={product.Name} className="w-full h-64 object-contain bg-white" />
                  <div className="p-4">
                    <h3 className="text-lg font-semibold text-gray-800">{product.Name}</h3>
                    <p className="text-gray-600 text-sm mt-1">Brand: {product.Brand ?? 'N/A'}</p>
                    <p className="text-gray-600 text-sm">{product.Category ?? 'N/A'}</p>
                    <p className="text-gray-600 text-sm">
                      Discount: {product.Discount_Price ? `$${money(product.Discount_Price)}` : 'N/A'}
                    </p>
                    <p className="text-gray-500 text-sm mt-2">{limit(product.Description)}</p>
                    <p className="text-indigo-600 font-bold mt-1">
                      {product.Price ? `LKR ${money(product.Price)}` : 'N/A'}
                    </p>
                    <div className="mt-4 text-right">
                      <button
                        type="button"
                        onClick={(e) => {
                          e.preventDefault()
                          addToCart(product)
                        }}
                        className="flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
                      >
                        Add to Cart
                      </button>
                    </div>
                  </div>
                </div>
              </Link>
            ))
          ) : (
            <p className="col-span-full text-center text-gray-500">No products available.</p>
          )}
        </div>
      </main>
    </div>
  )
}
