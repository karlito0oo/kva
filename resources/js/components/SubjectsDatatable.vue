<template>

    <div class="projects">

        <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Subject Table</h2>
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
                                        <td>{{project.name}}</td>
                                        <td>{{project.description}}</td>
                                        <td>{{project.levels.name}}</td>
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
                            <h2><span style="color:black;" v-html="todo"></span> Subject</h2>
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
											<label class="control-label col-md-3 col-sm-3 ">Code</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.code">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Name</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.name">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Description</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" v-model="datas.description">
											</div>
										</div>

										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Level</label>
											<div class="col-md-9 col-sm-9 ">
												<select class="form-control" v-model="datas.level_id">
                                                    <option selected disabled>Choose option</option>
                                                    <option v-for="level in levels" :value="level.id">
                                                        {{ level.name }}
                                                    </option>
                                                </select>
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
            { label: 'Code', name: 'code' },
            { label: 'Name', name: 'name' },
            { label: 'Description', name: 'description'},
            { label: 'Level', name: 'level_id'},
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
                dir: 'desc',
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
                description: '',
                code: '',
                level_id: '',

            },
            todo: 'Add',
            editableId: '',
            endPoint: '/api/subjects/',
            errors: new Errors(),
            levels: this.levelsFetch(),
        }
    },
    methods: {

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
            var endPoint = this.endPoint;
            new Noty({
                text: 'Do you want to delete this?',
                type: 'warning', 
                buttons: [
                    {
                        addClass: 'btn btn-danger btn-sm', text: 'Ok', onClick: function($noty) {
                            axios.delete(endPoint+dataDelete.id)
                            .then((res) => {
                                self.getProjects();
                                self.clearFields();
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
        
        levelsFetch(){
            axios.post('/api/levels/fetch')
            .then((res) => {
                this.levels = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },

        getProjects() {
            this.tableData.draw++;
            axios.get(this.endPoint, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.projects = data.data.data;
                        this.configPagination(data.data);
                    }

                    if(this.pagination.total == 0){
                        new Noty({type: 'warning', text: 'No data found.', layout: 'topRight'}).show();
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
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getProjects();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    }
};
</script>
