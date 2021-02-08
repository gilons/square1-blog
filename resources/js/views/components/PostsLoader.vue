<template>
  <div class="items-loader">
    <div
      class="bg-gray-100 placeholder-container p-8 flex flex-wrap"
      :key="index"
      v-for="(_, index) in array"
    >
      <div class="placeholder-container p-2">
        <a
          href="/detail/72112620-skoda-octavia-combi-iii-combi-style-green-tec"
          class="flex flex-col relative w-full bg-white overflow-hidden card translate-3d-none-after card translate-3d-none-after rounded border border-gray-300"
        >
          <div class="relative group text-primary-500" style="padding-top: 70%">
            <div class="absolute top-0 left-0 h-full w-full">
              <span
                class="skeleton-box group-hover:scale-110 transition-transform transform-center block h-full"
              ></span>
            </div>
          </div>
          <div class="flex flex-col flex-grow">
            <div class="pl-4 pr-4 pt-4 mb-4 text-left relative flex-grow">
              <h3 class="text-lg font-bold text-gray-darkest mr-10">
                <span class="skeleton-box h-5 w-1/6 inline-block"></span>
                <span class="skeleton-box h-5 w-1/2 inline-block"></span>
                <span class="skeleton-box h-5 w-2/4 inline-block"></span>
                <span class="skeleton-box h-5 w-2/5 inline-block"></span>
              </h3>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "post-loader",
  props: {
    number: {
      type: Number,
      default: 1,
    },
  },
  computed: {
    array() {
      return new Array(this.number);
    },
  },
};
</script>

<style lang="scss" scoped>
//@use postcss-preset-env;
//@use postcss-nested-ancestors;
//@use postcss-nested;
.placeholder-container{
    margin-top: 10px;
    min-width: 600px;
    height: 300px;
    @media (max-width:600px) {
        min-width: 300px;
    }
}
.skeleton-box {
  position: relative;
  overflow: hidden;
  background-color: #e2e8f0;

  &::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    transform: translateX(-100%);
    background-image: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0) 0,
      rgba(255, 255, 255, 0.2) 20%,
      rgba(255, 255, 255, 0.5) 60%,
      rgba(255, 255, 255, 0)
    );
    animation: shimmer 3s infinite;
    content: "";
  }
}
@keyframes shimmer {
  100% {
    transform: translateX(100%);
  }
}

.items-loader {
  display: flex;
  flex-wrap: wrap;
}
</style>