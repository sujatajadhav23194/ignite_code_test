<template>
  <div class="container">
    <h1 class="title"> Gutendex Library</h1>
    <div class="grid">
      <button
        v-for="category in categories"
        :key="category"
        class="button"
        @click="goToCategory(category)"
      >
        {{ category }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()
const categories = [
  'Fiction',
  'Drama',
  'Humor',
  'Politics',
  'Philosophy',
  'History',
  'Adventure'
]

const goToCategory = (category) => {
  router.push(`/books/${category}`)
}
</script>
