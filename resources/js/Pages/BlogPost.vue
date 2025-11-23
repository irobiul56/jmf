<template>
    <AppLayout title="Jagoroni Foundation">
  <div>
    <!-- Hero Section -->
    <section class="py-16 sm:py-24 bg-cover bg-center relative" 
             style="background-image: url('storage/images/headerbackground.jpeg');">
      <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6 text-center">
          Blog
        </h1>
        <div class="w-24 h-1 bg-green-400 mx-auto rounded-full mb-12"></div>
      </div>
    </section>

    <!-- Blog Content Section -->
    <section class="py-16 sm:py-24 bg-gray-50">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search and Language Toggle -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-10 space-y-4 sm:space-y-0">
          <div class="w-full sm:w-auto relative">
            <input 
              type="text" 
              placeholder="Search Blogs"
              v-model="searchQuery"
              class="w-full sm:w-80 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition duration-150 shadow-sm"
            >
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          
          <button 
            @click="toggleLanguage"
            class="px-4 py-2 text-sm font-semibold text-white bg-green-brand rounded-lg hover:bg-green-700 transition duration-300 shadow-md flex-shrink-0"
          >
            {{ language === 'en' ? 'বাংলা' : 'English' }}
          </button>
        </div>

        <!-- Blog Posts -->
        <div class="space-y-10">

          <!-- Featured Post -->
          <a href="#" class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden group border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-3">
              <div class="lg:col-span-2">
                <img 
                  src="storage/images/1.jpeg" 
                  alt="Month-long Da'wah Training Completed"
                  class="w-full h-72 object-cover transition duration-500 group-hover:scale-[1.03]"
                  @error="handleImageError"
                >
              </div>
              <div class="lg:col-span-1 p-6 flex flex-col justify-between">
                <div>
                  <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-brand transition duration-150">
                    Month-long Da'wah Training-2025 Completed
                  </h3>
                  <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                    The Da'wah Training 2025, organized by the Jagoroni Da'wah and Research Institute, has successfully come to an end. The most comprehensive training program focused on real-world applications of Islamic principles...
                  </p>
                </div>
                <p class="text-xs text-gray-400 font-medium">
                  October 19, 2025
                </p>
              </div>
            </div>
          </a>
          
          <hr class="border-gray-200">

          <!-- Blog Posts Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Blog Post 1 -->
            <a 
              href="#" 
              class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden group border border-gray-100"
              v-for="post in filteredPosts"
              :key="post.id"
            >
              <div class="h-48">
                <img 
                  :src="post.image" 
                  :alt="post.title"
                  class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                  @error="handleImageError"
                >
              </div>
              <div class="p-4 flex flex-col justify-between h-auto">
                <h4 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-brand transition duration-150 line-clamp-2">
                  {{ post.title }}
                </h4>
                <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                  {{ post.excerpt }}
                </p>
                <p class="text-xs text-gray-400 font-medium pt-2 border-t border-gray-100">
                  {{ post.date }}
                </p>
              </div>
            </a>
            
          </div>
        </div>
        
        <!-- Load More Button -->
        <div class="mt-12 text-center">
          <button 
            @click="loadMorePosts"
            class="px-6 py-3 border border-green-brand text-sm font-semibold rounded-lg text-green-brand hover:bg-green-brand hover:text-black transition duration-300"
          >
            Load More Posts
          </button>
        </div>

      </div>
    </section>
  </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

// Reactive data
const searchQuery = ref('')
const language = ref('en')
const posts = ref([
  {
    id: 1,
    title: 'Jagoroni Foundation Stands with 300 Martyred...',
    excerpt: 'Jagoroni Foundation has provided financial assistance of 100,000 BDT to each of the families of 300 martyrs from the Ansars...',
    date: 'October 19, 2025',
    image: 'storage/images/3.jpeg'
  },
  {
    id: 2,
    title: 'Prize Distribution for the 2nd and 3rd Phases of the Qura...',
    excerpt: 'The prize distribution ceremony for the second and third phases of the Quran recitation competition was held in the joyful and inspiring atmosphere of the Foundation...',
    date: 'October 19, 2025',
    image: 'storage/images/4.jpeg'
  },
  {
    id: 3,
    title: 'Jagoroni Foundation\'s Roundtable Meeting on...',
    excerpt: 'To reduce the severity and damage caused by floods and to formulate sustainable rehabilitation strategies, Jagoroni Foundation organized a critical roundtable discussion...',
    date: 'October 19, 2025',
    image: 'storage/images/5.jpeg'
  }
])

// Computed properties
const filteredPosts = computed(() => {
  if (!searchQuery.value) return posts.value
  
  const query = searchQuery.value.toLowerCase()
  return posts.value.filter(post => 
    post.title.toLowerCase().includes(query) || 
    post.excerpt.toLowerCase().includes(query)
  )
})

// Methods
const toggleLanguage = () => {
  language.value = language.value === 'en' ? 'bn' : 'en'
}

const handleImageError = (event) => {
  event.target.src = 'https://placehold.co/400x200/96d482/ffffff?text=Post+Image'
}

const loadMorePosts = () => {
  // In a real application, this would fetch more posts from an API
  console.log('Loading more posts...')
  // Example of adding more posts
  const newPost = {
    id: posts.value.length + 1,
    title: 'New Blog Post ' + (posts.value.length + 1),
    excerpt: 'This is a new blog post added when clicking load more...',
    date: 'October 20, 2025',
    image: 'https://placehold.co/400x200/96d482/ffffff?text=New+Post'
  }
  posts.value.push(newPost)
}

// Lifecycle hooks
onMounted(() => {
  console.log('Blog page component mounted')
})
</script>

<style scoped>
/* Custom brand colors */
.text-green-brand { color: #10B981; } 
.bg-green-brand { background-color: #10B981; }
.hover\:bg-green-brand-dark:hover { background-color: #059669; }
.border-green-brand { border-color: #10B981; }

/* Line clamp utility */
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
</style>