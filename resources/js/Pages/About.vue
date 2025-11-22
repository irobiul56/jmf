<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

// Reactive state for tabs
const activeTab = ref('background')

// Reactive state for header visibility (for scroll behavior)
const isHeaderVisible = ref(true)

// Scroll handling for header
let lastScrollY = ref(0)
const scrollThreshold = 100

function handleScroll() {
  const currentScrollY = window.scrollY
  
  if (currentScrollY > lastScrollY.value && currentScrollY > scrollThreshold) {
    isHeaderVisible.value = false
  } else if (currentScrollY < lastScrollY.value) {
    isHeaderVisible.value = true
  }
  
  lastScrollY.value = currentScrollY
}

// Image error handler
function handleImageError(event) {
  event.target.src = 'https://placehold.co/40x40/1d4ed8/ffffff?text=LOGO'
}

// Tab switching
function switchTab(tabName) {
  activeTab.value = tabName
}

// Check if tab is active
function isTabActive(tabName) {
  return activeTab.value === tabName
}

// Lifecycle hooks
onMounted(() => {
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<template>
<AppLayout title="About">
  <!-- Hero Section -->
  <section class="py-16 sm:py-24 bg-cover bg-center relative **-mt-5**" 
           style="background-image: url('storage/images/headerbackground.jpeg');">
      
      <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6 text-center">
              About Us
          </h1>
          <div class="w-24 h-1 bg-green-400 mx-auto rounded-full mb-12"></div>
      </div>
  </section>

  <!-- About Content Section -->
  <section class="py-16 sm:py-24 bg-white">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-start">
              
              <div class="relative w-full overflow-hidden rounded-xl shadow-2xl group cursor-pointer">
                  <div class="aspect-w-16 aspect-h-9">
                      <img src="storage/images/1.jpeg" 
                           alt="Video Thumbnail" 
                           class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                           @error="handleImageError">
                  </div>
                  
                  <div class="absolute inset-0 bg-black/30 flex flex-col justify-center items-center p-4">
                      <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center shadow-xl transition duration-300 group-hover:bg-red-700 group-hover:scale-110">
                          <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M6 4l12 8-12 8V4z"></path>
                          </svg>
                      </div>
                  </div>
              </div>
              
              <div class="pt-4 md:pt-0">
                  <h3 class="sr-only">About Jagoroni Mohila Foundation</h3>
                  <p class="text-ml text-gray-700 leading-relaxed mb-4">
                      Jagoroni Mohila Foundation was established in 1990. The organization was registered by the Patuakhali Women's Affairs Department in 1991 under the registration number MB.A/Patua 3/91 and was registered in 1997 with the Patuakhali District Youth Development Department registration number JuboA/Patua/545/97.
                  </p>
                  <p class="text-ml text-gray-700 leading-relaxed mb-4">
                      The main goal of the organization is to carry out development work at the neglected grassroots level of society. Jagoroni Mohila Foundation is currently carrying out development work in various upazilas of Patuakhali district. If the organization receives cooperation from government/private donor agencies in the future, its development activities will expand further.
                  </p>
              </div>
          </div>
      </div>
  </section>

  <!-- Tabs Section -->
  <div class="p-4 sm:p-8 bg-gray-50 min-h-screen">
      <div class="max-w-6xl mx-auto">
          
          <!-- Header -->
          <header class="mb-8">
              <h1 class="text-3xl font-extrabold text-gray-900 border-b-2 border-green-500 pb-2">Organizational Overview</h1>
              <p class="text-gray-500 mt-1">Navigate through our core principles and mission.</p>
          </header>

          <div class="flex flex-col lg:flex-row gap-8">
              
              <!-- Tab Navigation Sidebar -->
              <div class="w-full lg:w-1/4 bg-white p-4 rounded-xl shadow-xl h-fit">
                  <ul class="space-y-2" id="tab-nav">
                      <li 
                          @click="switchTab('background')" 
                          class="tab-button p-3 rounded-lg cursor-pointer"
                          :class="isTabActive('background') ? 'active-tab-style' : 'inactive-tab-style'"
                      >
                          Background
                      </li>
                      
                      <li 
                          @click="switchTab('vision')" 
                          class="tab-button p-3 rounded-lg cursor-pointer"
                          :class="isTabActive('vision') ? 'active-tab-style' : 'inactive-tab-style'"
                      >
                          Vision
                      </li>
                      
                      <li 
                          @click="switchTab('mission')" 
                          class="tab-button p-3 rounded-lg cursor-pointer"
                          :class="isTabActive('mission') ? 'active-tab-style' : 'inactive-tab-style'"
                      >
                          Mission & Values
                      </li>
                  </ul>
              </div>

              <!-- Tab Content Area -->
              <div class="w-full lg:w-3/4">
                  
                  <!-- Content 1: Background -->
                  <div v-if="activeTab === 'background'" class="tab-content space-y-6">
                      <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.01] transition duration-300 cursor-pointer border-t-4 border-green-500">
                          <div class="w-full h-64 bg-gray-200 flex items-center justify-center p-4">
                              <img src="storage/images/1.jpeg" alt="Foundation Snapshot" class="rounded-lg object-cover w-full h-full" @error="handleImageError">
                          </div>
                      </div>
                      <div class="bg-white rounded-xl shadow-lg p-6">
                          <h2 class="text-2xl font-bold text-gray-800 mb-2">Background of the Organization</h2>
                          <p class="text-gray-600">
                             Jagoroni Mohila Foundation was established in 1990. The company operates on its own land. Alhaj Md. Abdul Haque Molla, the husband of the founding president, donated the land for the construction of the organization's office. The organization was registered by the Patuakhali Women's Affairs Department in 1991. This is registered under the registration number MB.A/Patua 3/91 and was registered in 1997 with the Patuakhali District Youth Development Department.The company, whose registration number is JuboA/Patua/545/97, later obtained registration from Dhaka Joint Stock Company, S 10082/09. It also obtained membership in various organizations. The main goal of the organization is to carry out development work at the neglected grassroots level of society. Jagoroni Mohila Foundation is currently carrying out development work in various upazilas of Patuakhali district. If the organization receives cooperation from government/private donor agencies in the future, its development activities will expand further.
                          </p>
                          <br>
                          <p class="text-gray-600">
                              <b> Introduction:</b>
                              Bangladesh is one of the poorest countries in the world. Despite being a part of a well-established civilization, Bangladesh has many internal problems due to poverty. This hinders the improvement of people's quality of life. As a result, there is no golden future ahead of the people of the country. People are constantly worried about various types of natural disasters and epidemics. For example, due to cyclones, floods, tidal waves, heavy rains, droughts, and river erosion, people's food crops are destroyed, their harvest is disrupted, people are displaced and agricultural land and homesteads are lost to the rivers. There are also various types of immoral activities caused by man, such as violent programs of various political parties, riots, arson, burning, looting, bombings, and vandalism of productive institutions, and continuous strike programs, which bring unbearable suffering to public life. In all situations, the public is hindered in their daily livelihood and access to various services. As a result, pregnant mothers, newborn babies, the elderly, and the destitute have to die due to lack of medical care. Due to which child labor and various forms of torture, discrimination, and poverty are increasing in the society. These are the daily life pictures of Bangladesh, the national constitution of Bangladesh. But in reality, it is surrounded by many limitations. At different times, political parties have made commitments before forming the government, but in reality, it is different. Good governance and non-discrimination have not been established in the country even today. Rather, equal opportunities and rights must be established among the disadvantaged in the society in the distribution of state resources and in the implementation of laws. Then, I hope that all the issues mentioned above will be resolved. Talks about establishing equality among people and equal opportunities and equal rights for all.
                          </p>
                      </div>
                  </div>
                  
                  <!-- Content 2: Vision -->
                  <div v-if="activeTab === 'vision'" class="tab-content space-y-6">
                      <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.01] transition duration-300 cursor-pointer border-t-4 border-green-500">
                          <div class="w-full h-64 bg-gray-200 flex items-center justify-center p-4">
                              <img src="storage/images/3.jpeg" alt="Foundation Snapshot" class="rounded-lg object-cover w-full h-full" @error="handleImageError">
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6">
                          <h2 class="text-2xl font-bold text-gray-800 mb-2">Our Long-Term Vision</h2>
                          <p class="text-gray-600">
                              In light of the statement that women are also human beings, to ensure the fundamental rights of all people, to transform the population into a skilled workforce by providing socio-economic assistance and training, and to ensure the participation of women alongside men in all developmental activities of the society by creating equality between men and women. To eliminate discrimination from society by establishing the rights of all people as human beings and to provide overall support to the people of the working area in the socio-economic development.
                          </p>
                      </div>

                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <div class="p-6 bg-green-50 rounded-xl shadow border border-green-200">
                              <p class="text-xl font-bold text-green-800">10x Impact</p>
                              <p class="text-sm text-green-600">Focusing on projects that yield exponential positive change.</p>
                          </div>
                          <div class="p-6 bg-green-50 rounded-xl shadow border border-green-200">
                              <p class="text-xl font-bold text-green-800">Global Reach</p>
                              <p class="text-sm text-green-600">Expanding operations to key developing regions by 2030.</p>
                          </div>
                      </div>
                  </div>

                  <!-- Content 3: Mission & Values -->
                  <div v-if="activeTab === 'mission'" class="tab-content space-y-6">
                      <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.01] transition duration-300 cursor-pointer border-t-4 border-green-500">
                          <div class="w-full h-64 bg-gray-200 flex items-center justify-center p-4">
                              <img src="storage/images/4.jpeg" alt="Foundation Snapshot" class="rounded-lg object-cover w-full h-full" @error="handleImageError">
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6">
                          <h2 class="text-2xl font-bold text-gray-800 mb-2">Our Mission & Core Values</h2>
                          <p class="text-gray-600 mb-4">
                              Team building and training, creating a healthy environment, adult and child education programs, birth and marriage registration, preventing child and polygamy, creating gender awareness, preventing oppression and kidnapping of women and children, preventing dowry, establishing human rights, Social forestry, the creation of an environment free from all pollution, including smoking, the creation of a society free from terrorism, advocacy activities on family planning and women's healthcare, development of the disabled and legal assistance to abused women, self-employment through capital provision, establishment of financial/technical/vocational educational institutions, Receiving financial assistance, providing financial assistance to members of various projects, receiving and providing grants, cottage industries, fisheries, nurseries, government land, ponds and canals, government property lease, improving rural drainage systems, establishing joint investment system institutions, accepting and implementing various government projects. To assist the government in all government activities, social development and skill development training, human resource development, providing financial assistance to families affected by cases, establishing good governance, and establishing the fundamental rights of all people, entertainment, and celebrating national days.
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </AppLayout>
</template>

<style scoped>
/* ফন্ট ও কাস্টম কালার */
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700;900&display=swap');

body {
    font-family: 'Noto Sans Bengali', sans-serif;
}

/* কাস্টম ব্র্যান্ড কালারস */
.text-green-brand { color: #10B981; } 
.bg-green-brand { background-color: #10B981; }
.hover\:bg-green-brand-dark:hover { background-color: #059669; }
.border-green-brand { border-color: #10B981; }
.header-shadow { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); }

.bg-pattern {
    background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('placeholder-background.jpg'); 
    background-color: #dab15a; 
    background-blend-mode: multiply;
}

/* Ensure sticky header is always on top */
.sticky-header {
    will-change: transform;
    transition: all 0.3s ease-in-out; 
}

/* Custom class for hiding the header completely */
.header-slide-up {
    transform: translateY(-200%);
}


.tab-button {
    transition: all 0.2s ease-in-out;
    border-left: 4px solid transparent;
}

/* Specific active classes */
.active-tab-style {
    @apply text-green-700 bg-green-50/70 border-green-500 font-semibold;
}

/* Specific inactive classes */
.inactive-tab-style {
    @apply text-gray-700 hover:bg-gray-100 font-medium;
}
</style>