<template>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-xs-12">
          <div class="logo">
            <router-link to="/">
              <img src="../../assets/logo.png" alt="App logo" height="50">
            </router-link>
          </div>
        </div>
        <div class="col-md-9 col-xs-12">
          <div class="main-menu text-right">
            <nav>
              <ul class="menu">
                <li><router-link :to="{ name: 'home' }">HOME</router-link></li>
                <li><router-link :to="{ name: 'about' }">ABOUT</router-link></li>
                <li><router-link :to="{ name: 'home' }">CONTACT</router-link></li>
                <li v-if="this.isAuth"><button @click.prevent="logoutUser">LOGOUT</button></li>
                <li v-else><router-link :to="{ name: 'login' }">LOGIN</router-link></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'AppHeader',
  computed: mapGetters(['isAuth']),
  methods: {
    ...mapActions(['logout']),
    async logoutUser () {
      try {
        await this.logout()
        await this.$router.push({ name: 'home' })
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>

<style lang="scss" scoped>

.logo {
  margin-top: 24px;

  a {
    color: #222;
    font-family: "Dosis",sans-serif;
    font-size: 22px;
    font-weight: 600;
    letter-spacing: 1px;
  }
}

.main-menu {
  ul {
    padding-left: 0px;

    li {
      display: inline-block;
      margin-left: 15px;
      margin-right: 15px;
      padding: 30px 0;
      position: relative;

      a, button {
        color: #464646;
        font-family: "Lato",sans-serif;
        font-size: 13px;
        font-weight: 400;
        position: relative;
        text-transform: uppercase;
      }

      button {
        border: none;
        background: transparent;
        padding: 0px;
      }
    }

    li:hover > a {
      color:#999
    }
  }
}

</style>
