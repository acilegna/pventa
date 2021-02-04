   /* url:"./action",   url:"{{ route('action') }}",*/
      $(document).ready(function(){ 
        fetch_customer_data();
        function fetch_customer_data(query = ''){
          $.ajax({
            url:"./actionC ",
            type: "GET",
            data:{query:query},
            dataType:'json',
            success:function(data){
              $('#bodyC').html(data.table_data);
              $('#total_recordsC').text(data.total_data);
            }
          })
        }
        $(document).on('keyup', '#search', function(){
          var query = $(this).val();
          fetch_customer_data(query);
        });
      });
  