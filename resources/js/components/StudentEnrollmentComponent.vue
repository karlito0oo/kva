<template>

<div class="row">

          <div class="col-md-5 col-sm-5 ">
              <div class="x_panel tile fixed_height_400">
                <div class="x_title">
                  <h2>Registrations <small>{{ currentStudent.lname }}, {{ currentStudent.name }}</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Student Type *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" v-model="datas.StudentType" :disabled="disableButton">
                                        <option :value=null disabled>Select Student Type</option>
                                        <option>Old Student</option>
                                        <option>Returnee</option>
                                        <option>New Student</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Level *</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select  class="form-control" v-model="datas.Level" :disabled="disableButton">
                                        <option :value=null disabled>Select Level</option>
                                        <option v-for="level in levels" :value="level.id" :key="level.id">
                                            {{ level.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
												            <button type="reset" class="btn btn-primary" @click="clearFields()" :disabled="disableButton">Reset</button>
                                    <button type="submit" class="btn btn-info" @click="showSubjects" :disabled="disableButton">Show Subjects</button>
                                </div>
                            </div>
                    
                </div>
              </div>
            </div>
            

          <div class="col-md-4 col-sm-4 ">
              <div class="x_panel tile fixed_height_400">
                <div class="x_title">
                  <h2>Subjects to enroll</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                <div class="">
                        <ul class="to_do">
                          <li v-for="subject in subjects" :key="subject.id">
                            <p class="ml-2">
                              [{{ subject.code }}] - {{ subject.name }} </p>
                          </li> 
                        </ul>
                      </div>
                    
                      <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <button type="submit" class="btn btn-info" @click="submitEnrollment" v-if="!disableButton">Submit</button>
                                    <button type="submit" class="btn btn-warning" @click="editEnrollment" v-if="disableButton">Edit</button>
                                    <button type="submit" class="btn btn-success" @click="openEnrollmentModal" v-if="accessing == 'admin' && disableButton">{{(enrollmentDetails.status == 'Enrolled' ? 'Update' : 'Pre-enroll')}}</button>
                                </div>
                            </div>
                </div>
              </div>
            </div>



            

          <div class="col-md-3 col-sm-3" v-if="enrollmentDetails.status == 'Enrolled'">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Payment</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
    <table  width="100%">

        <!-- Body -->
        <tr>
            <th>PARTICULARS</th>
            <th>CASH</th>
        </tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Registration</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.registration}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Tuition Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.tuition}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Insurance Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.insurance}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Library Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.library}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Science Laboratory Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.science}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Computer Laboratory Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.computer}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Athletics Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.athletics}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Miscellaneous Fee</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.misc}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">Books</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.books}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">School Uniform</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.school_uniform}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">P.E. Uniform</td>
    <td style="border: 1px solid black; padding-left: 10px;">P{{enrollmentDetails.level.pe_uniform}}</td>
</tr>

<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;">_</td>
    <td style="border: 1px solid black; padding-left: 10px;">_</td>
</tr>



<tr style="border: 1px solid black; padding-left: 10px;">
    <td style="border: 1px solid black; padding-left: 10px;"><b>Total</b></td>
    <td style="border: 1px solid black; padding-left: 10px;"><b>P{{enrollmentDetails.level.totalFees}}</b></td>
