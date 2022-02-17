export default {
  state: {
    isAppInLoading: false
  },
  getters: {
    isLoading (state) {
      return state.isAppInLoading
    }
  },
  mutations: {
    updateIsLoading (state, boolean) {
      state.isAppInLoading = boolean
    }
  },
  actions: {
    loading ({ commit }, state) {
      commit('updateIsLoading', state)
    }
  }
}
