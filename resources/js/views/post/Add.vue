<template>
    <div class="w-full">
        <div class="text-2xl text-gray-800 font-semibold m-2">Add Post</div>
        <form
            @submit.prevent="submitPost()"
            class="flex flex-col m-4"
            @keyup="resetErrors()"
        >
            <div class="w-full flex flex-col">
                <label class="text-lg font-medium ml-1">Post title</label>
                <input-field
                    name="title"
                    required
                    v-model="post.title"
                    :type="'text'"
                    :placeholder="'Enter Post title'"
                ></input-field>
                <div v-if="errors.title" class="italic text-red-500">
                    {{ errors.title[0] }}
                </div>
            </div>
            <div class="w-full flex flex-col mt-4 mb-4">
                <label class="text-lg font-medium ml-1">Post Content</label>
                <textarea
                    name="content"
                    required
                    class="h-64 w-full border-gray-600 bg-gray-100 rounded-lg p-4"
                    v-model="post.content"
                    :placeholder="'Enter Post Description'"
                ></textarea>
                <div v-if="errors.content" class="text-xl italic text-red-500">
                    {{ errors.content[0] }}
                </div>
            </div>
            <input
                type="submit"
                name="submit"
                class="w-50 h-14 p-3 rounded-full shadow-sm bg-gray-400 hover:bg-gray-300 text-lg font-medium self-center"
                value="Add"
            />
        </form>
    </div>
</template>

<script>
import { addPost } from "../../services/post-services.sevice";
import InputField from "../components/form/InputField.vue";
export default {
    components: { InputField },
    name: "add-post",
    data() {
        return {
            post: {
                title: "",
                content: ""
            },
            errors: {},
            adding: false
        };
    },
    methods: {
        resetErrors() {
            this.errors = {};
        },
        async submitPost() {
            if (!this.adding) {
                this.adding = true;
                const response = await addPost(this.post);
                if (response.data && response.data.errors) {
                    this.errors = response.data.errors;
                } else {
                    this.$router.push({ name: "my-posts" });
                }
                this.adding = false;
            }
        }
    }
};
</script>

<style></style>
