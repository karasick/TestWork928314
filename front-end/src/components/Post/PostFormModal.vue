<template>
  <b-modal
    v-bind="$attrs"
    title="Create Post"
    ok-title="Submit"
    @ok.prevent="submit"
    @hide="reset"
    ref="postModal"
    centered
  >
    <b-form @submit="submit" @reset.prevent="reset">
      <b-form-group
        id="input-group-title"
        label="Post Title:"
        label-for="input-title"
        class="mb-3"
      >
        <b-form-input
          id="input-title"
          v-model="post.title"
          type="text"
          placeholder="Enter post title"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-content"
        label="Post Content:"
        label-for="input-content"
        class="mb-3"
      >
        <b-form-textarea
          id="input-content"
          v-model="post.content"
          placeholder="Describe post here..."
          rows="3"
          max-rows="6"
          required
        ></b-form-textarea>
      </b-form-group>
    </b-form>
  </b-modal>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'PostForm',
  data () {
    return {
      post: {
        title: '',
        content: ''
      }
    }
  },
  methods: {
    ...mapActions(['createPost']),
    async submit (event) {
      event.preventDefault()

      try {
        await this.createPost(this.post)
        this.$refs.postModal.hide()
      } catch (error) {
        console.log(error)
      }
    },
    reset () {
      this.post.title = ''
      this.post.content = ''
    }
  }
}
</script>

<style scoped>

</style>
