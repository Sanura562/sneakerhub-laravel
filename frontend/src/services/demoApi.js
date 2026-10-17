// Demo backend: mirrors the Laravel API responses using the browser's localStorage,
// so the frontend can be hosted on its own (e.g. Cloudflare Pages) with no PHP server.
import { seedProducts } from '../data/products'

const KEY = {
  products: 'shub_demo_products',
  users: 'shub_demo_users',
  orders: 'shub_demo_orders',
}

const read = (k, fallback) => {
  try {
    const v = localStorage.getItem(k)
    return v ? JSON.parse(v) : fallback
  } catch {
    return fallback
  }
}
const write = (k, v) => {
  try {
    localStorage.setItem(k, JSON.stringify(v))
  } catch {
    /* storage full or blocked: demo keeps working for this page view */
  }
}

const DEMO_USER = { id: 'demo', name: 'Demo User', email: 'demo@sneakerhub.lk', password: 'demo1234', role: 'admin' }

const fail = (status, data) => {
  const err = new Error(data.error || 'Request failed')
  err.response = { status, data }
  return err
}
const publicUser = ({ password: _password, ...u }) => u
const token = (u) => `demo.${btoa(u.email)}`

// ---------- products (apiController) ----------

export async function getProducts() {
  return read(KEY.products, seedProducts)
}

export async function getProduct(id) {
  const p = (await getProducts()).find((x) => String(x._id) === String(id))
  if (!p) throw fail(404, { message: 'Product not found' })
  return p
}

export async function createProduct(data) {
  const list = await getProducts()
  if (list.some((p) => p.ProductID === data.ProductID)) {
    throw fail(422, { errors: { ProductID: ['The product i d has already been taken.'] } })
  }
  const product = { ...data, _id: String(Date.now()) }
  write(KEY.products, [...list, product])
  return product
}

export async function updateProduct(id, data) {
  const list = await getProducts()
  const i = list.findIndex((p) => String(p._id) === String(id))
  if (i < 0) throw fail(404, { message: 'Product not found' })
  list[i] = { ...list[i], ...data }
  write(KEY.products, list)
  return list[i]
}

export async function deleteProduct(id) {
  write(KEY.products, (await getProducts()).filter((p) => String(p._id) !== String(id)))
  return { message: 'Product deleted successfully' }
}

// ---------- auth (AuthController) ----------

const users = () => [DEMO_USER, ...read(KEY.users, [])]

export async function register({ name, email, password, password_confirmation }) {
  const errors = {}
  if (!name) errors.name = ['The name field is required.']
  if (!email || !/^\S+@\S+\.\S+$/.test(email)) errors.email = ['The email field must be a valid email address.']
  else if (users().some((u) => u.email === email)) errors.email = ['The email has already been taken.']
  if (!password || password.length < 6) errors.password = ['The password field must be at least 6 characters.']
  else if (password !== password_confirmation) errors.password = ['The password field confirmation does not match.']
  if (Object.keys(errors).length) throw fail(422, { errors })

  const user = { id: String(Date.now()), name, email, password, role: 'user' }
  write(KEY.users, [...read(KEY.users, []), user])
  return { token: token(user), user: publicUser(user) }
}

export async function login({ email, password }) {
  const user = users().find((u) => u.email === email && u.password === password)
  if (!user) throw fail(401, { error: 'Invalid credentials' })
  return { token: token(user), user: publicUser(user) }
}

export async function me(t) {
  const email = t?.startsWith('demo.') ? atob(t.slice(5)) : null
  const user = users().find((u) => u.email === email)
  if (!user) throw fail(401, { error: 'Token invalid or expired' })
  return { user: publicUser(user) }
}

export async function listUsers() {
  return users().map(publicUser)
}

// ---------- orders (CheckoutPage::placeOrder) ----------

export async function placeOrder(order) {
  const saved = { ...order, id: String(Date.now()), status: 'Pending' }
  write(KEY.orders, [...read(KEY.orders, []), saved])
  return saved
}

export async function listOrders() {
  return read(KEY.orders, [])
}
