<template>
  <section id="photos" class="p-4 md:p-8 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Photo Gallery</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Capturing moments from our various activities and community events
        </p>
      </div>

      <!-- Gallery Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Gallery Item -->
        <div 
          v-for="(image, index) in displayedImages" 
          :key="image.id"
          class="w-full group cursor-pointer"
          @click="openLightbox(index)"
        >
          <div class="relative overflow-hidden aspect-video rounded-lg shadow-md group-hover:shadow-xl transition-all duration-300">
            <img
              :src="image.url"
              :alt="image.alt"
              class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:scale-105"
              loading="lazy"
              @error="handleImageError"
            />
            
            <!-- Overlay on Hover -->
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
              <div class="transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                </svg>
              </div>
            </div>
          </div>
          
          <!-- Image Caption -->
          <div v-if="image.caption" class="mt-3">
            <p class="text-sm text-gray-600 font-medium">{{ image.caption }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ image.date }}</p>
          </div>
        </div>

      </div>

      <!-- View All Gallery Button -->
      <div class="mt-8 flex justify-center">
        <Link
          :href="route('gallery')"
          class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out"
        >
          View Full Gallery
          <svg class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M19.7709 9.44699C19.7706 9.44676 19.7704 9.44648 19.7702 9.44625L15.688 5.38375C15.3821 5.07941 14.8875 5.08054 14.5831 5.3864C14.2787 5.69222 14.2799 6.18687 14.5857 6.49125L17.3265 9.21875H0.78125C0.349766 9.21875 0 9.56851 0 10C0 10.4315 0.349766 10.7812 0.78125 10.7812H17.3264L14.5857 13.5087C14.2799 13.8131 14.2787 14.3078 14.5831 14.6136C14.8875 14.9195 15.3822 14.9205 15.688 14.6162L19.7702 10.5537C19.7704 10.5535 19.7706 10.5532 19.7709 10.553C20.0769 10.2476 20.0759 9.75137 19.7709 9.44699Z"
              fill="currentColor"
              clip-path="url(#clip0_2364_10373)"
            ></path>
          </svg>
        </Link>
      </div>

      <!-- Lightbox Modal -->
      <div 
        v-if="lightboxOpen"
        class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4"
        @click="closeLightbox"
      >
        <div class="relative max-w-4xl max-h-full w-full">
          <!-- Close Button -->
          <button
            @click="closeLightbox"
            class="absolute -top-12 right-0 text-white hover:text-gray-300 transition duration-150 z-10"
          >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>

          <!-- Navigation Arrows -->
          <button
            v-if="currentImageIndex > 0"
            @click.stop="prevImage"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition duration-150 z-10"
          >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>

          <button
            v-if="currentImageIndex < displayedImages.length - 1"
            @click.stop="nextImage"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 transition duration-150 z-10"
          >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- Image -->
          <img
            :src="currentImage.url"
            :alt="currentImage.alt"
            class="w-full h-auto max-h-[80vh] object-contain rounded-lg"
          />

          <!-- Image Info -->
          <div v-if="currentImage.caption" class="mt-4 text-center text-white">
            <p class="text-lg font-medium">{{ currentImage.caption }}</p>
            <p v-if="currentImage.date" class="text-sm text-gray-300 mt-1">{{ currentImage.date }}</p>
          </div>

          <!-- Image Counter -->
          <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-sm">
            {{ currentImageIndex + 1 }} / {{ displayedImages.length }}
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, computed, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  images: {
    type: Array,
    default: () => []
  }
})

// Reactive state
const lightboxOpen = ref(false)
const currentImageIndex = ref(0)
const imagesPerLoad = ref(6)
const loadedCount = ref(6)
const loadingMore = ref(false)

// Computed properties
const displayedImages = computed(() => {
  return props.images.slice(0, loadedCount.value)
})

const hasMoreImages = computed(() => {
  return loadedCount.value < props.images.length
})

const currentImage = computed(() => {
  return displayedImages.value[currentImageIndex.value] || {}
})

// Methods
const openLightbox = (index) => {
  currentImageIndex.value = index
  lightboxOpen.value = true
  document.body.style.overflow = 'hidden'
}

const closeLightbox = () => {
  lightboxOpen.value = false
  document.body.style.overflow = 'auto'
}

const nextImage = () => {
  if (currentImageIndex.value < displayedImages.value.length - 1) {
    currentImageIndex.value++
  }
}

const prevImage = () => {
  if (currentImageIndex.value > 0) {
    currentImageIndex.value--
  }
}

const loadMore = async () => {
  loadingMore.value = true
  
  // Simulate loading delay
  await new Promise(resolve => setTimeout(resolve, 1000))
  
  loadedCount.value += imagesPerLoad.value
  loadingMore.value = false
}

const handleImageError = (event) => {
  const fallbackImage = 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
  event.target.src = fallbackImage
}

// Keyboard navigation for lightbox
const handleKeydown = (event) => {
  if (!lightboxOpen.value) return

  switch (event.key) {
    case 'Escape':
      closeLightbox()
      break
    case 'ArrowLeft':
      prevImage()
      break
    case 'ArrowRight':
      nextImage()
      break
  }
}

// Event listeners
onMounted(() => {
  document.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeydown)
})
</script>

<style scoped>
/* Custom scrollbar for lightbox */
.fixed ::-webkit-scrollbar {
  width: 8px;
}

.fixed ::-webkit-scrollbar-track {
  background: #1f2937;
}

.fixed ::-webkit-scrollbar-thumb {
  background: #10B981;
  border-radius: 4px;
}

.fixed ::-webkit-scrollbar-thumb:hover {
  background: #059669;
}

/* Smooth transitions */
.gallery-item {
  transition: all 0.3s ease-in-out;
}

/* Prevent body scroll when lightbox is open */
body.no-scroll {
  overflow: hidden;
}
</style>