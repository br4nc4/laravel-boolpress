<template>
    <div>
        <div class="container">
            <h2>Lista Post</h2>
            <PostList></PostList>
        </div>
    </div>
</template>

<script>
import PostList from '../frontend/components/PostList.vue';

    export default {
        components: { PostList },
    }
</script>