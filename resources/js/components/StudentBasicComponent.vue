<template>
            <div class="col-md-8 col-sm-8  ">
                
				<form class="form-horizontal form-label-left" @submit.prevent="saveData()">

                <div class="x_panel">
                  <div class="x_title">
                    <h2> STUDENT DETAILS</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="home" aria-selected="true">Basic Informationn</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="guardian-tab" data-toggle="tab" href="#guadian" role="tab" aria-controls="profile" aria-selected="false">Guardian</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="school-tab" data-toggle="tab" href="#school" role="tab" aria-controls="profile" aria-selected="false">Previous Schools</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="requirements-tab" data-toggle="tab" href="#requirements" role="tab" aria-controls="profile" aria-selected="false">Requirements</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                            <br>

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Last Name" v-model="student.lname">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="text" class="form-control" id="inputSuccess3" placeholder="First Name" v-model="student.name">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Middle Name"  v-model="student.middlename">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input disabled type="tel" class="form-control" id="inputSuccess5" placeholder="Email" v-model="student.email">
                                <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Address *" v-model="student.address">
                                <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="number" class="form-control" id="inputSuccess5" placeholder="Contact No. *" v-model="student.contactno">
                                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <br><br>
                            <br><br>
                            <br><br>
                            <br><br>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">BIRTHDATE</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="date" class="form-control" v-model="student.birthday">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">BIRTH PLACE</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Birth place" v-model="student.birthplace">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">GENDER</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="" id=""  class="form-control" v-model="student.gender">
                                        <option :value=null>Select Gender</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">CIVIL STATUS </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="" id=""  class="form-control" v-model="student.civilStatus">
                                        <option :value=null>Select Civil Status</option>
                                        <option>Single</option>
                                        <option>Married</option>
                                        <option>Widowed</option>
                                        <option>Anulled</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3">RELIGION </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Religion" v-model="student.religion">
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">NATIONALITY</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Nationality" v-model="student.nationality">
                                </div>
                            </div>

                        
                      </div>

                      <div class="tab-pane fade" id="guadian" role="tabpanel" aria-labelledby="guadian-tab">
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">GUARDIAN NAME </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Guardian Name" v-model="student.guardianName">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">GUARDIAN CONTACT NO. </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" placeholder="Guardian Contact No." v-model="student.guardianContactNo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">ADDRESS </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Address" v-model="student.guardianAddress">
                                </div>
                            </div>
                      </div>


                      <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">ELEMENTARY </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Elementary" v-model="student.elementary">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">ADDRESS </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Address" v-model="student.elementaryAddress">
                                </div>
                            </div>

                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">HIGHSCHOOL </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="High school" v-model="student.highschool">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">ADDRESS </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Address" v-model="student.highschoolAddress">
                                </div>
                            </div>

                      </div>

                      <div class="tab-pane fade" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
                            
                            <input id="requirementsImage" type="file" @change="requirementChanged" accept="application/pdf" style="display:none;">

                            <div class="row">
                                <div class="col-md-4" style="height:100%;">
                                    <div class="thumbnail" style="height:100%;">
                                    <a v-if="student.birthCertificate" :href="('/images/studentPSA/' + student.birthCertificate)" target="_blank">{{student.lname + ", " + student.name + " - PSA"}}</a>
                                    <div class="image view view-first" style="height:100%;">
                                        <img v-if="!student.birthCertificate" style="width: 100%; display: block;" v-bind:src="'/images/studentPSA/images/noimageavailable.jpg'" alt="image" />
                                        <div class="mask"  style="height:100%;">
                                        <p> </p>
                                        <div class="tools tools-bottom" style="height:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>PSA BIRTH CERTIFICATE

                                            <a v-bind:href=" (student.birthCertificate ? '/images/studentPSA/' + student.birthCertificate : '/images/noimageavailable.jpg')" target="_blank" style="float:right;"><i class="fa fa-eye"></i></a>
                                            <a href="#" style="float:right;" @click.prevent="uploadImage('studentPSA')" onclick="$('#requirementsImage').click()"><i class="fa fa-upload"></i></a>
                                        
                                        </p>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-4" style="height:100%;">
                                    <div class="thumbnail" style="height:100%;">
                                    <a v-if="student.goodmoral" :href="('/images/studentPSA/' + student.birthCertificate)" target="_blank">{{student.lname + ", " + student.name + " - Good Moral"}}</a>
                                    <div v-if="!student.goodmoral" class="image view view-first" style="height:100%;">
                                        <img style="width: 100%; display: block;" v-bind:src=" (student.goodmoral ? '/images/studentGoodMoral/' + student.goodmoral : '/images/noimageavailable.jpg')" alt="image" />
                                        <div class="mask"  style="height:100%;">
                                        <p> </p>
                                        <div class="tools tools-bottom" style="height:100%;">
                                            
                                        </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>GOOD MORAL 
                                            <a v-bind:href=" (student.goodmoral ? '/images/studentGoodMoral/' + student.goodmoral : '/images/noimageavailable.jpg')" target="_blank" style="float:right;"><i class="fa fa-eye"></i></a>
                                            <a href="#" style="float:right;" @click.prevent="uploadImage('studentGoodMoral')" onclick="$('#requirementsImage').click()"><i class="fa fa-upload"></i></a>
                                        </p>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-4" style="height:100%;">
                                    <div class="thumbnail" style="height:100%;">
                                    <a v-if="student.reportCard" :href="('/images/studentPSA/' + student.birthCertificate)" target="_blank">{{student.lname + ", " + student.name + " - Report Card"}}</a>
                                    <div class="image view view-first" style="height:100%;">
                                        <img v-if="!student.reportCard" style="width: 100%; display: block;" v-bind:src=" (student.reportCard ? '/images/studentReportCard/' + student.reportCard : '/images/noimageavailable.jpg')" alt="image" />
                                        <div class="mask"  style="height:100%;">
                                        <p> </p>
                                        <div class="tools tools-bottom" style="height:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <p>REPORT CARD OR FORM 138
                                            <a v-bind:href=" (student.reportCard ? '/images/studentReportCard/' + student.reportCard : '/images/noimageavailable.jpg')" target="_blank" style="float:right;"><i class="fa fa-eye"></i></a>
                                            <a href="#" style="float:right;" @click.prevent="uploadImage('studentReportCard')" onclick="$('#requirementsImage').click()"><i class="fa fa-upload"></i></a>
                                        </p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                      </div>
                     

                      
                      <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <center><button type="submit" class="btn btn-success">Save</button></center>
                                </div>
                            </div>
                    </div>
                  </div>
                </div>
                </form>
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

        props: ['user'],
        
        data() {
            return {
                student: JSON.parse(this.user),
                errors: new Errors(),
                type: '',
            }
        },
        
        methods: {
            saveData(){
                axios.patch('/api/users/'+this.student.id, this.student)
                .then((res) => {
                    new Noty({killer: true,type: 'success', text: 'Successfully updated.', layout: 'topRight'}).show();
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({killer: true,type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            },

            uploadImage(type){
                this.type = type;
            },

            requirementChanged(e){

                var fileReader = new FileReader();

                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.student.image = e.target.result;

                        axios.post('/api/uploadImage/'+this.type, this.student)
                        .then((res) => {
                            if(this.type == 'studentPSA'){
                                this.student.birthCertificate = res.data;
                            }
                            if(this.type == 'studentGoodMoral'){
                                this.student.goodmoral = res.data;
                            }
                            if(this.type == 'studentReportCard'){
                                this.student.reportCard = res.data;
                            }
                            new Noty({type: 'success', text: 'Successfully uploaded requirement.', layout: 'topRight'}).show();
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            },
        },

        mounted() {
            console.log(this.student);
        }
    }
</script>
