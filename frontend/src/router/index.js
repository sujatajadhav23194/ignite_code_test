import { createRouter, createWebHistory } from 'vue-router'
import CategoryPage from '../components/CategoryPage.vue'
import BooksPage from '../components/BooksPage.vue'

const routes = [
  { path: '/', name: 'CategoryPage', component: CategoryPage },
  { path: '/books/:category', name: 'BooksPage', component: BooksPage, props: true },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
