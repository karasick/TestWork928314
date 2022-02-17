<template>
  <div class="container">
    <h3 v-if="this.isLoading">Loading...</h3>
    <h3 v-else-if="!this.viewedPost && !this.isLoading">No posts found. Create new one!</h3>
    <post v-else v-bind:post="this.viewedPost"/>
  </div>
</template>

<script>
// @ is an alias to /src
import Post from '../components/Post/Post.vue'
import { mapActions, mapGetters } from 'vuex'

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
  computed: mapGetters(['isLoading', 'viewedPost']),
  methods: {
    ...mapActions(['viewPost', 'loading']),
    async updatePost (id) {
      this.loading(true)
      await this.viewPost({ id })
      this.loading(false)
    }
  },
  mounted () {
    this.updatePost(this.id)

    this.$watch(
      () => this.$route.params,
      (toParams, previousParams) => {
        this.updatePost(toParams.id)
      }
    )
  }
}
</script>
