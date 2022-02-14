<template>
  <div class="container mb-5">
    <!--          <div class="post_info_cat">-->
    <!--            <span>-->
    <!--                <a href="travel.html">Art</a>-->
    <!--                &nbsp;/-->
    <!--                <a href="travel.html">Lifestyle</a>-->
    <!--            </span>-->
    <!--          </div>-->
    <post v-bind:post="post"/>
    <hr class="readmore-break">

    <div class="post-button-wrapper">
      <router-link :to="{ name: 'post', params: { id: `${post.id}` } }" class="readmore">Continue Reading</router-link>
    </div>
  </div>
</template>

<script>
import Post from './Post.vue'

export default {
  name: 'PostPreview',
  components: {
    Post
  },
  props: {
    post: {
      type: Object,
      required: true,
      default: function () {
        return {
          id: 1,
          title: 'post-title',
          content: 'post-content',
          createdAt: '2022-02-04 09:45:05',
          updatedAt: '2022-02-04 09:45:05'
        }
      }
    }
  }
}
</script>

<style scoped>
hr.readmore-break {
  width: 30px;
  margin-right: auto;
  margin-left: auto;
  border-color: #222;
  border-top: 1px solid #222;
}

.readmore {
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
}
</style>
