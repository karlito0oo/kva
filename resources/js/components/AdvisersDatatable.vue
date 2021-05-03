<template>

    <div class="projects">

        <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><span style="color:black;" v-html="pageName"></span>s</h2>
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
                                        <td>{{project.lname}}</td>
                                        <td>{{project.name}}</td>
                                        <td>{{project.middlename}}</td>
                                        <td>{{project.gender}}</td>
                                        <td>{{project.birthday}}</td>
                                        <td>{{project.email}}</td>
                                        <td>{{project.contactno}}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" @click="deleteData(project)"><span class="fa fa-trash"></span></button>
                                            <button class="btn btn-info btn-sm" @click="editData(project)"><span class="fa fa-edit"></span></button>
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


                
                <div class="col-md-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><span style="color:black;" v-html="todo"></span> <span style="color:black;" v-html="pageName"></span> </h2>
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
											<label class="control-label col-md-3 col-sm-3 ">First Name</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.name">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Middle Name</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.middlename">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Last Name</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.lname">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Gender</label>
											<div class="col-md-9 col-sm-9 ">
												<select class="form-control" v-model="datas.gender">
                                                    <option value="">Choose option</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Birthdate</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="date" class="form-control" v-model="datas.birthday">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Contact No.</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" v-model="datas.contactno">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Email Address</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="email" class="form-control" v-model="datas.email">
											</div>
										</div>
										<div class="form-group row " v-if="todo == 'Add'">
											<label class="control-label col-md-3 col-sm-3 ">Password</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="password" class="form-control" v-model="datas.password">
											</div>
										</div>

                                        
										<div class="ln_solid"></div>
										<div class="form-group row">
                                            
											<label class="control-label col-md-3 col-sm-3 ">Select Level</label>
											<div class="col-md-6 col-sm-4 ">
												<select  class="form-control" v-model="currentSubject.selectedSubject">
                                                    <option value="">Select Subject</option>
                                                    <option v-for="subject in subjects" :value="subject" :key="subject.id">
                                                        [{{ subject.levels.name }}] {{ subject.name }}
                                                    </option>
                                                </select>
											</div>
                                            <div class="col-md-3 col-sm-3">
                                                <button type="button" class="btn btn-primary" @click="addSubject()">Add</button>
                                            </div>
											
										</div>
                                        <div class="row">
                                            <table class="table is-bordered data-table">
                                                <thead>
                                                    <tr>
                                                       <th>Subject Name</th>
                                                       <th>Grade Level</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="subject in currentSubject.subjects" :key="subject.id">
                                                        <td>{{ subject.name }}</td>
                                                        <td>{{ subject.levels.name }}</td>
                                                        <td> <a class="btn btn-danger btn-sm" @click="removeSubject(subject)"><span class="fa fa-trash"></span></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
    created() {
        this.getProjects();

    },
    data() {
        let sortOrders = {};

        let columns = [
            { name: 'lname', label: 'LAST NAME'},
            { name: 'name', label: 'FIRST NAME' },
            { name: 'middlename', label: 'MIDDLE NAME'},
            { name: 'gender', label: 'GENDER'},
            { name: 'birthday', label: 'BIRTHDATE'},
            { name: 'email', label: 'EMAIL ADDRESS'},
            { name: 'contactno', label: 'CONTACT NO.'},
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            projects: [],
            columns: columns,
            sortKey: 'lname',
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
                name: '',
                lname: '',
                middlename: '',
                gender: '',
                email: '',
                contactno: '',
                birthday: '',
                password: '',
                subjects: '',

            },
            todo: 'Add',
            editableId: '',
            endPoint: '/api/advisers',
            pageName: 'Teacher',
            errors: new Errors(),
            currentSubject: {
                subjects: [],
                selectedSubject: '',
            },
            subjects: this.fetchSujects(),
        }
    },
    methods: {
        addSubject(){
             if(!this.containsObject(this.currentSubject.selectedSubject, this.currentSubject.subjects) && this.currentSubject.selectedSubject != ''){
                this.currentSubject.subjects.push(this.currentSubject.selectedSubject);
                this.currentSubject.selectedSubject = '';
            }
            else if(this.containsObject(this.currentSubject.selectedSubject, this.currentSubject.subjects)){
                    new Noty({killer: true, type: 'error', text: 'Subject already added.', layout: 'topRight'}).show();
            }
            else{
                    new Noty({killer: true, type: 'error', text: 'No subject selected.', layout: 'topRight'}).show();
            }
        },
        removeSubject(subject){
            var removeIndex = this.currentSubject.subjects.map(function(item) { return item.id; }).indexOf(subject.id);
            this.currentSubject.subjects.splice(removeIndex, 1);
        },
        fetchSujects(){
            axios.post('/api/subjects/fetch')
            .then((res) => {
                this.subjects = res.data
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
            this.currentSubject.subjects = [];
        },

        saveData(){
            this.datas.subjects = this.currentSubject.subjects;
            if(this.todo == 'Add'){
                axios.post(this.endPoint, this.datas)
                .then((res) => {
                    new Noty({killer: true, type: 'success', text: 'Successfully saved.', layout: 'topRight'}).show();
                    this.getProjects();
                    this.clearFields();
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({killer: true, type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            }
            else if(this.todo == 'Edit'){
                axios.patch(this.endPoint+'/'+this.editableId, this.datas)
                .then((res) => {
                    new Noty({killer: true, type: 'success', text: 'Successfully updated.', layout: 'topRight'}).show();
                    this.getProjects();
                    this.clearFields();
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({killer: true, type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            }
            
        },

        deleteData(dataDelete){
            var self = this;
            var endPoint = this.endPoint;
            new Noty({
                killer: true, 
                text: 'Do you want to delete this?',
                type: 'warning', 
                buttons: [
                    {
                        addClass: 'btn btn-danger btn-sm', text: 'Ok', onClick: function($noty) {
                            axios.delete(endPoint+'/'+dataDelete.id)
                            .then((res) => {
                                self.getProjects();
                                self.clearFields();
                                new Noty({killer: true, type: 'success', text: 'Successfully removed.', layout: 'topRight'}).show();
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
            this.datas.password = '12345678';

            this.editableId = dataEdit.id;
            this.todo = 'Edit';

            this.currentSubject.subjects = dataEdit.instructorSubjects;

            
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
            this.tableData.column = this.getIndex(this.columns, 'lname', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getProjects();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
        containsObject(obj, list) {
            var result = false;
            if(list.length > 0){
                list.forEach((object) => {
                    if(object.id == obj.id){
                        result = true;
                        return true;
                    }
                });
            }
            return result;
        },
    }
};
</script>
