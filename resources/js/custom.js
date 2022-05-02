$('.dropdown-toggle').dropdown();
$(".js-select2").each(function(){
    $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
    });
})

//     function getCartAjax()
//     {
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             url: '{{ url(/get-cart) }}',
//             type: 'GET',
//             success: function(data) {
//                 console.log(data)
//             },
//         })
//     }

// $(document).ready( function() {
//     getCartAjax()
// })
