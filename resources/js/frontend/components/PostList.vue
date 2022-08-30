<template>
    <div class="row row-cols-3">
        <div class="col" v-for="post in posts" :key="post.id">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" :src="post.cover_img" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text" v-html="post.content"></p>
                    <a href="#" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                posts: [],
            }
        },
        methods: {
            fetchPosts() {
                axios.get("/api/posts")
                .then((resp) => {
                    this.posts = resp.data;
                })
            }
        },
        mounted() {
            this.fetchPosts();
        }
    }
</script>

<style>
    .card-img-top{
        aspect-ratio: 16/9;
        object-fit: cover;
    }
</style>