<template>

    <div class="projects">

        <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div :class="isAdmin == '1' ? 'col-md-12' : 'col-md-8'">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Credentials Request</h2>
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
                                        <td v-if="isAdmin == '1'">{{project.users.name + ' ' + project.users.lname}}</td>
                                        <td v-if="isAdmin == '1'">{{project.users.currentEnrollment ? project.users.currentEnrollment.levelName : "N/A"}}</td>
                                        <td v-if="isAdmin == '1'">{{project.users.currentEnrollment ? project.users.currentEnrollment.sectionName : "N/A"}}</td>
                                        <td>{{project.type}}</td>
                                        <td>{{project.created_at}}</td>
                                        <td style="text-transform: uppercase">{{project.status}}</td>

                                        <td v-if="project.status == 'pending'">
                                            <button v-if="isAdmin == '0'" class="btn btn-danger btn-sm" @click="deleteData(project)"><span class="fa fa-trash"></span></button>
                                            <button v-if="isAdmin == '1'" class="btn btn-success btn-sm" @click="approveRequest(project)"><span class="fa fa-check"></span></button>
                                        </td>
                                        <td v-if="project.status == 'approved'">
                                            <a target="_blank" :href="project.type == 'Good Moral' ? '/print/exportGoodmoral/' + project.users.id + '/0' : '/print/exportRegForm/' + project.users.id + '/0'"><button class="btn btn-success btn-sm"><span class="fa fa-print"></span></button></a>
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


                
                <div class="col-md-4" v-if="isAdmin == '0'">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><span style="color:black;" v-html="todo"></span> Request</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            
									<form class="form-horizontal form-label-left" @submit.prevent="saveData()">

										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Type</label>
											<div class="col-md-9 col-sm-9 ">
												<select class="form-control" v-model="datas.type">
                                                    <option value="">Choose option</option>
                                                    <option>Good Moral</option>
                                                    <option v-if="isEnrolled == '1'">Enrollment Form</option>
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
       
    props: ['isEnrolled', 'isAdmin'],

    created() {
        this.getProjects();

    },
    data() {
        let sortOrders = {};
        
        let columns = this.isAdmin == "0" ? [
            { label: 'TYPE', name: 'type' },
            { label: 'DATE', name: 'created_at' },
            { label: 'STATUS', name: 'status' },
            //{ label: 'Description', name: 'description'},
        ] : [
            { label: 'STUDENT NAME', name: 'type' },
            { label: 'LEVEL', name: 'type' },
            { label: 'SECTION', name: 'type' },
            { label: 'TYPE', name: 'type' },
            { label: 'DATE', name: 'created_at' },
            { label: 'STATUS', name: 'status' },
            //{ label: 'Description', name: 'description'},
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
                type: '',

            },
            user:{},
            todo: 'Add',
            editableId: '',
            endPoint: '/api/requests',
            errors: new Errors(),
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
                            axios.delete(endPoint+'/'+dataDelete.id)
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

        approveRequest(dataDelete){
            var self = this;
            var endPoint = this.endPoint;
            new Noty({
                text: 'Do you want to approve this?',
                type: 'success', 
                buttons: [
                    {
                        addClass: 'btn btn-success btn-sm', text: 'Ok', onClick: function($noty) {
                            axios.patch(endPoint+'/'+dataDelete.id)
                            .then((res) => {
                                self.getProjects();
                                self.clearFields();
                                new Noty({type: 'success', text: 'Successfully approved.', layout: 'topRight'}).show();
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
