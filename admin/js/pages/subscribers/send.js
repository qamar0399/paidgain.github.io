$(document).ready(function (){
    "use strict";

    /**
     * Dynamically fill the select input.
     * */

    $("#to").select2({
        ajax: {
            url: '/admin/subscribers/search',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (res, params) {
                params.page = params.page || 1;

                return {
                    results: res.data,
                    pagination: {
                        more: res.pagination.more
                    }
                };
            },
            cache: true
        },
        placeholder: 'Search subscriber',
        minimumInputLength: 1,
    });
})(jQuery);

