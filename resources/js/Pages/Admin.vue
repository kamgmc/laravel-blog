<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight inline">
        Posts
      </h2>
      <inertia-link
        :href="route('posts.create')">
        <button
          type="button"
          class="inline-flex items-center ml-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
          New post
        </button>
      </inertia-link>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <posts-table v-if="posts.length > 0" :posts="posts"></posts-table>
        <div v-else class="md:col-span-1 shadow-none">
          <div class="px-4 sm:px-0 bg">
            <h3 class="text-lg font-medium leading-6 text-gray-900">You haven't created any posts yet.</h3>
            <p class="mt-1 text-sm text-gray-600">
              Start by creating a <inertia-link class="underline" :href="route('posts.create')">new post</inertia-link>
            </p>
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
import PostsTable from "@/Pages/Components/PostsTable";

export default {
  name: 'Admin',
  components: {
    PostsTable,
    Button,
    AppLayout,
    Welcome,
  },
  props: {
    posts: Array
  },
  methods: {
    getPosts() {
      axios.get('/api/posts')
        .then(response => this.posts = response.data)
        .catch(reason => console.warn(reason.response))
    },
    deletePost(post) {
      this.$alertify.confirm(
        `Are you sure you want to delete the post "${post.title}"?`,
        () => {
          axios.delete(`/api/posts/${post.id}`)
            .then(() => {
              this.$alertify.success('Post deleted successfully.')
              this.$inertia.reload()
            })
        });
    }
  }
}
</script>
