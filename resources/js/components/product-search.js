let search_field = $('#product-search-field');
let results_table = $('#product-search-table');

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
        defaultContent: "<a href='#' class='js-add-product waves-effect waves-light btn-flat grey lighten-4'>Add</a>",
        className: "right-align"
    }]
});

$('#product-search-table tbody').on( 'click', '.js-add-product', function () {
    var data = table.row($(this).parents('tr')).data();

    console.log("Product ID: ", data.id);
} );


search_field.on('keyup', function(event) {
    event.preventDefault();
    let table_search = $('#product-search-table_filter input[type="search"]');

    table_search.val($(this).val());
    table_search.trigger('keyup');
});
