<template>
<AppLayout title="Gallery">
  <div>
    <!-- Hero Section -->
    <section 
      class="py-16 sm:py-24 bg-cover bg-center relative -mt-5" 
      :style="{ backgroundImage: `url('storage/images/${heroImage}')` }"
    >
      <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6 text-center">
          Gallery
        </h1>
        <div class="w-24 h-1 bg-green-400 mx-auto rounded-full mb-12"></div>
      </div>
    </section>

    <!-- Gallery Content -->
    <div class="p-4 sm:p-8 bg-gray-50 min-h-screen">
      <div class="max-w-5xl mx-auto">
        
        <!-- Tab Switcher -->
        <div class="flex justify-center mb-8">
          <div class="flex p-1 bg-white rounded-full shadow-md">
            <button 
              class="px-6 py-2 rounded-full text-sm font-semibold transition duration-150 shadow-lg"
              :class="activeTab === 'picture' 
                ? 'text-white bg-green-500 hover:bg-green-600' 
                : 'text-gray-700 hover:text-green-500'"
              @click="setActiveTab('picture')"
            >
              Picture
            </button>
            <button 
              class="px-6 py-2 rounded-full text-sm font-semibold transition duration-150"
              :class="activeTab === 'video' 
                ? 'text-white bg-green-500 hover:bg-green-600' 
                : 'text-gray-700 hover:text-green-500'"
              @click="setActiveTab('video')"
            >
              Video
            </button>
          </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
          
          <!-- Category Sidebar -->
          <div class="w-full lg:w-1/4 bg-white p-2 rounded-lg shadow-xl h-fit">
            <ul class="space-y-2">
              <li 
                v-for="category in categories" 
                :key="category.id"
                class="p-3 rounded-md text-sm font-medium cursor-pointer transition duration-150"
                :class="activeCategory === category.id 
                  ? 'text-green-700 bg-green-50/70 border-l-4 border-green-500 font-semibold' 
                  : 'text-gray-700 hover:bg-gray-100'"
                @click="setActiveCategory(category.id)"
              >
                {{ category.name }}
              </li>
            </ul>
          </div>

          <!-- Gallery Grid -->
          <div class="w-full lg:w-3/4">
            <!-- Picture Gallery -->
            <div v-if="activeTab === 'picture'" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div 
                v-for="(image, index) in filteredImages" 
                :key="index"
                class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-[1.02] transition duration-300 cursor-pointer"
                @click="openLightbox(image)"
              >
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                  <img 
                    :src="image.src" 
                    :alt="image.alt"
                    class="w-full h-full object-cover"
                  >
                </div>
              </div>
            </div>

            <!-- Video Gallery -->
            <div v-if="activeTab === 'video'" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div 
                v-for="(video, index) in filteredVideos" 
                :key="index"
                class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-[1.02] transition duration-300 cursor-pointer"
              >
                <div class="w-full h-48 bg-gray-800 flex items-center justify-center relative">
                  <div class="text-white text-center">
                    <i class="fas fa-play text-4xl mb-2 opacity-80"></i>
                    <p class="text-sm">{{ video.title }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Lightbox Modal -->
    <div 
      v-if="showLightbox" 
      class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4"
      @click="closeLightbox"
    >
      <div class="relative max-w-4xl max-h-full">
        <button 
          class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition duration-150"
          @click="closeLightbox"
        >
          <i class="fas fa-times"></i>
        </button>
        <img 
          :src="currentImage.src" 
          :alt="currentImage.alt"
          class="max-w-full max-h-full object-contain"
        >
      </div>
    </div>
  </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

// Reactive data
const activeTab = ref('picture')
const activeCategory = ref('all')
const showLightbox = ref(false)
const currentImage = ref({ src: '', alt: '' })
const lastScrollY = ref(0)
const scrollThreshold = 100

// Hero image
const heroImage = ref('1.jpeg')

// Categories data
const categories = ref([
  { id: 'all', name: 'All' },
  { id: 'flood', name: 'Flood' },
  { id: 'food-distribution', name: 'Food Distribution' },
  { id: 'self-reliance', name: 'Self Reliance' },
  { id: 'qurbani', name: 'Qurbani' },
  { id: 'winter-relief', name: 'Winter Relief' }
])

// Images data
const images = ref([
  { id: 1, src: 'storage/images/1.jpeg', alt: 'Gallery Image 1', category: 'all' },
  { id: 2, src: 'storage/images/3.jpeg', alt: 'Gallery Image 2', category: 'all' },
  { id: 3, src: 'storage/images/4.jpeg', alt: 'Gallery Image 3', category: 'all' },
  { id: 4, src: 'storage/images/5.jpeg', alt: 'Gallery Image 4', category: 'all' },
  { id: 5, src: 'storage/images/6.jpeg', alt: 'Gallery Image 5', category: 'all' },
  { id: 6, src: 'storage/images/7.jpeg', alt: 'Gallery Image 6', category: 'all' }
])

// Videos data (placeholder)
const videos = ref([
  { id: 1, title: 'Foundation Activities', category: 'all' },
  { id: 2, title: 'Relief Work', category: 'flood' },
  { id: 3, title: 'Skill Development', category: 'self-reliance' }
])

// Computed properties
const filteredImages = computed(() => {
  if (activeCategory.value === 'all') {
    return images.value
  }
  return images.value.filter(image => image.category === activeCategory.value)
})

const filteredVideos = computed(() => {
  if (activeCategory.value === 'all') {
    return videos.value
  }
  return videos.value.filter(video => video.category === activeCategory.value)
})

// Methods
const setActiveTab = (tab) => {
  activeTab.value = tab
}

const setActiveCategory = (categoryId) => {
  activeCategory.value = categoryId
}

const openLightbox = (image) => {
  currentImage.value = image
  showLightbox.value = true
}

const closeLightbox = () => {
  showLightbox.value = false
  currentImage.value = { src: '', alt: '' }
}

// Scroll handling for header (if needed elsewhere)
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
  // Add resize logic if needed
}

// Keyboard events for lightbox
const handleKeydown = (event) => {
  if (event.key === 'Escape' && showLightbox.value) {
    closeLightbox()
  }
}

// Lifecycle hooks
onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  window.addEventListener('resize', handleResize)
  window.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  window.removeEventListener('resize', handleResize)
  window.removeEventListener('keydown', handleKeydown)
})
</script>

<style scoped>
/* Custom styles for the gallery component */
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Ensure smooth transitions */
.transform {
  transition: transform 0.3s ease;
}

/* Custom scroll behavior */
html {
  scroll-behavior: smooth;
}
</style>