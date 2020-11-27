<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-bold">Published posts</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-if="posts.length > 0" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div v-for="post of posts" class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-3 py-4 sm:px-4">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{post.title}}
              </h3>
              <p class="mt-1 max-w-2xl text-xs text-gray-500">
                Created: {{post.created_at}}
              </p>
            </div>
            <div class="border-t border-gray-200 text-sm text-gray-900 font-medium py-2 px-4">
              {{post.content}}
            </div>
          </div>
        </div>
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

export default {
  name: 'Admin',
  components: {
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
