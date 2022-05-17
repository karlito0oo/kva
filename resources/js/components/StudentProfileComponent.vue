<template>

        <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_400">
                <div class="x_title">
                  <h2>Student Profile</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                    <div class="profile clearfix">
						<div class="profile_pic">
							<img  v-bind:src="baseurl + '/' + (user.image ? user.image : defaultImage)" alt="..." class="img-circle profile_img" style="cursor: pointer;" onclick="$('#imageFilee').click()">

                            <form @submit.prevent="uploadImage">

                                <input id="imageFilee" type="file" @change="imageChangedd" accept="image/*" style="display:none;">

                            </form>
						</div>
						<div class="profile_info">
							<h2 style="color:black;">{{ user.name + ' ' + (user.middlename ? user.middlename : '') + ' ' + user.lname}}</h2>
							<span>{{ user.email }}</span>

                            <br>
                            <br>


                            <h2 style="color:black;">Grade Level</h2>
                            <span>{{ (user.currentEnrollment ? user.currentEnrollment.levelName : 'N/a') }}</span>

                            <br>
                            <br>


                            <h2 style="color:black;">Section Code</h2>
                            <span>{{ (user.currentEnrollment ? user.currentEnrollment.sectionName : 'N/a') }}</span>

                            <br>
                            <br>

                            <h2 style="color:black;">Student No.</h2>
                            <span>{{ (currentSettings.id_no_prefix + user.id ) }}</span>
						</div>
					</div>
                </div>
              </div>
            </div>

</template>

<script>
import Noty from 'noty';
    export default {

        props: ['baseurl', 'student', 'settings'],
        
        data() {
            return {
                defaultImage: 'default.png',
                user: JSON.parse(this.student),
                currentSettings: JSON.parse(this.settings),
            }
        },
        
        methods: {

            imageChangedd(e){

                var fileReader = new FileReader();

                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.user.image = e.target.result;

                        axios.post('/api/uploadImage/StudentImage', this.user)
                        .then((res) => {
                            alert(res.data);
                            this.user.image = res.data;
                            new Noty({type: 'success', text: 'Successfully changed picture.', layout: 'topRight'}).show();
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            }
        },

        mounted() {
        }
    }
</script>
