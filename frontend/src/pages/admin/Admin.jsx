import { useEffect, useState } from 'react'
import { Link, useNavigate, useParams } from 'react-router-dom'
import * as api from '../../services/api'
import { money } from '../../services/store'

// Sidebar from resources/views/livewire/view-products.blade.php
function Sidebar({ active }) {
  const item = (to, label, key) => (
    <Link to={to} className={`flex items-center px-4 py-2 rounded transition ${active === key ? 'bg-gray-800' : 'hover:bg-gray-800'}`}>
      {label}
    </Link>
  )
  return (
    <aside className="w-full md:w-64 bg-gray-900 text-white p-6 space-y-4">
      <h2 className="text-2xl font-bold">Admin Panel</h2>
      <nav className="flex flex-col space-y-2">
        {item('/admin-dashboard', '📊 Dashboard', 'dash')}
        {item('/addProducts', '➕ Add Product', 'add')}
        {item('/viewProducts', '📦 View Products', 'view')}
      </nav>
    </aside>
  )
}

// Port of resources/views/livewire/admin-dashboard.blade.php
export function AdminDashboard() {
  const [users, setUsers] = useState([])
  const [orders, setOrders] = useState([])
  useEffect(() => {
    api.listUsers().then(setUsers).catch(() => setUsers([]))
    api.listOrders().then(setOrders)
  }, [])

  return (
    <div className="flex flex-col md:flex-row min-h-screen bg-gray-100">
      <Sidebar active="dash" />
      <main className="flex-1 p-8">
        <h1 className="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

        <section className="mb-10">
          <h2 className="text-xl font-semibold text-black mb-3">Users</h2>
          <div className="bg-white shadow rounded-lg overflow-hidden">
            <ul>
              {users.length ? (
                users.map((u) => (
                  <li key={u.id ?? u.email} className="border-b border-gray-200 px-6 py-3 hover:bg-gray-50">
                    {u.name} - <span className="text-black">{u.email}</span>
                  </li>
                ))
              ) : (
                <li className="px-6 py-4 text-gray-500">No users found.</li>
              )}
            </ul>
          </div>
        </section>

        <section>
          <h2 className="text-xl font-semibold text-gray-700 mb-3">Orders</h2>
          <div className="bg-white shadow rounded-lg overflow-hidden">
            <ul>
              {orders.length ? (
                orders.map((o) => (
                  <li key={o.id} className="border-b border-gray-200 px-6 py-3 hover:bg-gray-50">
                    Order ID: {o.id} - Amount: <span className="text-green-600 font-semibold">${o.total}</span>
                  </li>
                ))
              ) : (
                <li className="px-6 py-4 text-gray-500">No orders yet.</li>
              )}
            </ul>
          </div>
        </section>
      </main>
    </div>
  )
}

// Port of resources/views/livewire/view-products.blade.php
export function ViewProducts() {
  const [products, setProducts] = useState([])
  const load = () => api.getProducts().then(setProducts).catch(() => setProducts([]))
  useEffect(() => {
    load()
  }, [])

  return (
    <div className="flex flex-col md:flex-row min-h-screen bg-gray-100">
      <Sidebar active="view" />
      <main className="flex-1 p-8 min-w-0">
        <h1 className="text-3xl font-bold text-gray-800 mb-6">All Products</h1>

        <div className="overflow-x-auto bg-white shadow-md rounded-lg">
          <table className="min-w-full">
            <thead className="bg-gray-100 text-left text-gray-700">
              <tr>
                <th className="py-3 px-6">Name</th>
                <th className="py-3 px-6">Brand</th>
                <th className="py-3 px-6">Price</th>
                <th className="py-3 px-6">Actions</th>
              </tr>
            </thead>
            <tbody>
              {products.length ? (
                products.map((p) => (
                  <tr key={p._id} className="border-b hover:bg-gray-50">
                    <td className="py-4 px-6">{p.Name}</td>
                    <td className="py-4 px-6">{p.Brand}</td>
                    <td className="py-4 px-6 font-medium text-green-600">${money(p.Price)}</td>
                    <td className="py-4 px-6 space-x-2 whitespace-nowrap">
                      <Link to={`/editProduct/${p._id}`} className="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update
                      </Link>
                      <button
                        type="button"
                        onClick={async () => {
                          if (!window.confirm('Are you sure?')) return
                          await api.deleteProduct(p._id)
                          load()
                        }}
                        className="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan={4} className="py-4 px-6 text-center text-gray-500">
                    No products found.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </main>
    </div>
  )
}

const FIELDS = [
  ['ProductID', 'Product ID', 'text', true],
  ['Name', 'Name', 'text', true],
  ['Description', 'Description', 'textarea', false],
  ['Price', 'Price', 'number', true],
  ['StockQuantity', 'Stock Quantity', 'number', true],
  ['Brand', 'Brand', 'text', false],
  ['Category', 'Category', 'text', false],
  ['Discount_Price', 'Discount Price', 'number', false],
  ['img_url', 'Image URL', 'url', false],
]

// Port of resources/views/addProducts.blade.php (also used for editing, like the original)
export function ProductForm() {
  const { id } = useParams()
  const navigate = useNavigate()
  const editing = Boolean(id)
  const [form, setForm] = useState(Object.fromEntries(FIELDS.map(([k]) => [k, ''])))
  const [errors, setErrors] = useState([])

  useEffect(() => {
    if (editing) api.getProduct(id).then((p) => setForm((f) => ({ ...f, ...p }))).catch(() => navigate('/viewProducts'))
  }, [editing, id, navigate])

  const submit = async (e) => {
    e.preventDefault()
    const num = (v) => (v === '' || v == null ? null : Number(v))
    const data = {
      ...form,
      Price: num(form.Price),
      StockQuantity: num(form.StockQuantity),
      Discount_Price: num(form.Discount_Price),
    }
    try {
      if (editing) await api.updateProduct(id, data)
      else await api.createProduct(data)
      navigate('/viewProducts')
    } catch (err) {
      setErrors(api.errorMessages(err))
    }
  }

  const cls = 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700'

  return (
    <div className="container mx-auto px-4 py-6">
      <h2 className="text-2xl font-bold mb-4">{editing ? 'Edit Product' : 'Add New Product'}</h2>

      {errors.length > 0 && (
        <div className="bg-red-100 text-red-700 p-3 rounded mb-4">
          <ul className="list-disc pl-5">
            {errors.map((e) => (
              <li key={e}>{e}</li>
            ))}
          </ul>
        </div>
      )}

      <form onSubmit={submit}>
        {FIELDS.map(([name, label, type, required]) => (
          <div key={name} className={name === 'img_url' ? 'mb-6' : 'mb-4'}>
            <label htmlFor={name} className="block text-gray-700">
              {label}
            </label>
            {type === 'textarea' ? (
              <textarea id={name} name={name} value={form[name] ?? ''} onChange={(e) => setForm({ ...form, [name]: e.target.value })} className={cls} />
            ) : (
              <input
                id={name}
                type={type}
                step={name.includes('Price') ? '0.01' : undefined}
                name={name}
                value={form[name] ?? ''}
                onChange={(e) => setForm({ ...form, [name]: e.target.value })}
                className={cls}
                required={required}
              />
            )}
          </div>
        ))}

        <div>
          <button type="submit" className="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {editing ? 'Update Product' : 'Add Product'}
          </button>
        </div>
      </form>
    </div>
  )
}
