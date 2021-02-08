<template>
    <div class="observer">
       <posts-loader v-if="loading" :number="number"/>
    </div>
</template>

<script>
import PostsLoader from './PostsLoader.vue';
export default {
  components: { PostsLoader },
    name: "observer",
    props: {
        loading: {
            type: Boolean,
            default: false
        },
        number: {
            type: Number,
            default: 1
        }
    },
    data() {
        return {
            observer: null
        };
    },
    mounted() {
        this.observer = new IntersectionObserver(([entry]) => {
            if (entry && entry.isIntersecting) {
                this.$emit("intersect");
            }
        });

        this.observer.observe(this.$el);
    }
};
</script>

<style scoped>
.observer {
    height: 1px;
}
</style>
