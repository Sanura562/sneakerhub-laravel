import { Link, Navigate, useNavigate } from 'react-router-dom'
import { useStore } from '../services/store'

// Port of resources/views/livewire/user-profile.blade.php (route has ->middleware('auth'))
export function UserProfile() {
  const { user, authReady, signOut } = useStore()
  const navigate = useNavigate()
  if (!authReady) return null
  if (!user) return <Navigate to="/login" replace />

  return (
    <div className="flex items-center justify-center min-h-screen bg-gray-100 px-4">
      <div className="bg-white p-10 rounded-lg shadow-lg text-center w-full max-w-xl">
        <div className="flex flex-col items-center space-y-4">
          <div className="text-5xl text-indigo-600" aria-hidden>
            <svg className="h-14 w-14" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm0 4a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7Zm0 14a8 8 0 0 1-6.2-2.95C7.1 15.4 9.4 14.5 12 14.5s4.9.9 6.2 2.55A8 8 0 0 1 12 20Z" />
            </svg>
          </div>
          <h2 className="text-2xl font-bold text-indigo-600">Welcome Back</h2>
        </div>

        <div className="mt-8 text-left">
          <div className="mb-4">
            <p className="block text-gray-600 text-sm font-semibold mb-1">Full Name</p>
            <p className="text-gray-900 font-medium text-lg">{user.name}</p>
          </div>
          <div className="mb-6">
            <p className="block text-gray-600 text-sm font-semibold mb-1">Email Address</p>
            <p className="text-gray-900 font-medium text-lg">{user.email}</p>
          </div>

          {user.role === 'admin' && (
            <Link to="/admin-dashboard" className="mb-3 block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded">
              Admin Panel
            </Link>
          )}

          <button
            type="button"
            onClick={async () => {
              await signOut()
              navigate('/')
            }}
            className="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded"
          >
            Logout
          </button>
        </div>
      </div>
    </div>
  )
}

// Port of resources/views/thankyou.blade.php
export function ThankYou() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100 px-4">
      <div className="bg-white rounded-lg shadow-lg p-8 max-w-lg text-center">
        <h2 className="text-3xl font-bold text-green-600 mb-4">Thank You!</h2>
        <p className="text-gray-700 mb-6">
          Your order has been placed successfully. We will contact you soon with shipping details.
        </p>
        <Link to="/store" className="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Continue Shopping
        </Link>
      </div>
    </div>
  )
}
