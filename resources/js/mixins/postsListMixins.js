
export default {
    created() {
        this.loadPosts();
    },
    methods: {
        loadPosts(fresh) {
            const data = {
                ...(this.search ? { search: this.search } : {}),
                ...(this.order ? { order: this.order } : {}),
                ...(this.nextPageUrl || {}),
                ...(this.sorter ? { sorter: this.sorter } : {}),
            };
            this.fetchData && this.fetchData(data).then((response) => this.setValues(response, fresh));
        },
        loadMore() {
            if (this.nextPageUrl) {
                this.loadPosts();
            }
        },
        setValues(response, fresh) {
            this.posts = fresh ? response.data : [...this.posts, ...response.data];
            if (response.next_page_url) {
                this.nextPageUrl = { page: response.current_page + 1 };
            } else {
                this.nextPageUrl = null;
            }
        },
        startSearch(val) {
            this.search = val;
            this.reloadPost();
        },
        reloadPost() {
            this.clearNextPage();
            this.$nextTick(function () {
                this.loadPosts(true);
            });
        },
        clearNextPage() {
            this.nextPageUrl = null;
        },
        startSort(val) {
            this.sorter = val;
            this.reloadPost();
        },
        startOrder(value) {
            this.order = value;
            this.reloadPost();
        },
    },
    data() {
        return {
            posts: [],
            search: "",
            sorter: "title",
            order: "asc",
            nextPageUrl: null,
        };
    },
}