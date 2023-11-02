<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>       
                     <form method="POST" id="addPackageForm">

            <div class="modal-body">

                    @csrf
                    <div class="errMessContainer"></div>

                    <div class="form-group">
                        <label for="ads">{{ __('admin.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" >
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>
                        <button type="submit" class="btn btn-primary add_package">{{ __('admin.submit') }}</button>
                    </div>
            </div>
        </form>

        </div>
    </div>
</div>




<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">{{ __('admin.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateForm">
                    @csrf
                    <input type="hidden" id="up_id">
                    <div class="form-group">
                        <label for="ads">{{ __('admin.name') }}</label>
                        <input type="text" class="form-control" id="up_name" name="up_name"  >
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary update_package">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
</script>



<script>
    $(document).ready(function() {
        $(document).on('click', '.add_package', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('add.department') }}",
                method: 'post',
                data: { name: name ,   _token: csrfToken,
 },
                success: function(res) {
                    if(res.status == 'success'){
                        $('#createModal').modal('hide');
                        $('#addPackageForm')[0].reset();
                        refreshTableData();
                        toastr.success("{{ __('admin.added_successfully') }}")


                    }
                },
                error: function(err) {
                    console.log(err);

                      let error  = err.responseJSON;
                      $.each(error.errors, function(index , value){
                        $('.errMessContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                      });
                }
            });
        });
        $(document).on('click','.update_package_form',function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
           

            $('#up_id').val(id);
            $('#up_name').val(name);
          


        });
             $(document).on('click', '.update_package', function(e) {
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
           
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('update.department') }}",
                method: 'post',
                data: { up_id:up_id,up_name: up_name,  _token: csrfToken,
                },
                success: function(res) {
                    if(res.status == 'success'){
                        $('#updateModal').modal('hide');
                        $('#updateForm')[0].reset();
                        refreshTableData();
                        toastr.success("{{ __('admin.update_successfullay') }}")

                    }
                },
                error: function(err) {
                    console.log(err);

                      let error  = err.responseJSON;
                      $.each(error.errors, function(index , value){
                        $('.errMessContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                      });
                }
            });
    });
    function refreshTableData() {
    $.ajax({
        url: "{{ route('get.departments') }}", // Replace with your backend endpoint to fetch package data
        method: 'get',
        success: function(data) {
            // Replace the table body content with new data
            $('#table tbody').html(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
}

    });
</script>
