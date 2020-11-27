<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight inline">
        New post
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0">
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
              <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Create a new post</h3>
                <p class="mt-1 text-sm text-gray-600">
                  Share your experience and create something great.
                </p>
              </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
              <form action="#" method="POST">
                <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                      <div class="col-span-6 sm:col-span-3">
                        <label for="title"
                               class="block text-sm font-medium text-gray-700">
                          Title
                        </label>
                        <input type="text"
                               id="title"
                               v-model="post.title"
                               placeholder="Post's title"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <p v-if="errors.includes('title:length')"
                           class="text-red-700 text-xs ml-1 mt-1">
                          Title must contains at least 3 characters.
                        </p>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select
                          id="status"
                          v-model="post.status_id"
                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option disabled :value="-1">Select...</option>
                          <option v-for="status of statusList" :value="status.id">
                            {{ status.name | capitalize }}
                          </option>
                        </select>
                        <p v-if="errors.includes('status:required')"
                           class="text-red-700 text-xs ml-1 mt-1">
                          This field is required.
                        </p>
                      </div>
                    </div>
                    <div class="mt-4">
                      <label for="about" class="block text-sm font-medium text-gray-700">
                        Content
                      </label>
                      <div class="mt-1">
                        <textarea
                          id="about" rows="3"
                          v-model="post.content"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                          placeholder="Tell us what are you thinking."></textarea>
                        <p v-if="errors.includes('content:length')"
                           class="text-red-700 text-xs ml-1 mt-1">
                          Content must contains at least 3 characters.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button
                      type="submit"
                      class="inline-flex items-center ml-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                      @click.prevent="createPost">
                      Save
                    </button>
                  </div>
                </div>
              </form>
            </div>
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
  name: "CreatePost",
  data() {
    return {
      post: {
        title: '',
        content: '',
        status_id: -1
      },
      errors: []
    }
  },
  props: {
    statusList: Array
  },
  components: {
    Button,
    AppLayout,
    Welcome,
  },
  methods: {
    createPost() {
      if (this.validateForm()) {
        axios.post('/api/posts', this.post)
          .then(() => {
            this.$alertify.success(`Post created successfully.`)
            this.$inertia.get('/admin')
          })
          .catch(reason => console.warn('Error creating post', reason.response))
      }
    },
    validateForm() {
      this.errors = [];

      if (this.post.title.length < 3) {
        this.errors.push('title:length')
      }

      if (this.post.content.length < 3) {
        this.errors.push('content:length')
      }

      if (this.post.status_id === -1) {
        this.errors.push('status:required')
      }

      return this.errors.length <= 0;
    }
  }
}
</script>

<style>
input, textarea {
  border-width: 1px;
}
</style>
