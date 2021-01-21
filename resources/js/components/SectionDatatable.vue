<template>

    <div class="projects">

        <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div :class="'col-md-'+(accessing.role_id == 1 ? '12' : '8')">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Sections</h2>
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
                            <br />
                            <div class="tableFilters">
                                <div class="col-md-3 col-sm-3  form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-right" placeholder="Search" v-model="tableData.search" @input="getProjects()">
                                    <span class="fa fa-search form-control-feedback right" aria-hidden="true"></span>
                                </div>

                                
                                <div class="col-md-1 col-sm-1  form-group has-feedback">
                                    <select class="form-control" id="gender" v-model="tableData.length" @change="getProjects()">
                                        <option disabled value = "" selected>Paginate by</option>
                                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                                    </select>
                                </div>

                            </div>
                            <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                                <tbody>
                                    <tr v-for="project in projects" :key="project.id">
                                        <td>{{project.code}}</td>
                                        <td>{{project.levels.name}}</td>
                                        <td v-if="accessing.role_id != 1">{{project.description}}</td>
                                        <td v-if="accessing.role_id == 1">{{(project.studentSchoolyear ? project.studentSchoolyear.name : 'N/A')}}</td>
                                        <!-- Admin -->
                                        <td v-show="accessing.role_id == 3">
                                            <button class="btn btn-danger btn-sm" @click="deleteData(project)"><span class="fa fa-trash"></span></button>
                                            <button class="btn btn-info btn-sm" @click="editData(project)"><span class="fa fa-edit"></span></button>
                                            <button class="btn btn-info btn-sm" @click="showSubjects(project)">Subjects</button>
                                        </td>
                                        <!-- Instructor -->
                                        <td v-show="accessing.role_id == 4">
                                            <button class="btn btn-info btn-sm" @click="showStudents(project)">Students</button>
                                        </td>
                                        <!-- Student -->
                                        <td v-show="accessing.role_id == 1">
                                            <button class="btn btn-info btn-sm" @click="showStudentSubjects(project, 'student')">Subjects</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </datatable>
                            <pagination :pagination="pagination"
                                        @prev="getProjects(pagination.prevPageUrl)"
                                        @next="getProjects(pagination.nextPageUrl)">
                            </pagination>
                        </div>
                    </div>

                </div>


                <!-- For admin -->
                <div class="col-md-4" v-show="accessing.role_id == 3">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><span style="color:black;" v-html="todo"></span> Section</h2>
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
                            <br />
                            
									<form class="form-horizontal form-label-left" @submit.prevent="saveData()">
                                        
                                        <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Level</label>
											<div class="col-md-9 col-sm-9 ">
												<select class="form-control" v-model="datas.level_id">
                                                    <option selected disabled value="">Choose option</option>
                                                    <option v-for="level in levels" :key="level.name" :value="level.id">
                                                        {{ level.name }}
                                                    </option>
                                                </select>
											</div>
										</div>

										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Section Code</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" placeholder="Level Name" v-model="datas.code">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Description</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" placeholder="Description" v-model="datas.description">
											</div>
										</div>
										

										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-9 col-sm-9  offset-md-3">
												<button type="reset" class="btn btn-primary" @click="clearFields()">Reset</button>
												<button type="submit" class="btn btn-success" v-html="todo">Submit</button>
											</div>
										</div>

									</form>
                        </div>
                    </div>

                </div>


                <!-- For adviser -->
                <div class="col-md-4" v-show="accessing.role_id == 4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><span style="color:black;"></span> Students <small>{{(this.section.selectedSection ? '(' + this.section.selectedSection.levels.name + ' ' + this.section.selectedSection.code + ')' : '')}}</small></h2>
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
                            <br />
                            
							<table class="table is-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="!section.students || section.students.length == 0">
                                        <td style="text-align: center;" colspan="2">No Data found</td>
                                    </tr>
                                    <tr v-for="student in section.students" :key="student.id">
                                        <td>{{student.lname + ', ' + student.name + ' ' + (student.middlename ? student.middlename : '')}}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" @click="showStudentSubjects(student)">Subjects</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

        
    <!-- Subjects modal -->
     <div class="modal fade bs-example-modal-md" id="subjectsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">SUBJECTS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                
										<div class="form-group row" v-for="subject in section.subjects" :key="subject.id">
											<label class="control-label col-md-6 col-sm-6 ">[{{subject.code}}] {{subject.name}}</label>
											<div class="col-md-6 col-sm-6 ">
												 <select  class="form-control" v-model="subject.adviser_id" disabled>
                                                    <option :value=null disabled>No adviser</option>
                                                    <option v-for="adviser in advisers" :value="adviser.id" :key="adviser.id">
                                                        {{ adviser.lname + ', ' + adviser.name}}
                                                    </option>
                                                </select>
										</div>
            </div>

            
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="updateAdvisers">Save</button>
            </div> -->

            </div>
        </div>
      </div>

     </div>

     <!-- Students Subjects modal -->
     <div class="modal fade bs-example-modal-md" id="studentSubjectsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">SUBJECTS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                
										<div class="form-group row" v-for="subject in section.selectedStudentSubject" :key="subject.id">
											<label class="control-label col-md-6 col-sm-6 ">[{{subject.code}}] {{subject.name}}</label>
											<div class="col-md-6 col-sm-6 ">
												 <select  class="form-control" v-model="subject.grade" :disabled="accessing.role_id == 1">
                                                    <option :value=null disabled>{{ (accessing.role_id != 1 ? 'Select Grade' : 'No Grade') }}</option>
                                                    <option>Passed</option>
                                                    <option>Failed</option>
                                                </select>
										</div>
            </div>

            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="updateStudentGrade" v-show="accessing.role_id != 1">Save</button>
            </div>

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

