<template>
  <div class="text-xl text-gray-500 items-start m-3 pt-24">
    Want to read more ...
    <div class="w-full p-3 flex flex-row flex-wrap items-center justify-center">
      <minimal-post
        :hard="hard"
        :post="post"
        v-for="post in posts"
        :key="post.id"
      />
      <div
        class="h-32 w-40 shadow-xl cursor-pointer flex flex-row items-center justify-center rounded-full view-more-btn"
        @click="gotoAll()"
      >
        View All
      </div>
    </div>
  </div>
</template>

<script>
import { geRandomPost } from "../../services/post-services.sevice";
import MinimalPost from "./MinimalPost.vue";
export default {
  components: { MinimalPost },
  name: "extra-posts",
  props: {
    hard: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    gotoAll() {
      if (this.hard) {
        window.location = "/";
      } else {
        this.$router.push({ name: "home" });
      }
    },
  },
  mounted() {
    geRandomPost().then((res) => {
      this.posts = res;
    });
  },
  data() {
    return {
      posts: [],
    };
  },
};
</script>

<style>
</style>