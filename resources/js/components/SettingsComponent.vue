<template>
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <!-- <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Enrollment Settings</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label col-md-3 col-sm-3 ">Enrollment Starts </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="date" class="form-control" placeholder="Enrollment start" v-model="datas.enrollmentStart">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label col-md-3 col-sm-3 ">Enrollment Ends </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="date" class="form-control" placeholder="Enrollment end" v-model="datas.enrollmentEnd">
                                    </div>
                                </div>
                                
                            </div>

                            
                        </div>
                    </div>

                </div> -->

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>General Settings</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Current School Year </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" v-model="datas.schoolyear_id">
                                        <option :value=null disabled>Select School Year</option>
                                        
                                        <option v-for="schoolyear in schoolyears" :value="schoolyear.id" :key="schoolyear.id">
                                            {{ schoolyear.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Max. number of student per section </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" v-model="datas.maxstudentsection" placeholder="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">ID No. Prefix </label>
                                <div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.id_no_prefix">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Passing Grade <small>(out of 100)</small> </label>
                                <div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.passingGrade">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>School Information</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">About School </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control border-primary" name="ckEditorTextarea" id="aboutSchool" v-model="datas.data">
                                    </textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Services Offered </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control border-primary" name="ckEditorTextarea" id="servicesOffered" v-model="datas.data">
                                    </textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Rules and Regulations </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control border-primary" name="ckEditorTextarea" id="rulesRegulation" v-model="datas.data">
                                    </textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">Guidelines and Instructions </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control border-primary" name="ckEditorTextarea" id="guidelinesInstruction" v-model="datas.data">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        
                            <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <button type="submit" class="btn btn-info" @click="updateSettings">Update</button>
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

        data() {
            return {
                datas: {},
                schoolyears: {},
                errors: new Errors(),
            }
        },

        mounted() {
            this.settingsFetch()
            this.schoolyearsFetch()
            CKEDITOR.replace('aboutSchool')
            CKEDITOR.replace('servicesOffered')
            CKEDITOR.replace('rulesRegulation')
            CKEDITOR.replace('guidelinesInstruction')
        },

        methods: {

            settingsFetch(){
                axios.get('/api/settings')
                .then((res) => {
                    this.datas = res.data
                    //to update ckeditor fields
                    CKEDITOR.instances.aboutSchool.setData(this.datas.aboutSchool)
                    CKEDITOR.instances.servicesOffered.setData(this.datas.servicesOffered)
                    CKEDITOR.instances.rulesRegulation.setData(this.datas.rulesRegulation)
                    CKEDITOR.instances.guidelinesInstruction.setData(this.datas.guidelinesInstruction)
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            schoolyearsFetch(){
                axios.post('/api/school-years/fetch')
                .then((res) => {
                    this.schoolyears = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            updateSettings(){
                //update ckeditor fields
                this.datas.aboutSchool = CKEDITOR.instances.aboutSchool.getData();
                this.datas.servicesOffered = CKEDITOR.instances.servicesOffered.getData();
                this.datas.rulesRegulation = CKEDITOR.instances.rulesRegulation.getData();
                this.datas.guidelinesInstruction = CKEDITOR.instances.guidelinesInstruction.getData();


                axios.patch('/api/settings/'+'1', this.datas)
                .then((res) => {
                        new Noty({killer: true, type: 'success', text: 'Successfully updated.', layout: 'topRight'}).show();
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({killer: true, type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            },
        }
    }
</script>
