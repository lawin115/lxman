<template>
   <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400" viewBox="0 0 64 64" fill="none" aria-hidden="true">
            <path d="M32 10c9 0 20 7 20 22 0 18-11 22-15 35-2.2 6.4-7.8 6.4-10 0-4-13-15-17-15-35 0-15 11-22 20-22z"
                  stroke="currentColor" stroke-width="2" fill="none"/>
            <circle cx="36" cy="22" r="2.5" class="fill-teal-500/80"/>
          </svg>
</template>

<script setup>
defineProps({
  size:  { type: [Number, String], default: 32 },
  title: { type: String, default: '' },
})
</script>
