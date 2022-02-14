<template>
  <b-card class="p-4" style="width: 600px">
    <b-form class="d-flex flex-column" >
      <h2>Register</h2>
      <br/>

      <b-form-group id="input-group-name" class="mb-3">
        <label for="input-name" class="d-flex align-content-start mb-1">Name:</label>
        <b-form-input
          id="input-name"
          v-model="user.name"
          ref="inputName"
          type="text"
          placeholder="Enter your name"
          autoComplete="name"
          required
        ></b-form-input>
      </b-form-group>

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
          autoComplete="new-password"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-password-confirmation" class="mb-3">
        <label for="input-password-confirmation" class="d-flex align-content-start mb-1">Password confirmation:</label>
        <b-form-input
          id="input-password-confirmation"
          v-model="user.passwordConfirmation"
          ref="inputPasswordConfirmation"
          type="password"
          placeholder="Re-enter your password"
          autoComplete="new-password"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-invalid-feedback :state="validationState" class="flex-column">
        <div class="d-flex align-content-start">Registration error: {{ validationError.message }}</div>
        <ul v-for="inputError in validationError.errors" :key="inputError.toString()"
            class="d-flex align-content-start mt-3"
        >
          <li v-for="error in inputError" :key="error.toString()">{{ error }}</li>
        </ul>
      </b-form-invalid-feedback>

      <div class="d-flex align-items-center justify-content-between">
        <div>Already have account? <router-link :to="{ name: 'login' }">Login!</router-link></div>
        <b-button variant="primary" type="submit" @click="registerUser">Register</b-button>
      </div>
    </b-form>
  </b-card>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'RegistrationForm',
  data () {
    return {
      user: {
        name: '',
        email: '',
        password: '',
        passwordConfirmation: ''
      },
      validationState: true,
      validationError: {
        message: '',
        errors: []
      }
    }
  },
  methods: {
    ...mapActions(['register']),
    async registerUser (event) {
      const isNameValid = this.$refs.inputName.validity.valid
      const isEmailValid = this.$refs.inputEmail.validity.valid
      const isPasswordValid = this.$refs.inputPassword.validity.valid
      const isPasswordConfirmationValid = this.$refs.inputPasswordConfirmation.validity.valid
      if (!isNameValid || !isEmailValid || !isPasswordValid || !isPasswordConfirmationValid) {
        return false
      }
      event.preventDefault()

      try {
        await this.register({
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
          passwordConfirmation: this.user.passwordConfirmation
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
