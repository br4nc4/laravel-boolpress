<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar-brand">Boolpress</div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="/admin">Admin</a>
                    <router-link :to="{name: 'home'}">Home</router-link>
                    <router-link :to="{name: 'posts'}">Posts</router-link>
                    <router-link :to="{name: 'contacts'}">Contatti</router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
    }
</script>