<template>
  <AppLayout title="Welcome">
    <!-- Hero Section -->
    <section class="relative py-16 sm:py-24 lg:py-32 bg-gray-900 text-white overflow-hidden">
      <div class="absolute inset-0 bg-cover bg-center"  
           :style="{ backgroundImage: `url('/storage/${slide.background_image}')`, opacity: 0.3 }">
          
      </div>



      <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-xl">
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5">
            {{ slide.title }}
          </h1>
          
          <p class="text-md sm:text-lg text-gray-200 mb-10 font-light">
           {{ slide.description }}
          </p>
          
          <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
            <Link :href="route('about')" class="inline-block w-full sm:w-auto text-center font-bold py-3 px-8 rounded-xl shadow-2xl text-lg transition duration-300 transform hover:scale-105 bg-green-600 hover:bg-green-700 text-white">
              Know More
            </Link>
            
            <Link :href="route('activities')" class="inline-block w-full sm:w-auto text-center font-bold py-3 px-8 rounded-xl text-lg transition duration-300 transform hover:scale-105 border-2 border-white text-white hover:bg-white hover:text-gray-800">
              All Activities
            </Link>
          </div>
        </div>
      </div>
    </section>

    <hr class="border-gray-200">

    <!-- Core Identity Section -->
    <CoreIdentitySection :coreIdentities="coreIdentities"/>

    <hr class="border-gray-200">

    <!-- Features Section -->
    <FeaturesSection :initial-features="initialFeatures || []" />

    <hr class="border-gray-200">

    <!-- Activities Section -->
    <ActivitiesSection :activities="activities" />

    <hr class="border-gray-200">

    <!-- Gallery Section -->
    <GallerySection :media="media" />

    <hr class="border-gray-200">

    <!-- Blog Section -->
    <BlogSection :blog="blog" />

    <hr class="border-gray-200">

    <!-- Donation Section -->
    <DonationSection :donationData ="donationData" />

    <hr class="border-gray-200">

    <!-- Call to Action Section -->
    <CallToActionSection />
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import CoreIdentitySection from '@/Components/Home/CoreIdentitySection.vue'
import FeaturesSection from '@/Components/Home/FeaturesSection.vue'
import ActivitiesSection from '@/Components/Home/ActivitiesSection.vue'
import GallerySection from '@/Components/Home/GallerySection.vue'
import BlogSection from '@/Components/Home/BlogSection.vue'
import DonationSection from '@/Components/Home/DonationSection.vue'
import CallToActionSection from '@/Components/Home/CallToActionSection.vue'



defineProps({
  activities: Array,
  blog: Array,
  media: Array,
  slide: Object,
  coreIdentities: Array,
  initialFeatures:Array,
  donationData: Object,
  
})
</script>