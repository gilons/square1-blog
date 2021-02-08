<template>
  <div class="post-page-container">
    <div class="post-item-container">
      <div class="text-2xl text-center font-semibold m-3 text-gray-800">
        {{ post.title }}
      </div>
      <div class="italic text-lg text-gray-500 self-start m-3">
        By {{ post.user.name }} on {{ format(post.created_at) }}
      </div>
      <div class="text-xl m-3" v-html="post.content"></div>
      <extra-posts />
    </div>
  </div>
</template>

<script>
import { formatDate } from "../../services/dates.service";
import { getPost } from "../../services/post-services.sevice";
import ExtraPosts from "./ExtraPosts.vue";

const defaultPost = {
  user: {},
};
export default {
  components: { ExtraPosts },
  name: "single-post",
  computed: {
    post() {
      return this.poster || defaultPost;
    },
  },
  methods: {
    format(date) {
      return formatDate(date);
    },
  },
  data() {
    return {
      poster: defaultPost,
    };
  },
  mounted() {
    const slug = this.$route.params.slug;
    console.warn("slug", slug);
    getPost(slug).then((res) => {
      this.poster = res;
    });
  },
};
</script>

<style scoped>
</style>
