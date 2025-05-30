import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ProductsView from '../views/Products/ProductsView.vue'
// import CreateProductView from '../views/Products/CreateProductView.vue'
import CreateProductView from '../views/Products/CreateProductView.vue'
import CartView from '../views/CartView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },

    {
      path: '/products',
      name: 'products',
      component: ProductsView
    },

    {
      path: '/products/create',
      name: 'createProduct',
      component: CreateProductView
    },

    {
      path: '/cart/:id',
      name: 'cart',
      component: CartView,
      props: true

    },

    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    }
  ]
})

export default router
