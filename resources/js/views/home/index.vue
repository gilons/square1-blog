<template>
  <div class="m-1 w-full">
    <posts-header
      @search="startSearch($event)"
      @sort="startSort($event)"
      @order="startOrder($event)"
      :title="'All Posts'"
    />
    <div class="posts-container">
      <posts-list
        :search="search"
        :posts="posts"
        @loadmore="loadMore()"
        :loading="nextPageUrl && true"
      ></posts-list>
    </div>
  </div>
</template>

<script>
import PostsList from "../components/posts/PostsList.vue";
import { getPosts } from "../../services/post-services.sevice";
import PostsHeader from "../components/posts/PostsHeader.vue";
import postListMixins from "../../mixins/postsListMixins";
export default {
  components: { PostsList, PostsHeader },
  name: "home",
  props: {
    position: String,
  },
  mixins: [postListMixins],
  
  methods: {
    async fetchData(data) {
      const response = await getPosts(data);
      return response;
    },
  },
};
</script>

<style lang="scss" scoped>
.posts-container {
  display: flex;
}
</style>