import Datatable from './Datatables.vue';
import Pagination from './DatatablePagination.vue';
import Noty from 'noty';
export default {
    components: { datatable: Datatable, pagination: Pagination },

    props: ['user'],
    created() {
        this.getProjects();

    },
    data() {
        let sortOrders = {};

        let columns = [
            { label: 'Section', name: 'code' },
            { label: 'Level', name: 'level' },
            { label: (JSON.parse(this.user).role_id != 1 ? 'Description' : 'School year'), name: 'description'},
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            projects: [],
            columns: columns,
            sortKey: 'code',
            sortOrders: sortOrders,
            showActionTable: true,
            perPage: ['10', '20', '30'],
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'asc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
            datas: {
                code: '',
                description: '',
                level_id: '',

            },
            todo: 'Add',
            editableId: '',
            endPoint: '/api/sections/',
            errors: new Errors(),
            levels: this.levelsFetch(),
            advisers: this.fetchAdvisers(),
            section: {
                subjects: '',
                students: '',
                selectedStudent: '',
                selectedSection: '',
                selectedStudentSubject: '',
            },
            accessing: JSON.parse(this.user),
        }
    },
    methods: {
        updateStudentGrade(){
            axios.post(this.endPoint+'updateStudentGrade', this.section)
            .then((res) => {
                new Noty({type: 'success', text: 'Successfully updated.', layout: 'topRight'}).show();
                $('#studentSubjectsModal').modal('hide');
            })
            .catch((err) => {
                this.errors.record(err.response.data);
                new Noty({type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
            });
        },
        showStudentSubjects(student, accessing = ''){

            //for students
            if(accessing == 'student'){
                this.section.selectedSection = student;
            }
            else{
                this.section.selectedStudent = student;
            }

            axios.post('/api/sections/studentSubjects', this.section)
            .then((res) => {
                this.section.selectedStudentSubject = res.data;
                $('#studentSubjectsModal').modal('show');
            })
            .catch((err) => {
                this.errors.record(err.response.data);
                new Noty({type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
            });
        },
        showStudents(section){
            this.section.students = section.adviserStudents;
            this.section.selectedSection = section;
        },
        updateAdvisers(){
            axios.post(this.endPoint+'updateAdvisers', this.section)
            .then((res) => {
                new Noty({type: 'success', text: 'Successfully updated.', layout: 'topRight'}).show();
                $('#subjectsModal').modal('hide');
            })
            .catch((err) => {
                this.errors.record(err.response.data);
                new Noty({type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
            });
        },
        showSubjects(section){
            this.section.subjects = section.subjects;
            $('#subjectsModal').modal('show');
        },
        fetchAdvisers(){
            axios.post('/api/users/fetchAdvisers')
            .then((res) => {
                this.advisers = res.data
            })
            .catch((err) => {
                console.log(err);
            });
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

        clearFields(){
            const keys = Object.keys(this.datas);
            for (var a = 0; a < keys.length; a++) {
                this.datas[keys[a]] = '';
            }
            this.todo = 'Add';
        },

        saveData(){
            if(this.todo == 'Add'){
                axios.post(this.endPoint, this.datas)
                .then((res) => {
                    new Noty({type: 'success', text: 'Successfully saved.', layout: 'topRight'}).show();
                    this.getProjects();
                    this.clearFields();
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            }
            else if(this.todo == 'Edit'){
                axios.patch(this.endPoint+this.editableId, this.datas)
                .then((res) => {
                    new Noty({type: 'success', text: 'Successfully updated.', layout: 'topRight'}).show();
                    this.getProjects();
                    this.clearFields();
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            }
            
        },

        deleteData(dataDelete){
            var self = this;
            new Noty({
                text: 'Do you want to delete this?',
                type: 'warning', 
                buttons: [
                    {
                        addClass: 'btn btn-danger btn-sm', text: 'Ok', onClick: function($noty) {
                            axios.delete(self.endPoint+dataDelete.id)
                            .then((res) => {
                                self.getProjects();
                                new Noty({type: 'success', text: 'Successfully removed.', layout: 'topRight'}).show();
                            })
                            .catch((err) => {
                                console.log(err); 
                            });
                        }
                    },
                    {
                        addClass: 'btn btn-primary btn-sm', text: 'Cancel', onClick: function($noty) {
                            $noty.close();
                        }
                    }
                ]
            });

            
        },
        editData(dataEdit){

            const keys = Object.keys(this.datas);
            for (var a = 0; a < keys.length; a++) {
                this.datas[keys[a]] = dataEdit[keys[a]];
            }

            this.editableId = dataEdit.id;
            this.todo = 'Edit';
        },

        getProjects(url = this.endPoint) {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.projects = data.data.data;
                        this.configPagination(data.data);
                    }

                    
                    if(this.pagination.total == 0){
                        new Noty({killer: true, type: 'warning', text: 'No data found.', layout: 'topRight'}).show();
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'code', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getProjects();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    }
};
</script>
