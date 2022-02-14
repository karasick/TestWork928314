<template>
  <div>
    <div v-for="post in posts" :key="post.id">
      <post-preview v-bind:post="post"/>
    </div>
  </div>
</template>

<script>
import PostPreview from './PostPreview'

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
  }
}
</script>

<style scoped>

</style>
