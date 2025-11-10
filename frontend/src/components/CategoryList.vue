<template>
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    <CategoryButton
      v-for="category in categories"
      :key="category"
      :label="category"
      @click="$emit('category-selected', category)"
    />
  </div>
</template>

<script setup>
import CategoryButton from './CategoryButton.vue'

const categories = [
  'Fiction',
  'Drama',
  'Poetry',
  'Adventure',
  'Science',
  'History',
  'Philosophy',
  'Religion'
]
</script>
