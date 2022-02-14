import PostService from '../../services/PostService'

export default {
  state: {
    posts: []
  },
  mutations: {
    updatePosts (state, posts) {
      state.posts = posts
    },
    addToPosts (state, post) {
      state.posts.unshift(post)
    }
  },
  actions: {
    async fetchPosts ({ commit }) {
      try {
        const posts = await PostService.getAll()
        commit('updatePosts', posts)
      } catch (error) {
        console.log(error)
      }
    },
    async createPost ({ commit }, post) {
      const newPost = await PostService.create(post)
      commit('addToPosts', newPost)
    }
  },
  getters: {
    allPosts (state) {
      return state.posts
    }
  }
}
