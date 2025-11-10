<template>
  <div class="container">
    <h1 class="title">{{ category }} Books</h1>

    <input
      type="text"
      class="search-bar"
      v-model="searchQuery"
      placeholder="Search by title or author..."
      @input="fetchBooks"
    />

    <div class="books-grid">
      <div
        v-for="book in books"
        :key="book.id"
        class="book-card"
        @click="openBook(book)"
      >
        <img
          v-if="book.cover_image"
          :src="book.cover_image"
          alt="cover"
          class="book-cover"
        />
        <div class="book-title">{{ book.title }}</div>
        <div class="book-author">
          {{ book.author || 'Unknown Author' }}
        </div>
      </div>
    </div>

    <div v-if="loading" class="loading">Loading more books...</div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, onBeforeUnmount } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const category = ref(route.params.category)
const books = ref([])
const page = ref(1)
const loading = ref(false)
const searchQuery = ref('')

// change this to your Laravel API endpoint
const API_BASE = 'http://localhost:8000/api'

const fetchBooks = async () => {
  loading.value = true
  try {
    const response = await axios.get(`${API_BASE}/books`, {
      params: {
        category: category.value,
        page: page.value,
        search: searchQuery.value || ''
      }
    })
    const newBooks = response.data.data || response.data
    if (page.value === 1) books.value = newBooks
    else books.value.push(...newBooks)
  } catch (error) {
    console.error('Error fetching books:', error)
  } finally {
    loading.value = false
  }
}

const handleScroll = () => {
  const bottom =
    window.innerHeight + window.scrollY >= document.body.offsetHeight - 50
  if (bottom && !loading.value) {
    page.value++
    fetchBooks()
  }
}

const openBook = (book) => {
  if (book.book_url) window.open(book.book_url, '_blank')
  else alert('No viewable version available')
}

onMounted(() => {
  fetchBooks()
  window.addEventListener('scroll', handleScroll)
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll)
})

watch(searchQuery, () => {
  page.value = 1
  fetchBooks()
})
</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
  text-align: center;
}

.title {
  font-size: 2rem;
  margin-bottom: 1rem;
  font-weight: 600;
}

.search-bar {
  width: 60%;
  padding: 0.75rem;
  margin-bottom: 2rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
}

.books-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 1.5rem;
}

.book-card {
  background: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  padding: 1rem;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.1s ease-in;
}

.book-card:hover {
  transform: scale(1.03);
}

.book-cover {
  width: 100%;
  height: 240px;
  object-fit: cover;
  border-radius: 8px;
}

.book-title {
  font-weight: 600;
  margin-top: 0.5rem;
  font-size: 1rem;
}

.book-author {
  color: #555;
  font-size: 0.9rem;
}

.loading {
  margin-top: 2rem;
  color: #666;
}
</style>
