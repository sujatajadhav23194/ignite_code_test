<template>
  <button
    class="p-4 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition"
    @click="$emit('click')"
  >
    {{ label }}
  </button>
</template>

<script setup>
defineProps({
  label: String
})
</script>
