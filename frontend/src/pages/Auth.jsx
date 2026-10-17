import { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { AuthCard, ValidationErrors, buttonCls, checkboxCls, inputCls, labelCls } from '../components/Layout'
import * as api from '../services/api'
import { useStore } from '../services/store'

// Port of resources/views/auth/login.blade.php
export function Login() {
  const navigate = useNavigate()
  const { signIn } = useStore()
  const [form, setForm] = useState({ email: '', password: '' })
  const [errors, setErrors] = useState([])
  const [busy, setBusy] = useState(false)
  const set = (k) => (e) => setForm({ ...form, [k]: e.target.value })

  const submit = async (e) => {
    e.preventDefault()
    setBusy(true)
    try {
      signIn(await api.login(form))
      navigate('/user-profile')
    } catch (err) {
      setErrors(api.errorMessages(err))
    } finally {
      setBusy(false)
    }
  }

  return (
    <AuthCard>
      <ValidationErrors errors={errors} />

      {api.DEMO && (
        <div className="mb-4 font-medium text-sm text-green-600">
          Demo account: demo@sneakerhub.lk / demo1234, or register a new one.
        </div>
      )}

      <form onSubmit={submit}>
        <div>
          <label htmlFor="email" className={labelCls}>Email</label>
          <input id="email" className={`block mt-1 w-full ${inputCls}`} type="email" name="email" value={form.email} onChange={set('email')} required autoFocus autoComplete="username" />
        </div>

        <div className="mt-4">
          <label htmlFor="password" className={labelCls}>Password</label>
          <input id="password" className={`block mt-1 w-full ${inputCls}`} type="password" name="password" value={form.password} onChange={set('password')} required autoComplete="current-password" />
        </div>

        <div className="block mt-4">
          <label htmlFor="remember_me" className="flex items-center">
            <input type="checkbox" id="remember_me" name="remember" className={checkboxCls} />
            <span className="ms-2 text-sm text-gray-600">Remember me</span>
          </label>
        </div>

        <div className="flex items-center justify-end mt-4">
          <Link className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" to="/register">
            Need an account? Register
          </Link>

          <button type="submit" className={`ms-4 ${buttonCls}`} disabled={busy}>
            Log in
          </button>
        </div>
      </form>
    </AuthCard>
  )
}

// Port of resources/views/auth/register.blade.php
export function Register() {
  const navigate = useNavigate()
  const { signIn } = useStore()
  const [form, setForm] = useState({ name: '', email: '', password: '', password_confirmation: '' })
  const [errors, setErrors] = useState([])
  const [busy, setBusy] = useState(false)
  const set = (k) => (e) => setForm({ ...form, [k]: e.target.value })

  const submit = async (e) => {
    e.preventDefault()
    setBusy(true)
    try {
      signIn(await api.register(form))
      navigate('/user-profile')
    } catch (err) {
      setErrors(api.errorMessages(err))
    } finally {
      setBusy(false)
    }
  }

  return (
    <AuthCard>
      <ValidationErrors errors={errors} />

      <form onSubmit={submit}>
        <div>
          <label htmlFor="name" className={labelCls}>Name</label>
          <input id="name" className={`block mt-1 w-full ${inputCls}`} type="text" name="name" value={form.name} onChange={set('name')} required autoFocus autoComplete="name" />
        </div>

        <div className="mt-4">
          <label htmlFor="email" className={labelCls}>Email</label>
          <input id="email" className={`block mt-1 w-full ${inputCls}`} type="email" name="email" value={form.email} onChange={set('email')} required autoComplete="username" />
        </div>

        <div className="mt-4">
          <label htmlFor="password" className={labelCls}>Password</label>
          <input id="password" className={`block mt-1 w-full ${inputCls}`} type="password" name="password" value={form.password} onChange={set('password')} required autoComplete="new-password" />
        </div>

        <div className="mt-4">
          <label htmlFor="password_confirmation" className={labelCls}>Confirm Password</label>
          <input id="password_confirmation" className={`block mt-1 w-full ${inputCls}`} type="password" name="password_confirmation" value={form.password_confirmation} onChange={set('password_confirmation')} required autoComplete="new-password" />
        </div>

        <div className="flex items-center justify-end mt-4">
          <Link className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" to="/login">
            Already registered?
          </Link>

          <button type="submit" className={`ms-4 ${buttonCls}`} disabled={busy}>
            Register
          </button>
        </div>
      </form>
    </AuthCard>
  )
}
