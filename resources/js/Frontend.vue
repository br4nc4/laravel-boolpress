<template>
    <div>
        <Navbar></Navbar>
        <div class="container">
            <h2>Lista Post</h2>
            <PostList></PostList>
        </div>
    </div>
</template>

<script>
import Navbar from './frontend/components/Navbar.vue';
import PostList from './frontend/components/PostList.vue';
    
    export default {
    components: { Navbar, PostList },
    data() {
        return {

        }
    },
}
</script>