<template>
  <b-container class="mt-5 d-flex justify-content-center align-content-center">
    <registration-form></registration-form>
  </b-container>
</template>

<script>
import RegistrationForm from '../../components/Auth/RegistrationForm'

export default {
  name: 'RegistrationView',
  components: {
    RegistrationForm
  }
}
</script>
