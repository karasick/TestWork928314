<template>
  <div class="home">
    <b-button v-if="this.isAuth" @click="showModal" class="mb-5">Create Post</b-button>
    <p v-else class="mb-5"><router-link :to="{ name: 'login' }">Login</router-link> to Create Post!</p>
    <post-form-modal id="postFormModal"></post-form-modal>
    <post-preview-list :posts="allPosts"/>
  </div>
</template>

<script>
import PostPreviewList from '../components/Post/PostPreviewList.vue'
import PostFormModal from '../components/Post/PostFormModal'
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'HomeView',
  components: {
    PostFormModal,
    PostPreviewList
  },
  computed: mapGetters(['allPosts', 'isAuth']),
  methods: {
    ...mapActions(['fetchPosts']),
    showModal () {
      this.$bvModal.show('postFormModal')
    }
  },
  mounted () {
    this.fetchPosts()

    // this.$watch(
    //   () => this.$route.params,
    //   (toParams, previousParams) => {
    //     this.getPosts()
    //   }
    // )
  }
}
</script>
