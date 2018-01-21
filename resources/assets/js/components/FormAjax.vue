<template>
    <form @submit.prevent="onSubmit">
        <input type="text" v-model="name">
        <input type="file" @change="onFileChange($event)">
        <button type="submit">Send</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                name : '',
                pic : null
            }
        },
        methods :{
            onFileChange(event) {
                this.pic = event.target.files[0];
            },
            onSubmit() {
                let formData = new FormData();
                formData.append('name' , this.name);
                formData.append('pic' , this.pic);

                axios.post('/getData' , formData)
                    .then(response => console.log(response))
                    .catch(error => console.log(error));
            }
        }
    }
</script>