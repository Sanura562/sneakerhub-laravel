import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import { slides } from '../data/products'
import { getProducts } from '../services/api'
import { money } from '../services/store'

// Port of resources/views/home.blade.php (Alpine slider + "Explore Our Shoe Collection")
export default function Home() {
  const [activeSlide, setActiveSlide] = useState(0)
  const [products, setProducts] = useState([])

  useEffect(() => {
    const id = setInterval(() => setActiveSlide((s) => (s + 1) % slides.length), 2000)
    return () => clearInterval(id)
  }, [])

  useEffect(() => {
    getProducts().then(setProducts).catch(() => setProducts([]))
  }, [])

  return (
    <>
      <div className="relative w-full h-[200px] sm:h-[300px] md:h-[400px] lg:h-[500px] overflow-hidden rounded-lg shadow-lg">
        {slides.map((slide, index) => (
          <div
            key={slide}
            className={`absolute inset-0 transition-opacity duration-700 ${activeSlide === index ? 'opacity-100' : 'opacity-0'}`}
          >
            <img src={slide} alt="Slide" className="w-full h-full object-cover" />
          </div>
        ))}
      </div>

      <div className="container mx-auto px-6 py-10">
        <h1 className="text-4xl font-extrabold mb-10 text-center text-gray-900">Explore Our Shoe Collection</h1>

        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
          {products.map((p) => (
            <div
              key={p._id}
              className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
            >
              <div className="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src={p.img_url} alt={p.Name} className="object-contain h-full w-full" />
              </div>
              <div className="p-5">
                <h2 className="text-xl font-semibold mb-2 text-gray-900 truncate">{p.Name}</h2>
                <p className="text-gray-700 mb-1 truncate" title={p.Description}>
                  {p.Description}
                </p>
                <div className="flex items-center justify-between mt-3">
                  <div>
                    <p className="text-lg font-bold text-indigo-600">LKR {money(p.Discount_Price ?? p.Price)}</p>
                    {p.Discount_Price != null && (
                      <p className="text-sm line-through text-gray-400">LKR {money(p.Price)}</p>
                    )}
                  </div>
                  <div className="text-sm text-gray-600 text-right">
                    <p>Brand: {p.Brand}</p>
                    <p>Category: {p.Category}</p>
                  </div>
                </div>
                <Link
                  to={`/product/${p._id}`}
                  className="mt-4 block text-center w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300"
                >
                  View Details
                </Link>
              </div>
            </div>
          ))}
        </div>
      </div>
    </>
  )
}
