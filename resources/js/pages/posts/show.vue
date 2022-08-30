<template>
    <div>
        <div class="container">
            <h2>Dettagli POST #{{post.id}}</h2>

            <div>Titolo: {{post.title}}</div>
            <div>Scritto da: {{post.user.name}}</div>
            <div>Data creazione: {{post.created_at}}</div>
            <div v-if="post.category">Categoria: {{post.category.name}}</div>
            <div v-if="post.tags.length > 0">
                <span>Tags:</span>
                <span v-for="tag in post.tags" :key="tag.id">{{tag.name}}, </span>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                post: {},
            }
        },
        mounted() {
            axios.get("/api/posts/" + this.$route.params.slug)
            .then((resp) => {
                const data = resp.data;
                this.post = data;
            })
        }
    }
</script>