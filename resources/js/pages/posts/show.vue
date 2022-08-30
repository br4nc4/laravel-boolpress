<template>
    <div>
        <div class="container">
            <h2>Dettagli Post</h2>
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
            axios.get("api/posts/" + this.$route.params.slug)
            .then((resp) => {
                const data = resp.data;
                this.post = data;
            })
        }
    }
</script>