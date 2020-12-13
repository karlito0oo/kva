<template>
            <div class="col-md-8 col-sm-8  ">
                
				<form class="form-horizontal form-label-left" @submit.prevent="saveData()">

                <div class="x_panel">
                  <div class="x_title">
                    <h2> Student Details</h2>
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

                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="home" aria-selected="true">Basic Info</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="guardian-tab" data-toggle="tab" href="#guadian" role="tab" aria-controls="profile" aria-selected="false">Guardian</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="school-tab" data-toggle="tab" href="#school" role="tab" aria-controls="profile" aria-selected="false">Prev. Schools</a>
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
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Middle Name"  v-model="student.middleName">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="tel" class="form-control" id="inputSuccess5" placeholder="Email" v-model="student.email">
                                <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Address *" v-model="student.address">
                                <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <input type="tel" class="form-control" id="inputSuccess5" placeholder="Contact No. *" v-model="student.contactno">
                                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <br><br>
                            <br><br>
                            <br><br>
                            <br><br>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Birthday *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="date" class="form-control" v-model="student.birthday">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Birth place *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Birth place" v-model="student.birthplace">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Gender *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select name="" id=""  class="form-control" v-model="student.gender">
                                        <option :value=null>Select Gender</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Civil Status </label>
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
                                <label class="col-form-label col-md-3 col-sm-3">Religion </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Religion" v-model="student.religion">
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Nationality *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Nationality" v-model="student.nationality">
                                </div>
                            </div>

                        
                      </div>

                      <div class="tab-pane fade" id="guadian" role="tabpanel" aria-labelledby="guadian-tab">
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Guardian Name * </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Guardian Name" v-model="student.guardianName">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Guardian Contact No. * </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Guardian Contact No." v-model="student.guardianContactNo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Address * </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Address" v-model="student.guardianAddress">
                                </div>
                            </div>
                      </div>


                      <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Elementary </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Elementary" v-model="student.elementary">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Address </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Address" v-model="student.elementaryAddress">
                                </div>
                            </div>

                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Highschool </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="High school" v-model="student.highschool">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Address </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Address" v-model="student.highschoolAddress">
                                </div>
                            </div>

                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">College </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="College" v-model="student.college">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Address </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Address" v-model="student.collegeAddress">
                                </div>
                            </div>
                      </div>
                     

                      
                      <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <button type="submit" class="btn btn-success">Save</button>
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
        },

        mounted() {
            console.log(this.student);
        }
    }
</script>
