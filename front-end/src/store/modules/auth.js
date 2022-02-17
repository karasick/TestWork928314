import AuthService from '../../services/AuthService'
import { ACCESS_TOKEN_LOCAL_KEY } from '../../http/consts'

export default {
  state: {
    user: {},
    isUserAuth: false
  },
  getters: {
    activeUser (state) {
      return state.user
    },
    isAuth (state) {
      return state.isUserAuth
    }
  },
  mutations: {
    updateUser (state, user) {
      state.user = user
    },
    updateIsAuth (state, isAuth) {
      state.isUserAuth = isAuth
    }
  },
  actions: {
    async login ({ commit }, loginData) {
      const responseData = await AuthService.login(loginData)

      saveUserData(commit, responseData)
    },
    async register ({ commit }, registerData) {
      const responseData = await AuthService.register(registerData)

      saveUserData(commit, responseData)
    },
    async logout ({ commit }) {
      await AuthService.logout()

      localStorage.removeItem(ACCESS_TOKEN_LOCAL_KEY)

      commit('updateUser', {})
      commit('updateIsAuth', false)
    }
  }
}

function saveUserData (commit, userResponse) {
  localStorage.setItem(ACCESS_TOKEN_LOCAL_KEY, userResponse.token)

  commit('updateUser', userResponse.user)
  commit('updateIsAuth', true)
}
