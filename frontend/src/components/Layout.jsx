import { useState } from 'react'
import { Link, Outlet } from 'react-router-dom'
import Footer from './Footer'
import { DEMO } from '../services/api'
import { useStore } from '../services/store'

// Port of resources/views/layouts/header.blade.php
export function Header() {
  const { user, cartItems } = useStore()
  const count = cartItems.reduce((n, i) => n + i.quantity, 0)
  return (
    <nav className="bg-white shadow-md fixed top-0 inset-x-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          {/* Logo */}
          <div className="flex items-center">
            <Link to="/" className="font-semibold text-lg text-gray-800">
              SneakerHub
            </Link>
          </div>

          {/* Nav Links (centered) */}
          <div className="hidden md:flex flex-1 justify-center space-x-6">
            <Link to="/" className="text-gray-700 hover:text-blue-600">
              Home
            </Link>
            <Link to="/store" className="text-gray-700 hover:text-blue-600">
              All Shoes
            </Link>
            <Link to="/cart" className="flex items-center text-sm text-gray-700 hover:text-blue-600">
              {/* The original used a vecteezy.com image, which blocks loading from other sites. */}
              <svg className="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" role="img" aria-label="Cart">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
              </svg>
              {count > 0 && <span>{count}</span>}
            </Link>
          </div>

          {/* Right Buttons */}
          <div className="flex items-center space-x-4">
            {!user && (
              <Link
                to="/login"
                className="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition"
              >
                Login
              </Link>
            )}
            <Link
              to="/user-profile"
              className="bg-gray-800 text-white font-semibold px-4 py-2 rounded-md hover:bg-gray-900 transition"
            >
              Profile
            </Link>
          </div>
        </div>

        {/* Small screens: the original hid these links below md; shown here so the store is usable on phones. */}
        <div className="flex md:hidden justify-center space-x-6 pb-3 text-sm">
          <Link to="/" className="text-gray-700 hover:text-blue-600">Home</Link>
          <Link to="/store" className="text-gray-700 hover:text-blue-600">All Shoes</Link>
          <Link to="/cart" className="text-gray-700 hover:text-blue-600">Cart{count > 0 ? ` (${count})` : ''}</Link>
        </div>
      </div>
    </nav>
  )
}

/** Toast from storepage.blade.php (session('message')). */
export function Flash() {
  const { flash } = useStore()
  if (!flash) return null
  return (
    <div
      role="status"
      className="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50 transition-opacity duration-300"
    >
      {flash}
    </div>
  )
}

/** Small notice so visitors know this hosted copy runs without the PHP backend. */
export function DemoBadge() {
  const [hidden, setHidden] = useState(() => {
    try {
      return sessionStorage.getItem('shub_demo_badge') === 'hidden'
    } catch {
      return false
    }
  })
  if (!DEMO || hidden) return null
  const close = () => {
    setHidden(true)
    try {
      sessionStorage.setItem('shub_demo_badge', 'hidden')
    } catch {
      /* ignore */
    }
  }
  return (
    <div className="fixed bottom-3 left-3 z-50 flex max-w-[16rem] items-start gap-2 rounded-md bg-gray-900/90 px-3 py-2 text-xs text-gray-100 shadow-lg">
      <p>
        Demo: data is saved in your browser.{' '}
        <a href="https://github.com/Sanura562/sneakerhub-laravel" className="underline" target="_blank" rel="noreferrer">
          Laravel source
        </a>
      </p>
      <button type="button" onClick={close} aria-label="Hide demo notice" className="-mr-1 px-1 leading-none text-gray-300 hover:text-white">
        ×
      </button>
    </div>
  )
}

// Port of resources/views/layouts/app.blade.php
export function AppLayout() {
  return (
    <div className="min-h-screen bg-gray-100 pt-24">
      <Header />
      <main>
        <Outlet />
      </main>
      <Footer />
      <Flash />
      <DemoBadge />
    </div>
  )
}

// Port of resources/views/components/authentication-card.blade.php (+ guest layout)
export function AuthCard({ children }) {
  return (
    <div className="font-sans text-gray-900 antialiased">
      <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
          <Link to="/">
            <svg className="size-16" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z"
                fill="#6875F5"
              />
              <path
                d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z"
                fill="#6875F5"
              />
            </svg>
          </Link>
        </div>

        <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">{children}</div>
      </div>
      <DemoBadge />
    </div>
  )
}

/** Jetstream <x-validation-errors /> */
export function ValidationErrors({ errors }) {
  if (!errors?.length) return null
  return (
    <div className="mb-4">
      <div className="font-medium text-red-600">Whoops! Something went wrong.</div>
      <ul className="mt-3 list-disc list-inside text-sm text-red-600">
        {errors.map((e) => (
          <li key={e}>{e}</li>
        ))}
      </ul>
    </div>
  )
}

/** Jetstream <x-label>, <x-input>, <x-button>, <x-checkbox> */
export const labelCls = 'block font-medium text-sm text-gray-700'
export const inputCls = 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'
export const buttonCls =
  'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'
export const checkboxCls = 'rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500'
