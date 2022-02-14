<template>
  <div class="container">
    <post v-if="post" v-bind:post="post"/>
    <div v-else>
      <h3>No post with that 'id'.</h3>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Post from '@/components/Post/Post.vue'
import PostService from '@/services/PostService'

export default {
  name: 'PostView',
  components: {
    Post
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      post: null
    }
  },
  methods: {
    async getPost (id) {
      try {
        this.post = await PostService.getOne(id)
      } catch (error) {
        console.log(error)
      }
    }
  },
  created () {
    this.getPost(this.id)

    // this.$watch(
    //   () => this.$route.params,
    //   (toParams, previousParams) => {
    //     console.log('id: ' + this.id)
    //     this.getPost(this.id)
    //   }
    // )
  }
}
</script>
