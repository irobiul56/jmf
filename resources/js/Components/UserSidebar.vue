<!-- UserSidebar.vue -->
<script setup>
import { defineProps } from 'vue';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
  isCollapsed: Boolean
});

// Route helper function for active state
const isRouteActive = (patterns) => {
  const currentRoute = route().current();
  if (!currentRoute) return false;

  return patterns.some(pattern => {
    if (pattern.endsWith('*')) {
      const basePattern = pattern.replace('*', '');
      return currentRoute.startsWith(basePattern);
    }
    return currentRoute === pattern;
  });
};
</script>

<template>
  <aside class="min-h-screen bg-white shadow-lg p-4 transition-all duration-300 border-r border-gray-100 flex flex-col"
    :class="isCollapsed ? 'w-20' : 'w-64'">
    <nav>
      <ul class="space-y-2">
      <li>
          <NavLink :href="route('dashboard')" :active="isRouteActive(['dashboard', 'dashboard.*'])"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa fa-dashboard mr-2" style="font-size:20px"></i>
              <span v-if="!isCollapsed" class="whitespace-nowrap">Dashboard</span>
            </div>
          </NavLink>
        </li>

         <li>
          <NavLink :href="route('activites.index')" :active="isRouteActive(['activites', 'activites.*'])"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa fa-tasks mr-2" style="font-size:20px"></i>
              <span v-if="!isCollapsed" class="whitespace-nowrap">Activities</span>
            </div>
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('photos.index')" :active="isRouteActive(['photos', 'photos.*'])"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa-regular fa-image mr-2" style="font-size:20px"></i>
              <span v-if="!isCollapsed" class="whitespace-nowrap">Gallery</span>
            </div>
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('blogpost.index')" :active="isRouteActive(['blogpost', 'blogpost.*'])"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa-solid fa-blog mr-2" style="font-size:20px"></i>
              
              <span v-if="!isCollapsed" class="whitespace-nowrap">Blogs</span>
            </div>
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('notices.index')" :active="isRouteActive(['notices', 'notices.*'])"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa-solid fa-circle-exclamation mr-2" style="font-size:20px"></i>
              
              <span v-if="!isCollapsed" class="whitespace-nowrap">Notice</span>
            </div>
          </NavLink>
        </li>

         <li>
          <NavLink :href="route('dashboard')"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa-regular fa-address-book mr-2" style="font-size:20px"></i>
              <span v-if="!isCollapsed" class="whitespace-nowrap">Contact</span>
            </div>
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('dashboard')"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa-solid fa-gears mr-2" style="font-size:20px"></i>
              <span v-if="!isCollapsed" class="whitespace-nowrap">Home Setting</span>
            </div>
          </NavLink>
        </li>

         <li>
          <NavLink :href="route('dashboard')"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa-solid fa-gears mr-2" style="font-size:20px"></i>
              <span v-if="!isCollapsed" class="whitespace-nowrap">About Setting</span>
            </div>
          </NavLink>
        </li>

        <li>
          <NavLink :href="route('dashboard')"
            class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors"
            :class="isCollapsed ? 'justify-center px-2' : 'px-3'">
            <div class="flex items-center">
              <i class="fa-solid fa-code mr-2" style="font-size:20px"></i>
              <span v-if="!isCollapsed" class="whitespace-nowrap">Footer</span>
            </div>
          </NavLink>
        </li>
        
        

      </ul>
    </nav>
  </aside>
</template>