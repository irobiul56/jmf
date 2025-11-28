<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FronendLayout.vue';
import { ArrowRight } from '@element-plus/icons-vue'

const props = defineProps({
    blog: Object,
});

</script>

<template>

    <Head title="Blog" />
    <FrontendLayout>
        <div class="relative w-full h-96">
    <!-- Background image with proper object-cover and fallback -->
             <img :src="`/storage/${blog.image}`"
                alt="{{ blog.title }}"
                class="absolute inset-0 w-full h-full object-cover"
                onerror="this.style.display='none'"
            >
            <!-- Dark overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <!-- Content -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="bg-blue-600 text-white px-6 py-4 rounded-lg shadow-xl max-w-3xl mx-4">
                    <h1 class="text-3xl md:text-4xl font-bold text-center">{{ blog.title }}</h1>
                </div>
            </div>
        </div>


        <div class="p-6 mx-auto max-w-5xl">
            <div class="ckeditor-content" v-html="blog.description"></div>
            <el-button class="mt-3" type="primary" @click="$inertia.get('/')">Back</el-button>
        </div>
    </FrontendLayout>
</template>

<style scoped>
.steps-container {
    padding: 20px;
    text-align: center;
}

.title {
    font-size: 24px;
    margin-bottom: 20px;
}

.description {
    color: #555;
    font-size: 16px;
    line-height: 1.8;
    margin-top: 10px;
}


</style>
