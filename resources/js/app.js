/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('materialize-css/dist/js/materialize');

$(document).ready(function() {
    $('select').formSelect();
    $('.dropdown-trigger').dropdown();
    $('.datepicker').datepicker({
        format: 'dd mmmm yyyy'
    });

    require('./components/product-search');
});
