<template>
  <div class="header-container z-20">
    <div
      class="text-gray-900 z-20 container hover:text-gray-600 posts-header font-semibold text-2xl rounded-md mt-1"
    >
      <div class="flex title-text">
        {{ title }}
      </div>
      <div class="flex">
        <div class="flex flex-row justify-between items-center m-1">
          <div class="w-32 ml-3 h-9">
            <select-input :options="sorters" v-model="sorter" />
          </div>
          <div class="ml-2">
            <select-input :options="orders" v-model="orderer" />
          </div>
          <div class="ml-2">
            <input-field
              :type="'text'"
              v-model="search"
              :placeholder="'Enter Search'"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InputField from "../form/InputField.vue";
import SelectInput from "../form/SelectInput.vue";
export default {
  components: { InputField, SelectInput },
  name: "posts-header",
  props: {
    title: String,
  },
  computed: {
    sorter: {
      get() {
        return this.currentSort;
      },
      set(val) {
        this.$emit("sort", val);
        this.currentSort = val;
      },
    },
    orderer: {
      get() {
        return this.currentOrder;
      },
      set(val) {
        this.$emit("order", val);
        this.currentOrder = val;
      },
    },
  },
  data() {
    return {
      search: "",
      debounceSearch: _.debounce(function (val) {
        this.$emit("search", val);
      }, 1000),
      currentSort: "title",
      currentOrder: "asc",
      orders: [
        {
          title: "ASC",
          value: "asc",
        },
        {
          title: "DESC",
          value: "desc",
        },
      ],
      sorters: [
        {
          title: "Title",
          value: "title",
        },
        {
          title: "Publication Date",
          value: "created_at",
        },
      ],
    };
  },
  watch: {
    search(val) {
      this.debounceSearch(val);
    },
  },
};
</script>

<style lang="scss" scoped>
.title-text {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.posts-header {
  background-color: white;
  box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
  padding-top: 0px;
  min-width: 100%;
  flex-wrap: wrap;
  min-height: 50px;
  width: 100%;
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  align-items: center;
}
.header-container {
  padding-right: 8px;
  width: 100%;
}
</style>
