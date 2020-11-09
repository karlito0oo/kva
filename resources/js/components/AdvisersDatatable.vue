<template>
    <div class="projects">
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
                    <td>{{project.firstName}}</td>
                    <td>{{project.lastName}}</td>
                    <td>{{project.birthday}}</td>
                    <td>{{project.email}}</td>
                    <td>{{project.mobileNumber}}</td>
                </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getProjects(pagination.prevPageUrl)"
                    @next="getProjects(pagination.nextPageUrl)">
        </pagination>
    </div>
</template>

<script>
import Datatable from './Datatables.vue';
import Pagination from './DatatablePagination.vue';
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
        this.getProjects();
    },
    data() {
        let sortOrders = {};

        let columns = [
            { label: 'First Name', name: 'firstName' },
            { label: 'Last Name', name: 'lastName'},
            { label: 'Birthday', name: 'birthday'},
            { label: 'Email', name: 'email'},
            { label: 'Mobile Number', name: 'mobileNumber'}
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            projects: [],
            columns: columns,
            sortKey: 'firstName',
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
        }
    },
    methods: {
        getProjects(url = '/api/advisers') {
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
