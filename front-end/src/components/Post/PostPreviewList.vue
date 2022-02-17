<template>
  <div>
    <h3 v-if="this.posts.length === 0 && !this.isLoading">No posts found. Create new one!</h3>
    <div v-else v-for="post in this.posts" :key="post.id">
      <post-preview v-bind:post="post"/>
    </div>
    <h3 v-if="this.isLoading">Loading...</h3>
  </div>
</template>

<script>
import PostPreview from './PostPreview'
import { mapGetters } from 'vuex'

export default {
  name: 'PostPreviewList',
  components: {
    PostPreview
  },
  props: {
    posts: {
      type: Array,
      default: function () {
        return [
          {
            id: 1,
            title: 'post-title-1',
            content: 'post-content',
            createdAt: '2022-02-04 09:45:05',
            updatedAt: '2022-02-04 09:45:05'
          },
          {
            id: 2,
            title: 'post-title-2',
            content: 'post-content-2',
            createdAt: '2022-02-05 09:45:06',
            updatedAt: '2022-02-05 09:45:06'
          }
        ]
      }
    }
  },
  computed: mapGetters(['isLoading'])
}
</script>

<style scoped>

</style>
