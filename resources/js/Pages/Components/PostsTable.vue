<template>
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
              <tr>
                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Title
                </th>
                <th scope="col"
                    class="px-2 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Content
                </th>
                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Created
                </th>
                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Updated
                </th>
                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Options
                  <span class="sr-only">Edit</span>
                  <span class="sr-only">Delete</span>
                </th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="post of posts">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div v-if="post.title"
                         class="text-sm font-medium text-gray-900">
                      {{
                        post.title.length > 50
                          ? post.title.slice(0, 50) + '...'
                          : post.title
                      }}
                    </div>
                  </div>
                </td>
                <td class="px-2 py-4 whitespace-nowrap width-limited">
                  <div
                    v-if="post.content"
                    class="text-sm text-gray-500">
                    {{
                      post.content.length > 100
                        ? post.content.slice(0, 100) + '...'
                        : post.content
                    }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span
                          v-if="post.status"
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize"
                          :class="{
                                'bg-green-100 text-green-800': post.status.name === 'published',
                                'bg-blue-100 text-blue-800': post.status.name === 'draft',
                                'bg-red-100 text-red-800': post.status.name === 'inactive'}">
                          {{ post.status.name }}
                        </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ post.created_at }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ post.updated_at }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                  <inertia-link
                    :href="route('posts.edit')"
                    :data="{id: post.id}"
                    class="text-indigo-600 hover:text-indigo-900">
                    Edit
                  </inertia-link>
                  <a @click.prevent="deletePost(post)"
                     href="#"
                     class="ml-2 text-red-600 hover:text-red-900">Delete</a>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostsTable",
  props: {
    posts: Array
  }
}
</script>

<style>
.width-limited{
  max-width: 280px;
}
</style>
