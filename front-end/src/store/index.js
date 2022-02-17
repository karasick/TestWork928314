import Vue from 'vue'
import Vuex from 'vuex'
import app from './modules/app'
import auth from './modules/auth'
import post from './modules/post'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    app,
    auth,
    post
  }
})
