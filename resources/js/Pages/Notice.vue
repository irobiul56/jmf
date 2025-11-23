<template>
      <AppLayout title="Jagoroni Foundation">
  <div>
    <!-- Hero Section -->
    <section class="py-16 sm:py-24 bg-cover bg-center relative -mt-5" 
             style="background-image: url('storage/images/headerbackground.jpeg');">
      <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6 text-center">
          Notice
        </h1>
        <div class="w-24 h-1 bg-green-400 mx-auto rounded-full mb-12"></div>
      </div>
    </section>

    <!-- Notice Content -->
    <div class="max-w-4xl mx-auto p-4 md:p-8">
      <h3 class="text-xl text-gray-700 font-normal mb-6 pb-2 border-b border-gray-200">
        {{ currentMonthYear }}
      </h3>
      
      <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
        <div class="flex space-x-6">
          <div class="flex flex-col items-center text-center">
            <span class="text-sm font-semibold uppercase text-green-700">{{ notice.dayOfWeek }}</span>
            <span class="text-4xl font-bold text-gray-800 leading-none mt-1">{{ notice.day }}</span>
          </div>
          
          <div class="flex-grow">
            <div class="flex justify-between items-start mb-2">
              <p class="text-base text-gray-600 font-medium">{{ notice.fullDate }}</p>
              <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                {{ notice.category }}
              </span>
            </div>
            
            <h4 class="text-2xl font-bold text-green-700 mb-3 leading-tight">
              {{ notice.title }}
            </h4>
            
            <p class="text-base text-gray-600 leading-relaxed">
              {{ notice.description }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

// Reactive data
const currentMonthYear = ref('August 2025')
const notice = ref({
  dayOfWeek: 'SAT',
  day: '23',
  fullDate: 'August 23, 2025',
  category: 'Course',
  title: 'Teacher Training Program',
  description: '4-month residential/non-residential teacher training at Jagoroni Skill Development Institute – Registration is ongoing.'
})

// Computed properties
const formattedDate = computed(() => {
  const date = new Date()
  return date.toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
  })
})

// Lifecycle hooks
onMounted(() => {
  // Any initialization code can go here
  console.log('Notice component mounted')
})
</script>

<style scoped>
/* Font and custom colors */
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap');

/* Custom brand colors */
.text-green-brand { color: #10B981; } 
.bg-green-brand { background-color: #10B981; }
.hover\:bg-green-brand-dark:hover { background-color: #059669; }
.border-green-brand { border-color: #10B981; }

/* Custom styles for the notice section */
.bg-pattern {
  background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('placeholder-background.jpg'); 
  background-color: #dab15a; 
  background-blend-mode: multiply;
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Tab styles */
.tab-button {
  transition: all 0.2s ease-in-out;
  border-left: 4px solid transparent;
}

.active-tab-style {
  color: #047857;
  background-color: rgba(209, 250, 229, 0.7);
  border-color: #10B981;
  font-weight: 600;
}

.inactive-tab-style {
  color: #374151;
  font-weight: 500;
}

.inactive-tab-style:hover {
  background-color: #f3f4f6;
}
</style>