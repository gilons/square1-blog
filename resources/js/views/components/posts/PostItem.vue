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
          <div class="lg:border-right lg:border-solid text-center main-title-container w-full">
            <h2 class="text-xl text-title" v-html="title"></h2>
            <p class="mb-0 mt-3 text-grey-dark text-sm italic text-green-600">
              <span v-html="name"></span>
              <span class="font-bold text-4xl">.</span>
              {{ format(poster.created_at) }}
            </p>
            <hr class="md:ml-0 mt-4 border self-center" />
          </div>
          <!-- ./Card title and subtitle -->

          <!-- Card description -->
          <div class="lg:px-3 content-conatiner flex flex-row justify-center items-center w-full text-center">
            <p
              v-html="content"
              class="text-content text-md mt-4 lg:mt-0 text-justify md:text-left text-sm"
            ></p>
          </div>
          <!-- ./Card description -->

          <!-- Call to action button -->
          <div class="text-center md:text-left m-auto">
            <button
              @click="gotoPost()"
              class="bg-white hover:bg-grey-darker shadow-sm p-2 rounded-md -mt-12 view-more-btn"
            >
              Visit now
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
import {formatDate} from "../../../services/dates.service"
const defaultPost = {
  user: {},
};

export default {
  name: "post-item",
  props: {
    post: {
      type: Object,
      default: () => defaultPost,
    },
    search: {
      type: String,
      default: "",
    },
  },
  computed: {
    poster() {
      return this.post || defaultPost;
    },

    content() {
      return this.highlight(this.poster.content);
    },
    title() {
      return this.highlight(this.poster.title);
    },
    name() {
      return this.highlight(this.poster.user.name);
    },
  },
  methods: {
    highlight(content) {
      if (!this.search) {
        return content;
      }

        return content && content.replace(new RegExp(this.search, "gi"), (match) => {
          return (
            '<span style="background-color: rgb(42, 146, 220);color: whitesmoke;">' +
            match +
            "</span>"
          );
        });
    },
    format(date){
      return formatDate(date)
    },
    gotoPost() {
      this.$router.push({
        name: "posts.item",
        params: { slug: this.poster.slug },
      });
    },
  },
  data() {
    return {
      defaultPost: {
        user: {},
      },
    };
  },
};
</script>

<style lang="scss" scoped>

.highlightText {
  background-color: rgb(42, 146, 220);
  color: whitesmoke;
}

.text-content {
  display: -webkit-box;
  -webkit-line-clamp: 6;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.box-dimension {
  max-width: 600px;
  min-width: 300px;
  height: 300px;
}
</style>
