<template>

    <div class="projects">

        <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Grade Levels</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <div class="tableFilters">
                                <div class="col-md-3 col-sm-3  form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-right" placeholder="Search" v-model="tableData.search" @input="getProjects()">
                                    <span class="fa fa-search form-control-feedback right" aria-hidden="true"></span>
                                </div>

                                
                                <div class="col-md-2 col-sm-2  form-group has-feedback">
                                    <select class="form-control" id="gender" v-model="tableData.length" @change="getProjects()">
                                        <option disabled value = "" selected>Paginate by</option>
                                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                                    </select>
                                </div>

                            </div>
                            <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                                <tbody>
                                    <tr v-for="project in projects" :key="project.id">
                                        <td>{{project.name}}</td>
                                        <!-- <td>{{project.description}}</td> -->
                                        <!-- <td>{{(project.prerequisite ? project.prerequisite.name : 'N/A')}}</td> -->
                                        <td>
                                            <button class="btn btn-danger btn-sm" @click="deleteData(project)"><span class="fa fa-trash"></span></button>
                                            <button class="btn btn-info btn-sm" @click="editData(project)"><span class="fa fa-edit"></span></button>
                                            <a target="_blank" :href="'/print/grade-fees/' + project.id"><button class="btn btn-success btn-sm"><span class="fa fa-print"></span></button></a>
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
                            <h2><span style="color:black;" v-html="todo"></span> Grade Level</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            
									<form class="form-horizontal form-label-left" @submit.prevent="saveData()">

										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Grade Level</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" placeholder="Grade Level Name" v-model="datas.name">
											</div>
										</div>
                                        <hr>

                                        <h2>&nbsp;Fees</h2>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Registration</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.registration">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Tution</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.tuition">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Insurance</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.insurance">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Library</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.library">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Science Laboratory</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.science">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Computer Laboratory</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.computer">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Athletics</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.athletics">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Miscellaneous</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.misc">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Books</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.books">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">School Uniform</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.school_uniform">
											</div>
										</div>
                                        
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">P.E. Uniform</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" placeholder="P0.00" v-model="datas.pe_uniform">
											</div>
										</div>

										<!-- <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Description</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" placeholder="Description" v-model="datas.description">
											</div>
										</div> -->
										<!-- <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Pre-requisite</label>
											<div class="col-md-9 col-sm-9 ">
                                                <select  class="form-control" v-model="datas.prerequisite_id">
                                                    <option value="" disabled>Select Pre-requisite</option>
                                                    <option v-for="level in levels" :value="level.id" :key="level.id">
                                                        {{ level.name }}
                                                    </option>
                                                </select>
											</div>
										</div> -->
										

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
            { label: 'GRADE LEVEL', name: 'name' },
            //{ label: 'Description', name: 'description'},
            // { label: 'PRE-REQUISITE', name: 'prerequisite_id'},
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            projects: [],
            columns: columns,
            sortKey: 'name',
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
                description: 'not null',
                prerequisite_id: '',
                registration: '',
                tuition: '',
                insurance: '',
                library: '',
                science: '',
                computer: '',
                athletics: '',
                misc: '',
                books: '',
                school_uniform: '',
                pe_uniform: '',

            },
            todo: 'Add',
            editableId: '',
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
        
        levelsFetch(){
            axios.post('/api/levels/fetch')
            .then((res) => {
                this.levels = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },

        saveData(){
            if(this.todo == 'Add'){
                axios.post('../api/levels', this.datas)
                .then((res) => {
                    new Noty({type: 'success', text: 'Successfully saved.', layout: 'topRight'}).show();
                    this.getProjects();
                    this.clearFields();
                    this.levelsFetch();
                })
                .catch((err) => {
                    this.errors.record(err.response.data);
                    new Noty({type: 'error', text: this.errors.get('name'), layout: 'topRight'}).show();
                });
            }
            else if(this.todo == 'Edit'){
                axios.patch('../api/levels/'+this.editableId, this.datas)
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
                            axios.delete('../api/levels/'+dataDelete.id)
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

        getProjects(url = '/api/levels') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.projects = data.data.data;
                        this.configPagination(data.data);
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
