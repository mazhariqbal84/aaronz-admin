

<script>

    $(document).ready(function(){
        @include('messages.jquery-messages')
        MakeMenuActive('#c_locations', '#buildings', '#cms_anchor');
        //TODO: Getting Data and passing into yajra datatables
        var DataTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
                dom: '<"top"f><"responsivetb"rt><"bottom"ilp><"clear">',
        ajax: "{{ route('locations.buildings.index')  }}",
        columns: [
            { data: 'DT_RowIndex' },
            { data: 'name' },
            { data: 'locations.name' },
            { data: 'location_areas.name' },
            { data: 'location_states.name' },
            { data: 'location_countries.name' },
            { data: 'latitude' },
            { data: 'longitude' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false}
            ]
        });

         //delete zone here
         $('body').delegate('#delete_language','click',function(){
            // return console.log('hello');
              const id = $(this).attr('data-id');
              $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Location? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function () {
                        },
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function(){
                                $.ajax({
                                    url:"{{ route('locations.buildings.delete') }}",
                                    method:"POST",
                                    data : {"_token":"{{ csrf_token() }}",id},
                                    success:function(res)
                                    {
                                        DataTable.ajax.reload();
                                        $.alert('Location Deleted Successfully!');;
                                    },
                                    error:function(xhr)
                                    {
                                        console.log(xhr.responseText);
                                    }
                                });
                            }
                        }
                    }
                });
              });


           //change delete status here
           $('body').delegate('#change_status','click',function(){
              const id = $(this).attr('data-id');
              const option = $(this);
              $.ajax({
                  url:"{{ route('locations.buildings.status') }}",
                  method:"POST",
                  data : {"_token":"{{ csrf_token() }}",id},
                  success:function(res){
                    DataTable.ajax.reload();
                  },error:function(xhr){

                      console.log(xhr.responseText);
                  }
              });

           });

        });
</script>