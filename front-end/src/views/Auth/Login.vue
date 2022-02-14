<template>
  <b-container class="mt-5 d-flex justify-content-center align-content-center">
    <login-form></login-form>
  </b-container>
</template>

<script>
import LoginForm from '../../components/Auth/LoginForm'

export default {
  name: 'LoginView',
  components: {
    LoginForm
  }
}
</script>
