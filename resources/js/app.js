/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('materialize-css/dist/js/materialize');

window.Vue = require('vue');

import ProductRow from './components/ProductRow.vue';
import ProductTable from './components/ProductTable.vue';
import PaymentSettings from './components/settings/PaymentSettings.vue';

Vue.component('product-row', ProductRow);
Vue.component('product-table', ProductTable);
Vue.component('payment-settings', PaymentSettings);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

$(document).ready(function() {
    $('select').formSelect();
    $('.dropdown-trigger').dropdown();
    $('.datepicker').datepicker({
        format: 'dd mmmm yyyy'
    });
    $('.timepicker').timepicker();
    $('.tooltipped').tooltip();

    let results_table = $('#product-search-table');
    if(results_table.length > 0) {
        window.table = results_table.DataTable({
            ajax: {
                url: '/api/products',
                dataSrc: ''
            },
            columns: [
                {data: 'sku'},
                {data: 'family.name'},
                {data: 'name'},
                {data: 'unit.name'},
                {data: 'price'}
            ],
            columnDefs: [{
                targets: 5,
                data: null,
                defaultContent: "<a class=\"js-add-product waves-effect waves-dark btn-flat grey lighten-4\">Add</a>",
                className: "right-align"
            }]
        });
    }
});
