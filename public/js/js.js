
$(document).ready(function() {
    fetch_customer_data();

    function fetch_customer_data(query = '') {
        $.ajax({
            url: "{{ route('cajasAjax') }}",
            method: 'GET',
            data: {
                query: query
            },
            dataType: 'json',
            success: function(data) {
                /*
                var arreglo =JSON.parse(data)
                for (var row=0; row<arreglo.length; row++){
                    var todo='<tr><td>'+arreglo[row].descripcion'</td></tr>';
                }*/
               $('#cajabody').html(data.table_data);
        
                $('#total_cajas').text(data.total_data);
            }
        })
    }
    $(document).on('keyup', '#search', function() {
        var query = $(this).val();
        fetch_customer_data(query);
    });
});
