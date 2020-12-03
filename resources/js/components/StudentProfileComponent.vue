<template>

        <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_400">
                <div class="x_title">
                  <h2>Student Profile</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                    <div class="profile clearfix">
						<div class="profile_pic">
							<img  v-bind:src="baseurl + '/' + (user.image ? user.image : defaultImage)" alt="..." class="img-circle profile_img" style="cursor: pointer;" onclick="$('#imageFile').click()">

                            <form @submit.prevent="uploadImage">

                                <input id="imageFile" type="file" @change="imageChanged" accept="image/*" style="display:none;">

                            </form>
						</div>
						<div class="profile_info">
							<h2 style="color:black;">{{ user.name + ' ' + (user.middlename ? user.middlename : '') + ' ' + user.lname}}</h2>
							<span>{{ user.email }}</span>

                            <br>
                            <br>


                            <h2 style="color:black;">Current Level</h2>
                            <span>{{ (user.currentLevel ? user.currentLevel : 'N/a') }}</span>

                            <br>
                            <br>


                            <h2 style="color:black;">Current Section</h2>
                            <span>{{ (user.currentSection ? user.currentSection : 'N/a') }}</span>

                            <br>
                            <br>

                            <h2 style="color:black;">Student No.</h2>
                            <span>{{ (user.studentNo ? user.studentNo : 'N/a') }}</span>
						</div>
					</div>
                </div>
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
