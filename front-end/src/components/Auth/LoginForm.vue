<template>
  <b-card class="p-4" style="width: 600px">
    <b-form class="d-flex flex-column">
      <h2>Login</h2>
      <br/>

      <b-form-group id="input-group-email" class="mb-3">
        <label for="input-email" class="d-flex align-content-start mb-1">Email:</label>
        <b-form-input
          id="input-email"
          v-model="user.email"
          ref="inputEmail"
          type="email"
          placeholder="Enter your email"
          autoComplete="email"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-password" class="mb-3">
        <label for="input-password" class="d-flex align-content-start mb-1">Password:</label>
        <b-form-input
          id="input-password"
          v-model="user.password"
          ref="inputPassword"
          type="password"
          placeholder="Enter your password"
          autoComplete="current-password"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-checkbox
        id="checkbox-rememberMe"
        v-model="user.rememberState"
        name="checkbox-rememberMe"
        class="d-flex flex-row align-items-center mb-1"
        disabled
      >
        <div> Remember me</div>
      </b-form-checkbox>

      <b-form-invalid-feedback :state="validationState" class="flex-column">
        <div class="d-flex align-content-start">Login error: {{ validationError.message }}</div>
        <ul v-for="inputError in validationError.errors" :key="inputError.toString()"
            class="d-flex align-content-start mt-3"
        >
          <li v-for="error in inputError" :key="error.toString()">{{ error }}</li>
        </ul>
      </b-form-invalid-feedback>

      <div class="d-flex align-items-center justify-content-between">
        <div>No account yet? <router-link :to="{ name: 'registration' }">Register!</router-link></div>
        <b-button variant="primary" type="submit" @click="loginUser">Login</b-button>
      </div>
    </b-form>
  </b-card>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'LoginForm',
  data () {
    return {
      user: {
        email: '',
        password: '',
        rememberState: false
      },
      validationState: true,
      validationError: {
        message: '',
        errors: []
      }
    }
  },
  methods: {
    ...mapActions(['login']),
    async loginUser (event) {
      this.validationState = true
      const isEmailValid = this.$refs.inputEmail.validity.valid
      const isPasswordValid = this.$refs.inputPassword.validity.valid
      if (!isEmailValid || !isPasswordValid) {
        return false
      }
      event.preventDefault()

      try {
        await this.login({
          email: this.user.email,
          password: this.user.password
        })
        await this.$router.push({ name: 'home' })
      } catch (error) {
        const responseErrorData = error.response.data
        this.validationState = false
        this.validationError = responseErrorData
      }
    }
  }
}
</script>

<style scoped>

</style>
