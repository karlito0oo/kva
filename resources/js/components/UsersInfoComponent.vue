<template>
    <div class="profile clearfix">
        <div class="profile_pic">
        <img  v-bind:src="baseurl + '/' + (user.image ? user.image : defaultImage)" alt="..." class="img-circle profile_img" style="cursor: pointer;" onclick="$('#imageFile').click()">

        <form @submit.prevent="uploadImage">
            <input id="imageFile" type="file" @change="imageChanged" accept="image/*" style="display:none;">
        </form>
        
        </div>
        <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{ user.name }}</h2>
        </div>
    </div>
</template>

<script>
import Noty from 'noty';
    export default {

        props: ['baseurl'],

        data() {
            return {
                defaultImage: 'default.png',
                user:{},
            }
        },
        
        methods: {
            getLoggedinUser(){
                axios.post('/api/loggedinUser')
                .then((res) => {
                    this.user = res.data;
                })
                .catch((err) => {
                    alert(err);
                    console.log(err);
                });
            },

            imageChanged(e){

                var fileReader = new FileReader();

                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.user.image = e.target.result;

                        axios.post('../api/uploadImage/StudentImage', this.user)
                        .then((res) => {
                            new Noty({type: 'success', text: 'Successfully changed picture.', layout: 'topRight'}).show();
                            this.getLoggedinUser();
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            }
        },

        mounted() {
            this.getLoggedinUser();
        }
    }
</script>
