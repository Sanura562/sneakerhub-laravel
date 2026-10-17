import { useEffect } from 'react'
import { BrowserRouter, Route, Routes, useLocation } from 'react-router-dom'
import { AppLayout, DemoBadge } from './components/Layout'
import { StoreProvider } from './services/store'
import Home from './pages/Home'
import Store from './pages/Store'
import ProductView, { NotFound } from './pages/ProductView'
import Cart from './pages/Cart'
import Checkout from './pages/Checkout'
import { Login, Register } from './pages/Auth'
import { ThankYou, UserProfile } from './pages/Account'
import { AdminDashboard, ProductForm, ViewProducts } from './pages/admin/Admin'

function ScrollToTop() {
  const { pathname } = useLocation()
  useEffect(() => {
    window.scrollTo(0, 0)
  }, [pathname])
  return null
}

// Same URLs as routes/web.php
export default function App() {
  return (
    <StoreProvider>
      <BrowserRouter>
        <ScrollToTop />
        <Routes>
          <Route element={<AppLayout />}>
            <Route path="/" element={<Home />} />
            <Route path="/store" element={<Store />} />
            <Route path="/storepage" element={<Store />} />
            <Route path="/product/:id" element={<ProductView />} />
            <Route path="/cart" element={<Cart />} />
            <Route path="/checkout/:id" element={<Checkout />} />
            <Route path="/thank-you" element={<ThankYou />} />
            <Route path="/user-profile" element={<UserProfile />} />
            <Route path="/addProducts" element={<ProductForm />} />
            <Route path="/editProduct/:id" element={<ProductForm />} />
            <Route path="*" element={<NotFound />} />
          </Route>
          {/* The admin pages are full-page Livewire components without the store header/footer. */}
          <Route path="/admin-dashboard" element={<><AdminDashboard /><DemoBadge /></>} />
          <Route path="/viewProducts" element={<><ViewProducts /><DemoBadge /></>} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
        </Routes>
      </BrowserRouter>
    </StoreProvider>
  )
}
