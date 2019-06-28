let search_field = $('#product-search-field');
let results_table = $('#product-search-table');

results_table.DataTable({
    ajax: {
        url: '/api/products',
        dataSrc: ''
    },
    columns: [
        {data: 'sku'},
        {data: 'family.name'},
        {data: 'name'},
        {data: 'unit.name'},
        {data: 'price'},
        {data: 'id'},
    ]
});


search_field.on('keyup', function(event) {
    event.preventDefault();
    let table_search = $('#product-search-table_filter input[type="search"]');

    table_search.val($(this).val());
    table_search.trigger('keyup');
});
