<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student CRUD</title>
    <link rel="stylesheet" href="{{ asset('/') }}assets/bootstrap.min.css">
</head>
<body>
<!-- Add Student Modal Start -->
    @include('student.add-student')
<!-- Add Student End -->

<!-- Edit Student Modal Start -->
    @include('student.edit-student')
<!-- Edit Student Modal End -->

<!-- Delete Student Modal Start -->
    @include('student.delete-student-modal')
<!-- Delete Student Modal End -->

<!-------------------- Fetch Student Table Start --------------->
    <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Laravel ajax CRUD - Employee Data</h4>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#AddStudentModal" class="btn btn-primary btn-sm float-end">Add Employee</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
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
<!-------------------- Fetch Student Table End --------------->


@include('student.script_js')
</body>
</html>
