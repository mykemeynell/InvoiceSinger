$(document).ready(function() {

    $('input.autocomplete').each(function(index, element) {
        let source = $(element).data('source');
        let options = {
            data: new Array(),
            limit: 7,
            onAutocomplete: function(val){},
            minLength: 1
        };
        axios.get(source)
            .then(response => {
                response.data.map(function(item) {
                    let business_name = item.business_name;
                    let id = item.id;

                    return options.data[business_name] = null;
                });
            })
            .then(() => {
                $(element).autocomplete(options);
            });
    });

});
