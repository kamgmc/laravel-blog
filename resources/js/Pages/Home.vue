<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-bold">Published posts</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <posts-grid v-if="posts.length > 0" :posts="posts"></posts-grid>
        <div v-else class="md:col-span-1 shadow-none">
          <div class="px-4 sm:px-0 bg">
            <h3 class="text-lg font-medium leading-6 text-gray-900">You haven't created any posts yet.</h3>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import Button from "@/Jetstream/Button";
import PostsGrid from "@/Pages/Components/PostsGrid";

export default {
  name: 'Admin',
  components: {
    PostsGrid,
    Button,
    AppLayout,
    Welcome,
  },
  props: {
    posts: Array
  },
  methods: {
  }
}
</script>
