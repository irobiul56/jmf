<template>
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Latest Updates & Blogs</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Stay informed with our latest activities, news, and insights from the field
        </p>
      </div>

      <!-- Blog Posts Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Blog Post Card -->
        <article 
          v-for="post in displayedPosts" 
          :key="post.id"
          class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group cursor-pointer"
          @click="viewPost(post)"
        >
          <!-- Featured Image -->
          <div class="relative overflow-hidden h-48">
            <img
              :src="post.featured_image"
              :alt="post.title"
              class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
              @error="handleImageError"
            />
            <!-- Category Badge -->
            <div class="absolute top-4 left-4">
              <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full" 
                    :class="getCategoryClass(post.category)">
                {{ post.category }}
              </span>
            </div>
            <!-- Read Time -->
            <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-xs">
              {{ post.read_time }}
            </div>
          </div>

          <!-- Content -->
          <div class="p-6">
            <!-- Date -->
            <div class="flex items-center text-sm text-gray-500 mb-2">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              {{ formatDate(post.published_at) }}
            </div>

            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-green-600 transition-colors duration-200">
              {{ post.title }}
            </h3>

            <!-- Excerpt -->
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
              {{ post.excerpt }}
            </p>

            <!-- Author and Stats -->
            <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-4">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-xs font-semibold text-gray-600 mr-2">
                  {{ getInitials(post.author.name) }}
                </div>
                <span>{{ post.author.name }}</span>
              </div>
              <div class="flex items-center space-x-3">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                  {{ post.views }}
                </div>
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                  </svg>
                  {{ post.comments_count }}
                </div>
              </div>
            </div>
          </div>
        </article>

      </div>

      <!-- View All Blog Posts Button -->
      <div class="mt-8 text-center">
        <Link
          :href="route('blog')"
          class="inline-flex items-center justify-center px-6 py-3 border-2 border-green-600 text-base font-medium rounded-md text-green-600 hover:bg-green-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out"
        >
          View All Blog Posts
          <svg class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
  posts: {
    type: Array,
    default: () => []
  }
})

// Reactive state
const postsPerLoad = ref(3)
const loadedCount = ref(3)
const loadingMore = ref(false)
const newsletterEmail = ref('')

// Computed properties
const displayedPosts = computed(() => {
  return props.posts.slice(0, loadedCount.value)
})

const hasMorePosts = computed(() => {
  return loadedCount.value < props.posts.length
})

// Methods
const viewPost = (post) => {
  // Navigate to blog post detail page
  window.location.href = `/blog/${post.slug}`
}

const loadMorePosts = async () => {
  loadingMore.value = true
  
  // Simulate loading delay
  await new Promise(resolve => setTimeout(resolve, 800))
  
  loadedCount.value += postsPerLoad.value
  loadingMore.value = false
}

const handleImageError = (event) => {
  const fallbackImage = 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
  event.target.src = fallbackImage
}

const formatDate = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

const getCategoryClass = (category) => {
  const categoryClasses = {
    'Activities': 'bg-blue-100 text-blue-800',
    'News': 'bg-green-100 text-green-800',
    'Events': 'bg-purple-100 text-purple-800',
    'Stories': 'bg-orange-100 text-orange-800',
    'Updates': 'bg-red-100 text-red-800'
  }
  return categoryClasses[category] || 'bg-gray-100 text-gray-800'
}

const getInitials = (name) => {
  return name.split(' ').map(word => word[0]).join('').toUpperCase()
}

const subscribeNewsletter = () => {
  if (!newsletterEmail.value) return
  
  // Simulate newsletter subscription
  alert(`Thank you for subscribing with: ${newsletterEmail.value}`)
  newsletterEmail.value = ''
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Smooth transitions */
.group:hover .group-hover\:scale-105 {
  transform: scale(1.05);
}
</style>