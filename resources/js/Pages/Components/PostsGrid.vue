<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div v-for="post of posts" class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-3 py-4 sm:px-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          {{ post.title }}
        </h3>
        <p class="mt-1 max-w-2xl text-xs text-gray-500">
          <span class="font-bold">Created:</span> {{ post.created_at }}
        </p>
      </div>
      <div class="border-t border-gray-200 text-sm text-gray-900 font-medium py-2 px-4">
        {{ post.content }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostsGrid",
  props: {
    posts: Array
  }
}
</script>

<style scoped>

</style>
