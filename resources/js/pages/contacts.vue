<template>
    <div>
        <div class="container">
            <h2>Contattaci</h2>

            <form @submit.prevent="onFormSubmit" action="">
                <input type="text" placeholder="Nome" v-model="name">
                <br>

                <textarea name="" id="" cols="60" rows="10" placeholder="Messaggio" v-model="message"></textarea>

                <button type="submit">Invia</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                name: "",
                message: "",
            }
        },
        methods: {
            onFormSubmit() {
                axios.post("/api/contacts", {
                    name: this.name,
                    message: this.message
                })
            }
        }
    }
</script>