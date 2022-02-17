<template>
  <div style="height: 20px;"></div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Observer',
  props: ['options'],
  data () {
    return {
      observer: null
    }
  },
  computed: mapGetters(['isLoading']),
  mounted () {
    const options = this.options || {}
    this.observer = new IntersectionObserver(([entry]) => {
      if (entry && entry.isIntersecting && !this.isLoading) {
        this.$emit('intersect')
      }
    }, options)

    this.observer.observe(this.$el)
  },
  destroyed () {
    this.observer.disconnect()
  }
}
</script>

<style scoped>

</style>
