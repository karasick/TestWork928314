<template>
  <footer>
    <div class="container">
      <p class="mt-5">Copyright &copy; {{ year }} </p>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter',
  computed: {
    year: () => new Date().getFullYear()
  }
}
</script>

<style scoped>

</style>
