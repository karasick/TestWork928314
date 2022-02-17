<template>
  <div class="home">
    <b-button v-if="this.isAuth" @click="showModal" class="mb-5">Create Post</b-button>
    <p v-else class="mb-5"><router-link :to="{ name: 'login' }">Login</router-link> to Create Post!</p>

    <post-form-modal id="postFormModal"/>

    <post-preview-list :posts="allPosts"/>
    <observer @intersect="intersected"/>
  </div>
</template>

<script>
import PostPreviewList from '../components/Post/PostPreviewList.vue'
import PostFormModal from '../components/Post/PostFormModal'
import Observer from '../components/UI/Observer'
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'HomeView',
  components: {
    PostFormModal,
    PostPreviewList,
    Observer
  },
  computed: mapGetters(['allPosts', 'isAuth', 'postsPage', 'postsLimit']),
  methods: {
    ...mapActions(['fetchPosts', 'addPosts', 'loading', 'changePage', 'changeLimit']),
    showModal () {
      this.$bvModal.show('postFormModal')
    },
    async intersected () {
      await this.changePage(this.postsPage + 1)
      this.loading(true)
      await this.addPosts({ page: this.postsPage, limit: this.postsLimit })
      this.loading(false)
    },
    async fetchInitialPosts () {
      this.loading(true)
      await this.fetchPosts({ page: this.postsPage, limit: this.postsLimit })
      this.loading(false)
    }
  },
  mounted () {
    this.changeLimit(4)
    if (this.postsPage === 1) {
      this.fetchInitialPosts()
    }
  }
}
</script>
