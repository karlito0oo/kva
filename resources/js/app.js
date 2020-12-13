/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
 
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('advisers-datatable', require('./components/AdvisersDatatable.vue').default);

Vue.component('students-datatable', require('./components/StudentsDatatable.vue').default);

Vue.component('school-year-datatable', require('./components/SchoolYearDatatable.vue').default);

Vue.component('levels-datatable', require('./components/LevelsDatatable.vue').default);

Vue.component('subjects-datatable', require('./components/SubjectsDatatable.vue').default);

Vue.component('user-info', require('./components/UsersInfoComponent.vue').default);

Vue.component('student-profile', require('./components/StudentProfileComponent.vue').default);

Vue.component('student-basic', require('./components/StudentBasicComponent.vue').default);

Vue.component('student-enrollment', require('./components/StudentEnrollmentComponent.vue').default);

Vue.component('settings', require('./components/SettingsComponent.vue').default);

Vue.component('enrollment-datatable', require('./components/EnrollmentDatatable.vue').default);

Vue.component('sections-datatable', require('./components/SectionDatatable.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
