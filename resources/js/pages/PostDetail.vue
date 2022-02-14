<template>

    <section class="container">

            
        <h1 class="mb-5">This is your Post</h1>

        <div v-if="post">

            <div class="row text-center mb-5">

                <h1 class="w-100 mb-3">{{ post.title }}</h1>

                <p class="mb-3">
                    {{ post.content}}
                </p>

                <span>
                    Date: {{ post.date_formatted}}
                </span>

                <figure v-if="post.cover" class="card-img">
                    <img :src="post.cover" :alt="post.title">
                </figure>

                <div class="mb-3 text-center" v-if="post.category">
                    <h4 class="mb-2">Category</h4>
                    <div class="badge badge-primary">{{ post.category.name }}</div>
                </div>

                <div v-if="post.tags.length != 0">
                    <Tags :list="post.tags" />
                </div>
                
            </div>
        </div>
        <Loading v-else />

    </section>
</template>

<script>
import axios from "axios";
import Loading from "../components/Loading";
import Tags from "../components/Tags";

export default {
    name: 'PostDetail',
    components: {
        Loading,
        Tags,
    },
    data () {
        return {
            post: null,
        }
    },
    created() {
        this.getPosts()
    },
    methods: {
        getPosts() {

            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
            .then(res => {

                if (res.data.not_found) {

                    this.$router.push({name: 'not_found'});
                }
                else{
                    this.post= res.data;
                }
            });
        }
    }
}
</script>

<style lang="scss">

</style>