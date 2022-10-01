<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Webit CRUD</title>
    <link rel="stylesheet" href="{{ asset('/') }}assets/bootstrap.min.css">
</head>
<body>
<!-- Add Employee Modal Start -->
<div class="modal fade" id="AddEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="AddEmployeeFORM" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <ul class="alert alert-warning d-none" id="save_errorList"></ul>
                   <div class="form-group mb3">
                       <label for="name">Name</label>
                       <input type="text" name="name" class="form-control">
                   </div>
                   <div class="form-group mb3">
                       <label for="phone">Phone</label>
                       <input type="text" name="phone" class="form-control">
                   </div>
                   <div class="form-group mb3">
                       <label for="name">Name</label>
                       <input type="file" name="image" class="form-control">
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Add Employee End -->

<!-- Edit Employee Modal Start -->
<div class="modal fade" id="EDITEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="UpdateEmployeeFORM" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="emp_id" id="emp_id">
                    <ul class="alert alert-warning d-none" id="update_errorList"></ul>

                    <div class="form-group mb3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control">
                    </div>
                    <div class="form-group mb3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control">
                    </div>
                    <div class="form-group mb3">
                        <label for="name">Name</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Edit Employee Modal End -->

<!-- Delete Employee Modal Start -->
<div class="modal fade" id="DeleteEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <h5>Are you sure? you want to delete data</h5>
                    <input type="hidden" id="deleting_employee_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="delete_employee_btn brn btn-primary">Yes Delete</button>
                </div>
        </div>
    </div>
</div>
<!-- Delete Employee Modal End -->

<!--------------------------------------------------------
 | Fetch Employee Print  Start
 --------------------------------------------------------->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laravel ajax CRUD - Employee Data</h4>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AddEmployeeModal" class="btn btn-primary btn-sm float-end">Add Employee</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Image</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--------------------------------------------------------
 | Fetch Employee Print  End
 --------------------------------------------------------->

<script src="{{ asset('/') }}assets/jquery-3.6.1.min.js"></script>
<script src="{{ asset('/') }}assets/bootstrap.bundle.min.js"></script>
<script>
   $(document).ready(function () {
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

//-----------------Fetch Employee  Start---------------
       fetchEmployee()
       function fetchEmployee()
       {
           $.ajax({
               type: "GET",
               url: "{{ route('fetch.employee') }}",
               datatype: "json",
               success: function (response) {
                    // console.log(response.employee);
                   $('tbody').html("");
                   $.each(response.employee, function (key,item) {
                        $('tbody').append(`<tr>\
                                        <td>`+item.id+`</td>\
                                        <td>`+item.name+`</td>\
                                        <td>`+item.phone+`</td>\
                                        <td><img src="uploads/employee/`+item.image+`" width="50px" height="50px" alt="Image"></td>\
                                        <td><button type="button" value="`+item.id+`" class="edit_btn btn btn-success btn-sm">Edit</button></td>\
                                        <td><button type="button" value="`+item.id+`" class="delete_btn btn-danger btn-sm">Delete</button></td>\
                                        </tr>`);
                   })
               }
           });
        }

       //-----------------Fetch Employee  End---------------

       //-----------------Edit Employee  Start---------------
       $(document).on(`click`,'.edit_btn', function (e) {
          e.preventDefault();

          var emp_id = $(this).val();
          $('#EDITEmployeeModal').modal('show');
          // alert(emp_id);

           $.ajax({
               type:"GET",
               url:"edit-employee/"+emp_id,
               // url: "employee-delete/"+id,
               success:function (response) {
                    if(response.status == 404)
                    {
                        alert(response.message);
                        $('#EDITEmployeeModal').modal('hide');
                    }
                    else
                       {
                            $('#edit_name').val(response.employee.name);
                            $('#edit_phone').val(response.employee.phone);
                            $('#emp_id').val(emp_id);
                       }
               }
           });
       });
       //-----------------Edit Employee  End---------------


       //-----------------Update Employee  Start---------------
       $(document).on(`submit`,'#UpdateEmployeeFORM', function (e) {
          e.preventDefault();

          var id = $('#emp_id').val();
         let EditFormData = new FormData($('#UpdateEmployeeFORM')[0]);

           $.ajax({
               type:"POST",
               url:"update-employee/"+id,
               data:EditFormData,
               contentType: false,
               processData: false,
               success:function (response) {
                   if(response.status == 404)
                   {
                       $('#update_errorList').html('');
                       $('#update_errorList').removeClass('d-none');
                       $.each(response.errors, function (key, err_value) {
                           $('#update_errorList').append('<li class="text-danger">'+err_value+'</li>');
                       });
                   }
                   else if(response.status == 200)
                   {
                       $('#update_errorList').html('');
                       $('#update_errorList').addClass('d-none');


                       $('#EDITEmployeeModal').find('input').val('');
                       $('#EDITEmployeeModal').modal('hide');
                       fetchEmployee()
                       alert(response.message);
                   }
               }
           });

       });
       //-----------------Update Employee  End---------------





//-----------------Delete Employee  Start---------------

        $(document).on(`click`,'.delete_btn', function (e) {
            e.preventDefault();

            let emp_id = $(this).val();
            $('#DeleteEmployeeModal').modal('show');
            $('#deleting_employee_id').val(emp_id)

        });

       $(document).on(`click`,'.delete_employee_btn', function (e) {
           e.preventDefault();
           var id =  $('#deleting_employee_id').val();

           $.ajax({
               type: "DELETE",
               url: "employee-delete/"+id,
               datatype: "json",
               success: function (response) {
                  if(response.status == 404)
                  {
                      alert(response.message);
                      $('#DeleteEmployeeModal').modal('hide');
                  }
                  else if(response.status == 200)
                  {
                      fetchEmployee()
                      $('#DeleteEmployeeModal').modal('hide');
                      alert(response.message);

                  }
               }
           });
       });

 //-----------------Delete Employee  End---------------



//-----------------Add Employee Start----------------
        $(document).on('submit','#AddEmployeeFORM', function (e) {
            e.preventDefault();

            let formData = new FormData($('#AddEmployeeFORM')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('employee') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == 400)
                    {
                        $('#save_errorList').html('');
                        $('#save_errorList').removeClass('d-none');
                        $.each(response.errors, function (key, err_value) {
                            $('#save_errorList').append('<li class="text-danger">'+err_value+'</li>');
                        });
                    }
                    else if(response.status == 200)
                    {
                        $('#save_errorList').html('');
                        $('#save_errorList').addClass('d-none');


                        $('#AddEmployeeFORM').find('input').val('');
                        $('#AddEmployeeModal').modal('hide');
                        fetchEmployee()
                        alert(response.message);
                    }
                }
            });
        });
//-----------------Add Employee End---------------
   });
</script>

</body>
</html>
