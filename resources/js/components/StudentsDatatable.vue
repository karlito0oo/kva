<template>

    <div class="projects">

        <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><span style="color:black;" v-html="pageName"></span>s <small>({{ (currentLevel ? currentLevel.name : 'All') }})</small></h2>
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
                                        <td>{{(project.currentEnrollment ? project.currentEnrollment.levelName : 'N/A')}}</td>
                                        <td>{{project.gender}}</td>
                                        <td>{{project.birthday}}</td>
                                        <td>{{project.email}}</td>
                                        <td>{{project.contactno}}</td>
                                        <td>
                                            <div class="dropdownn">
                                                <span><i class="fa fa-ellipsis-v"></i></span>
                                                <div class="dropdown-contentt">
                                                    <a class="dropdown-item" :href="'/api/admin/enrollment/'+project.id">{{(!project.currentEnrollment ? 'Enroll' : 'Update Enrollment')}}</a>
                                                    <a class="dropdown-item" :href="'/api/students/' + project.id">Update</a>
                                                    <a class="dropdown-item" href="#" @click="deleteData(project)">Delete</a>
                                                    <hr>
                                                    <a class="dropdown-item" :href="'/api/students/' + project.id">Print Reg Form</a>
                                                    <a class="dropdown-item" href="#" @click="deleteData(project)">Print Good Moral</a>
                                                </div>
                                            </div>
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
    
    props: ['level'],

    created() {
        this.getProjects();

    },
    mounted(){
        this.tableData.level_id = (this.currentLevel ? this.currentLevel.id : null);
    },
    data() {
        let sortOrders = {};

        let columns = [
            { name: 'lname', label: 'LAST NAME'},
            { name: 'name', label: 'FIRST NAME' },
            { name: 'middlename', label: 'MIDDLE NAME'},
            { name: 'name', label: 'GRADE LEVEL'},
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
                level_id: '',
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
                firstName: '',
                lastName: '',
                gender: '',
                email: '',
                mobileNumber: '',
                birthday: '',

            },
            todo: 'Add',
            editableId: '',
            endPoint: '/api/users/',
            pageName: 'Student',
            errors: new Errors(),
            currentLevel: (this.level ? JSON.parse(this.level) : null),
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
                axios.patch(this.endPoint+this.editableId, this.datas)
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
                            axios.delete(endPoint+dataDelete.id)
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
