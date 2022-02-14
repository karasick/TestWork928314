<template>
  <div class="container">
      <div class="post-header">
        <div class="post-header-title">
          <h5>{{ post.title }}</h5>
          <hr class="title-break">
          <div class="post-detail post-date">
            <span class="post-info-date">
                <span>Posted On {{ postCreatedAt }}</span>
            </span>
          </div>
        </div>

        <p class="pt-3">{{ post.content }}</p>
      </div>
  </div>
</template>

<script>
export default {
  name: 'Post',
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
  },
  data: function () {
    return {
      postCreatedAt: ''
    }
  },
  methods: {
    getCreatedDate () {
      this.postCreatedAt = new Date(this.post.createdAt).toLocaleString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric'
      })
    }
  },
  created () {
    this.getCreatedDate()
  }
}
</script>

<style lang="scss" scoped>

hr.title-break {
  border-color: #be9656;

  width: 50px;
  margin-right: auto;
  margin-left: auto;
  border-top: 2px solid #222;
}

.post-header {
  .post-detail {
    font-size: 13px;

    .post-info-date {
      color: #999;
    }
  }

  h5 a {
    color: #222222;
  }
}

.post-header p {
  text-align: left;
}
</style>
