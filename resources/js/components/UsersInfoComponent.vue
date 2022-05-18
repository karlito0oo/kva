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
class Errors{
    constructor(){
        this.errors = {};
    }
    get(field){
        const keys = Object.keys(this.errors);

        var err = '';
        for (var a = 0; a < keys.length; a++) {
            err += this.errors[keys[a]] + "<br>";
        }
        return err;
    }
    record(errors){
        this.errors = errors.errors
    }
}

import Noty from 'noty';
    export default {

        props: ['baseurl', 'accessing'],

        data() {
            return {
                defaultImage: 'default.png',
                user:{},
                errors: new Errors(),
            }
        },
        
        methods: {
            getLoggedinUser(){
                var self = this;
                axios.post('/api/loggedinUser')
                .then((res) => {
                    this.user = res.data;

                    if(this.accessing == 'student'){
                        axios.patch('../api/users/'+this.user.id, this.user)
                        .then((res) => {
                        })
                        .catch((err) => {
                            this.errors.record(err.response.data);
                            new Noty({type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                        });

                        if(!this.user.is_fully_verified){
                            new Noty({
                            text: 'We detected that your email address is not fully verified, verify it now?',
                            type: 'warning', 
                            buttons: [
                                {
                                    addClass: 'btn btn-success btn-sm', text: 'Yes', onClick: function($noty) {
                                        axios.get('/api/students/send-fully-verify-link/'+self.user.id)
                                        .then((res) => {
                                            new Noty({type: 'success', text: 'We sent an email to verify your account.', layout: 'topRight'}).show();
                                        })
                                        .catch((err) => {
                                            console.log(err); 
                                        });
                                    }
                                },
                                {
                                    addClass: 'btn btn-primary btn-sm', text: 'No', onClick: function($noty) {
                                        $noty.close();
                                    }
                                }
                            ]
                        });
                        }
                    }
                    
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

                        axios.post('/api/uploadImage/StudentImage', this.user)
                        .then((res) => {
                            new Noty({type: 'success', text: 'Successfully changed picture.', layout: 'topRight'}).show();
                            this.getLoggedinUser();
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
            
        },

        mounted() {
            this.getLoggedinUser();
        }

    }
</script>
