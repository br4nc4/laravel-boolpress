<template>
    <div class="form-group">
        <label :for="name + '_file'" class="form-label">Immagine di copertina</label>

        <input type="file" :name="name" class="form-control-file" @change="onFileChange" :id="name + '_file'">

        <div class="mt-2">Antemprima</div>
        <div class="mb-2">
            <img class="img-thumbnail" style="width: 250px" :src="thumbnailLink"></img>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: String,
        },
        data(){
            return {
                thumbnailLink: "",
            }
        },  
        methods: {
            onFileChange(e) {
                const files = e.target.files;
                const firstFile = files[0];

                if(!firstFile){
                    this.thumbnailLink = "";
                    return 
                }

                //crea un URL temporaneo per visualizzare un file appena caricato
                this.thumbnailLink = URL.createObjectURL(firstFile);
            }
        }
    }
</script>