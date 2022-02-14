<template>
    <section class="container mt-4">

        <h2>All posts</h2>

        <div v-if="posts">

            <div class="row">

                <div class="col-4 mb-4 h-100"
                    v-for="post in posts" :key="`post-${post.id}`">

                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="card-title">{{ post.title }}</h5>
                        </div>
                        <div class="card-img">
                            <img :src="post.cover" :alt="post.title">
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ extractString( post.content, 120) }}</p>

                            <button class="btn btn-primary">
                                <router-link class="text-white text-decoration-none" :to="{ name: 'post-detail', params: { slug: post.slug } }">See more</router-link>
                            </button>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">{{ getDate( post.created_at ) }}</p>
                        </div>
                    </div>
                </div>
            </div>
                
            <button class="btn btn-primary"
                    :disabled="pagination.currentPage === 1"
                    @click="getPosts(pagination.currentPage - 1)">
                    Prev
            </button>

            <button class="btn"
                    v-for="i in pagination.lastPage"
                    :key="`page-${i}`"
                    @click="getPosts(i)"
                    :class="pagination.currentPage === i ? 'btn-primary' : 'btn-secondary'">
                    {{ i }}
            </button>


            <button class="btn btn-primary"
                    :disabled="pagination.currentPage === pagination.lastPage"
                    @click="getPosts(pagination.currentPage + 1)">
                    next
            </button>


        </div>
        <Loading v-else />

    </section>
</template>

<script>
import axios from "axios";
import Loading from "../components/Loading";

export default {
    name: 'Blog',
    components: {
        Loading,
    },
    data () {
        return {
            posts: null,
            pagination: null,
        }
    },
    created() {
        this.getPosts()
    },
    methods: {
        getPosts(page = 1) {

            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
            .then(res => {

                this.posts= res.data.data;

                this.pagination = {
                    currentPage: res.data.current_page,
                    lastPage: res.data.last_page,
                }
            });
        },
        extractString(string, maxLetter) {

            if (string.length > maxLetter) {
                return string.substring(0, maxLetter) + '...';
            }

            return string;
        },
        getDate(postDate) {

            const date = new Date(postDate);

            const formatted = new Intl.DateTimeFormat('it-IT').format(date)

            return formatted;
        }
    }
}

</script>

<style>

</style>