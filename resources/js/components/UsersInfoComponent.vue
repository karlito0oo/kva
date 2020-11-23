<template>
    <div class="profile clearfix">
        <div class="profile_pic">
        <img v-bind:src="baseurl+user.profilePict" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{ user.name }}</h2>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['baseurl'],

        data() {
            return {
                user:{
                    profilePict: '/img.jpg',
                    name: '',
                },
            }
        },
        
        methods: {
            getLoggedinUser(){
                axios.post('/api/loggedinUser')
                .then((res) => {
                    this.user.name = res.data.name;
                    this.user.email = res.data.email;
                   console.log(res);
                })
                .catch((err) => {
                    alert(err);
                    console.log(err);
                });
            },
        },

        mounted() {
            this.getLoggedinUser();
        }
    }
</script>
