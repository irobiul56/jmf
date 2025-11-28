<template>
    <AppLayout title="Jagoroni Foundation">

    <!-- Hero Section -->
    <section 
      class="py-16 sm:py-24 bg-cover bg-center relative -mt-5" 
      style="background-image: url('storage/images/1.jpeg');"
    >
      <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6 text-center">
          Our Activities
        </h1>
        <div class="w-24 h-1 bg-green-400 mx-auto rounded-full mb-12"></div>
      </div>
    </section>

    <!-- Activities Grid -->
    <section class="py-12 bg-gray-50 sm:py-16 lg:py-20">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          <ActivityCard 
            v-for="activity in activities"
            :key="activity.id"
            :activity="activity"
          />
        </div>
      </div>
    </section>
</AppLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import ActivityCard from '@/Components/ActivityCard.vue'

// Mobile menu state
const isMenuOpen = ref(false)

defineProps({
  activities: {
    type: Array,
    required: true,
    default: () => []
  }
})

// Mobile menu toggle function
const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}

// Scroll handling for sticky header
let lastScrollY = ref(window.scrollY)
const scrollThreshold = 100

const handleScroll = () => {
  const currentScrollY = window.scrollY
  const header = document.querySelector('.sticky-header')
  
  if (!header) return
  
  if (currentScrollY > lastScrollY.value && currentScrollY > scrollThreshold) {
    header.classList.add('header-slide-up')
  } else if (currentScrollY < lastScrollY.value) {
    header.classList.remove('header-slide-up')
  }
  
  lastScrollY.value = currentScrollY
}

// Handle window resize
const handleResize = () => {
  if (window.innerWidth >= 1024 && isMenuOpen.value) {
    isMenuOpen.value = false
  }
}

// Lifecycle hooks
onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  window.addEventListener('resize', handleResize)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  window.removeEventListener('resize', handleResize)
})
</script>

<style scoped>
/* Add any page-specific styles here */
</style>