</tr>

       

    </table>
                    <div class="form-group row pt-3">
											<label class="control-label col-md-3 col-sm-3 ">Remaining balance</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="0" v-model="datas.balance">
											</div>
										</div>

                </div>
              </div>


              
            


          </div>


          
    <!-- Enrollment modal -->
     <div class="modal fade bs-example-modal-md" id="enrollmentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">Select Section</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">Section *</label>
                  <div class="col-md-9 col-sm-9 ">
                      <select  class="form-control" v-model="datas.Section">
                          <option value='' disabled>Select Section</option>
                          <option v-for="section in sections" :value="section.id" :key="section.id">
                              {{ section.code + ' (' + section.enrolled_students.length + '/' + settings.maxstudentsection + ')'}}
                          </option>
                      </select>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="enrollStudent">{{ (enrollmentDetails.status == 'Enrolled' ? 'Update' : 'Pre-enroll Student') }}</button>
            </div>

            </div>
        </div>
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
        
    props: ['student', 'accessing'],
        data() {
            return {
                levels: this.levelsFetch(),
                subjects: {}, 
                datas: {
                    StudentType: null,
                    Level: null,
                    Subjects: [],
                    student_id: '',
                    Section: '',
                    balance: '',
                },
                enrollmentDetails: {},
                currentStudent:JSON.parse(this.student),
                errors: new Errors(),
                disableButton: false,
                editableEnrollment: '',
                sections: {},
                settings: this.settingsFetch(),
            }
        },

        mounted() {
            this.datas.student_id = this.currentStudent.id;
            this.checkEnrollmentDetails()
        },

        methods: {

            settingsFetch(){
                axios.post('/api/setting/fetch')
                .then((res) => {
                    this.settings = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            enrollStudent(){
              axios.patch('/api/enrollments/submitEnrollment/'+this.enrollmentDetails.id, this.datas)
              .then((res) => {
                  if(!res.data.result){
                    new Noty({killer: true, type: 'error', text: res.data.message, layout: 'topRight'}).show();
                  }
                  else{
                    new Noty({type: 'success', text: 'Successfully pre-enrolled student.', layout: 'topRight'}).show();
                    window.setTimeout(function(){
                        window.location.href = "/home/students";
                    }, 2000);
                  }
              })
              .catch((err) => {
                  this.errors.record(err.response.data);
                  new Noty({killer: true, type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
              });
            },

            openEnrollmentModal(){
              this.datas.Section = (this.enrollmentDetails.status == 'Enrolled' ? this.enrollmentDetails.section_id : '');
              $('#enrollmentModal').modal('show');
              this.sectionsFetch();
            },

            sectionsFetch(){
                axios.get('/api/sections/'+this.enrollmentDetails.level_id)
                .then((res) => {
                    this.sections = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            clearFields(){
                const keys = Object.keys(this.datas);
                for (var a = 0; a < keys.length; a++) {
                    this.datas[keys[a]] = null;
                }

                this.subjects = {};
            },

            editEnrollment(){
                this.disableButton = false;
                this.editableEnrollment = this.enrollmentDetails.id;
            },

            levelsFetch(){
                axios.post('/api/levels/fetch')
                .then((res) => {
                    this.levels = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            showSubjects(){
                axios.post('/api/subjects/fetch', this.datas)
                .then((res) => {
                    this.subjects = res.data;
                    this.datas.Subjects = res.data;
                    if(res.data.length == 0){
                        new Noty({type: 'warning', text: 'No data found.', layout: 'topRight'}).show();
                    }
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({killer: true, type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            },

            submitEnrollment(){

                if(this.editableEnrollment == ''){
                    axios.post('/api/enrollments', this.datas)
                    .then((res) => {
                        if(!res.data.result){
                          new Noty({killer: true, type: 'error', text: res.data.message, layout: 'topRight'}).show();
                        }
                        else{
                          new Noty({type: 'success', text: 'Successfully saved.', layout: 'topRight'}).show();
                          this.checkEnrollmentDetails('hide');
                        }
                    })
                    .catch((err) => {
                        this.errors.record(err.response.data);
                        new Noty({killer: true, type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                    });
                }
                else{
                  axios.patch('/api/enrollments/'+this.editableEnrollment, this.datas)
                    .then((res) => {
                        new Noty({type: 'success', text: 'Successfully saved.', layout: 'topRight'}).show();
                        this.checkEnrollmentDetails('hide');
                    })
                    .catch((err) => {
                        this.errors.record(err.response.data);
                        new Noty({killer: true, type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                    });
                }
            },

            checkEnrollmentDetails(status = null){
              //datas needed for enrollment
                axios.post('/api/enrollments/checkEnrollmentDetails', this.datas)
                .then((res) => {
                    this.enrollmentDetails = res.data;
                    console.log(res.data);
                    if(this.enrollmentDetails){
                      this.disableButton = true;
                      this.datas.StudentType = this.enrollmentDetails.student_type;
                      this.datas.Level = this.enrollmentDetails.level_id;
                      this.datas.balance = this.enrollmentDetails.balance;
                      this.showSubjects();
                      
                      for (let i = 0; i < this.enrollmentDetails.enrolled_subjects.length; i++) {
                        this.datas.Subjects.push(this.enrollmentDetails.enrolled_subjects[i].subject_id);
                      }

                      if(this.accessing == 'admin'){

                      }
                      else if(status == null){
                        new Noty({killer: true, type: 'error', text: 'You already have pending enrollment. Please proceed to registrars office.', layout: 'topRight'}).show();
                      }
                    }
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                });
            }

        }
    }
</script>
