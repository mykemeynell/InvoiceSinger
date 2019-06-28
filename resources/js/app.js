/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

require('materialize-css/dist/js/materialize');

$(document).ready(function() {
    $('select').formSelect();
    $('.dropdown-trigger').dropdown();
    $('.datepicker').datepicker({
        format: 'dd mmmm yyyy'
    });

    let results_table = $('#product-search-table');
    if(results_table.length > 0) {
        let table = results_table.DataTable({
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
                defaultContent: "<a href='#' v-on:click='addProduct()' class='waves-effect waves-light btn-flat grey lighten-4'>Add</a>",
                className: "right-align"
            }]
        });

        $('#product-search-table tbody').on('click', '.js-add-product', function () {
            var product = table.row($(this).parents('tr')).data();

            console.log("Product: ", product);
        });
    }
});

import ProductRow from './components/product-row.vue';
Vue.component('product-row', ProductRow);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        addProduct() {
            let ComponentClass = window.Vue.extent(ProductRow);
            let instance = new ComponentClass({
                propsData: {product: {}}
            });
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
        }
    }
});
