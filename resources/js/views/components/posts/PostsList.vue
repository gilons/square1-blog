<template>
    <div class="outer-container">
        <div v-if="posts && posts.length" class="scroller">
            <post-item :search="search" v-for="post in posts" :key="post.id" :post="post" />
            <bottom-observer :loading="loading" @intersect="$emit('loadmore')" />
        </div>
        <div
            class="text-8xl text-gray-400 font-medium italic flex text-center items-center m-auto flex-col else-container justify-center"
            v-else
        >
            No Post Available
        </div>
    </div>
</template>

<script>
import BottomObserver from "../BottomObserver.vue";
import PostItem from "./PostItem.vue";
export default {
    name: "posts-list",
    components: { PostItem, BottomObserver },
    props: {
        posts: {
            default: () => [],
            type: Array
        },
        loading: {
            type: Boolean,
            default: false
        },
        search:{
          type:String,
          default:''
        }
    }
};
</script>

<style scoped>
.outer-container {
    width: 100%;
}
.scroller {
    height: 75vh;
    margin-top: 1vh;
    overflow: auto;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.else-container {
    height: 77vh;
}
</style>
