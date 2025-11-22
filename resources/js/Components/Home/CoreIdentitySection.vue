<template>
  <section class="py-12 sm:py-20 text-gray-900 bg-gray-200 bg-opacity-95 min-h-screen bg-cover bg-repeat">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Header -->
      <div class="text-center mb-10 sm:mb-14">
        <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tight">
          Our <span class="text-blue-600">Core Identity</span>
        </h2>
        <p class="mt-2 text-xl text-gray-600">Background, Vision, and Mission.</p>
      </div>

      <!-- Tab Navigation -->
      <div class="flex justify-center mb-8">
        <div class="inline-flex rounded-xl bg-gray-200 border border-white p-1.5 space-x-1 sm:space-x-2 shadow-inner">
          <button 
            @click="activeTab = 'background'"
            class="tab-btn py-2 px-4 sm:px-6 rounded-lg text-sm sm:text-base transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            :class="activeTab === 'background' ? 'bg-white text-blue-700 shadow-md font-semibold' : 'text-gray-600 hover:text-blue-600'"
          >
            Background
          </button>
          
          <button 
            @click="activeTab = 'vision'"
            class="tab-btn py-2 px-4 sm:px-6 rounded-lg text-sm sm:text-base transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            :class="activeTab === 'vision' ? 'bg-white text-blue-700 shadow-md font-semibold' : 'text-gray-600 hover:text-blue-600'"
          >
            Vision
          </button>
          
          <button 
            @click="activeTab = 'mission'"
            class="tab-btn py-2 px-4 sm:px-6 rounded-lg text-sm sm:text-base transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            :class="activeTab === 'mission' ? 'bg-white text-blue-700 shadow-md font-semibold' : 'text-gray-600 hover:text-blue-600'"
          >
            Mission
          </button>
        </div>
      </div>

      <!-- Tab Content -->
      <div class="rounded-xl p-6 sm:p-10 border border-white">
        
        <!-- Background Content -->
        <div v-show="activeTab === 'background'" class="tab-content-panel space-y-6">
          <h3 class="text-3xl font-bold text-blue-600 border-b border-white pb-3 mb-6">Background of the organization</h3>
          
          <div class="flex flex-col md:flex-row items-stretch">
            <div class="md:w-1/2 w-full h-64 md:h-auto overflow-hidden">
              <img class="rounded-xl w-full h-full object-cover" src="storage/images/background.jpeg" alt="Organization Background">
            </div>
            
            <div class="md:w-1/2 w-full pt-6 md:pt-0 md:pl-10 flex flex-col justify-center">
              <p class="text-gray-700 text-lg leading-relaxed">
                Jagoroni Mohila Foundation was established in 1990. The organization was registered by the Patuakhali Women's Affairs Department in 1991 under the registration number MB.A/Patua 3/91 and was registered in 1997 with the Patuakhali District Youth Development Department registration number JuboA/Patua/545/97. <br><br>
                The main goal of the organization is to carry out development work at the neglected grassroots level of society. Jagoroni Mohila Foundation is currently carrying out development work in various upazilas of Patuakhali district. If the organization receives cooperation from government/private donor agencies in the future, its development activities will expand further. <Link :href="route('about')" class="text-blue-600 hover:underline">Read More</Link>
              </p>
            </div>
          </div>
        </div>
        
        <!-- Vision Content -->
        <div v-show="activeTab === 'vision'" class="tab-content-panel space-y-6">
          <h3 class="text-3xl font-bold text-blue-600 border-b border-white pb-3 mb-6">Our Vision</h3>
          
          <div class="flex flex-col md:flex-row-reverse items-stretch">
            <div class="md:w-1/2 w-full h-64 md:h-auto overflow-hidden rounded-lg">
              <img class="rounded-xl w-full h-full object-cover" src="storage/images/vison.jpeg" alt="Organization Vision">
            </div>
            
            <div class="md:w-1/2 w-full pt-6 md:pt-0 md:pr-10 flex flex-col justify-center">
              <p class="text-gray-700 text-lg leading-relaxed">
                In light of the statement that women are also human beings, to ensure the fundamental rights of all people, to transform the population into a skilled workforce by providing socio-economic assistance and training, and to ensure the participation of women alongside men in all developmental activities of the society by creating equality between men and women. To eliminate discrimination from society by establishing the rights of all people as human beings and to provide overall support to the people of the working area in the socio-economic development. <Link :href="route('about')" class="text-blue-600 hover:underline">Read More</Link>
              </p>
            </div>
          </div>
        </div>

        <!-- Mission Content -->
        <div v-show="activeTab === 'mission'" class="tab-content-panel space-y-6">
          <h3 class="text-3xl font-bold text-blue-600 border-b border-white pb-3 mb-6">Our Mission</h3>
          
          <div class="flex flex-col md:flex-row items-stretch">
            <div class="md:w-1/2 w-full h-64 md:h-auto overflow-hidden rounded-lg">
              <img class="rounded-xl shadow-lg w-full h-full object-cover" src="storage/images/mission.jpeg" alt="Organization Mission">
            </div>
            
            <div class="md:w-1/2 w-full pt-6 md:pt-0 md:pl-10 flex flex-col justify-center">
              <p class="text-gray-700 text-lg leading-relaxed">
                Team building and training, creating a healthy environment, adult and child education programs, birth and marriage registration, preventing child and polygamy, creating gender awareness, preventing oppression and kidnapping of women and children, preventing dowry, establishing human rights, Social forestry, the creation of an environment free from all pollution, including smoking, the creation of a society free from terrorism, advocacy activities on family planning and women's healthcare, development of the disabled and legal assistance to abused women, self-employment through capital provision, establishment of financial/technical/vocational educational institutions, Receiving financial assistance, providing financial assistance to members of various projects, receiving and providing grants, cottage industries ... <Link :href="route('about')" class="text-blue-600 hover:underline">Read More</Link>
              </p>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const activeTab = ref('background')
</script>

<style scoped>
.tab-content-panel {
  transition: opacity 0.3s ease-in-out;
}
</style>