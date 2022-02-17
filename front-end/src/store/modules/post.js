import PostService from '../../services/PostService'
import { uniqBy } from 'lodash'

export default {
  state: {
    posts: [],
    viewedPost: {},
    page: 1,
    limit: 10
  },
  getters: {
    allPosts (state) {
      return state.posts
    },
    viewedPost (state) {
      return state.viewedPost
    },
    postsPage (state) {
      return state.page
    },
    postsLimit (state) {
      return state.limit
    }
  },
  mutations: {
    updatePosts (state, posts) {
      state.posts = posts
    },
    updatePage (state, page) {
      state.page = page
    },
    updateLimit (state, limit) {
      state.limit = limit
    },
    addUniquePosts (state, posts) {
      const uniquePosts = uniqBy([...state.posts, ...posts], 'id')
      state.posts = uniquePosts
    },
    addNewToPosts (state, post) {
      state.posts.unshift(post)
    },
    updateViewedPost (state, post) {
      state.viewedPost = post
    }
  },
  actions: {
    async fetchPosts ({ commit }, params = { page: 1, limit: 10 }) {
      const postsData = await PostService.getLimit(params.page, params.limit)
      console.log(postsData)
      commit('updatePosts', postsData.data)
    },
    async changePage ({ commit }, page) {
      commit('updatePage', page)
    },
    async changeLimit ({ commit }, limit) {
      commit('updateLimit', limit)
    },
    async addPosts ({ commit }, params = { page: 1, limit: 10 }) {
      const postsData = await PostService.getLimit(params.page, params.limit)
      commit('addUniquePosts', postsData.data)
    },
    async createPost ({ commit }, post) {
      const newPost = await PostService.create(post)
      commit('addNewToPosts', newPost)
    },
    async viewPost ({ commit, state }, { id }) {
      const post = await PostService.getOne(id)
      commit('updateViewedPost', post)
    }
  }
}
