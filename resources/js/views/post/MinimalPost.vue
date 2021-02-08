<template>
  <!-- Container -->
  <div class="shadow-lg flex flex-wrap justify-items-center m-6">
    <!-- Card body -->
    <div class="box-dimension bg-white">
      <!-- Card body - outer wrapper -->
      <div class="mx-auto px-6">
        <!-- Card body - inner wrapper -->
        <div
          class="bg-white p-6 -mt-6 md:mt-0 mb-4 md:mb-0 flex flex-wrap md:flex-wrap items-center justify-between"
        >
          <!-- Card title and subtitle -->
          <div class="lg:border-right lg:border-solid text-center w-full">
            <h2 class="text-xl text-title" v-html="poster.title"></h2>
            <p class="mb-0 mt-3 text-grey-dark text-sm italic text-green-600">
              <span v-html="poster.user.name"></span>
              <span class="font-bold text-4xl">.</span>
              {{ format(poster.created_at) }}
            </p>
            <hr class="md:ml-0 mt-4 border self-center" />
          </div>
          <!-- ./Card title and subtitle -->

          <!-- Call to action button -->
          <div class="text-center md:text-left m-auto">
            <button
              @click="gotoPost()"
              class="bg-white hover:bg-grey-darker shadow-sm p-2 rounded-md view-more-btn"
            >
              Read now
            </button>
          </div>
          <!-- ./Call to action button -->
        </div>
        <!-- ./Card body - inner wrapper -->
      </div>
      <!-- ./Card body - outer wrapper -->
    </div>
    <!-- ./Card body -->
  </div>
  <!-- ./Container -->
</template>

<script>
import { formatDate } from "../../services/dates.service";
const defaultPost = {
  user: {},
};
export default {
  name: "post-minial",
  props: {
    hard: {
      type: Boolean,
      default: false,
    },
    post: {
      type: Object,
      default: defaultPost,
    },
  },
  computed: {
    poster() {
      return this.post || defaultPost;
    },
  },
  methods: {
    format(date) {
      return formatDate(date);
    },
    gotoPost() {
      this.$router.push({
        name: "posts.item",
        params: { slug: this.poster.slug },
      });
      this.hard && this.$router.go(this.$router.currentRoute);
    },
  },
};
</script>

<style lang="scss" scoped>
.box-dimension {
  max-width: 250px;
  min-width: 200px;
  height: 200px;
}
</style>