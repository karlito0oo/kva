<template>
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <!-- <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Enrollment Settings</h2>
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
                            <br>
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
                            <br>
                            <!-- <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 ">ID No. Prefix </label>
                                <div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.id_no_prefix">
                                </div>
                            </div> -->

                            
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
        },

        methods: {

            settingsFetch(){
                axios.get('/api/settings')
                .then((res) => {
                    this.datas = res.data
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
