<script src="{{ asset('/') }}assets/jquery-3.6.1.min.js"></script>
<script src="{{ asset('/') }}assets/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
//-----------------Add Student Start----------------
        $(document).on('submit','#AddStudentFORM', function (e) {
            e.preventDefault();

            let formData = new FormData($('#AddStudentFORM')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('student') }}",
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


                        $('#AddStudentFORM').find('input').val('');
                        $('#AddStudentModal').modal('hide');

                        fetchStudent();
                        alert(response.message);
                    }
                }
            });
        });
//-----------------Add Student End---------------

//-----------------Fetch Student Start---------------
        fetchStudent();
        function fetchStudent()
        {
            $.ajax({
                type: 'get',
                url: '{{ route('student.fetch') }}',
                datatype: 'json',
                success:function (response) {
                    $('tbody').html("");
                    $.each(response.student,function (key,item) {
                        $('tbody').append(`
                            <tr>
                                    <td>`+item.id+`</td>
                                    <td>`+item.name+`</td>
                                    <td>`+item.email+`</td>
                                    <td>`+item.phone+`</td>
                                    <td>
                                        <img src="uploads/student/`+item.image+`" width="50" height="50" alt="Image">
                                    </td>
                                    <td>
                                        <button value="`+item.id+`" class="edit_btn btn btn-success">Edit</button>
                                    </td>
                                    <td>
                                        <button value="`+item.id+`" class="delete_btn btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                        `);
                    })
                }
            });
        }
//-----------------Fetch Student End---------------

//-----------------Delete Student Start---------------

        $(document).on(`click`,'.delete_btn',function (e) {
            e.preventDefault();
            let emp_id = $(this).val();
            // alert(emp_id);
            $('#DeleteStudentModal').modal('show');
            $('#deleting_student_id').val(emp_id)
        })

        $(document).on(`click`,'.delete_employee_btn',function (e) {
            e.preventDefault();
            let id = $('#deleting_student_id').val();
            $.ajax({
                // type:'get',
                method:'get', /*----type or method and delete method or get method same work---*/
                url:'student-delete/'+id,
                dataType: 'json', /*----dataType not mandatory---*/
                success:function (response) {
                    if(response.status == 404)
                    {
                        alert(response.message);
                        $('#DeleteStudentModal').modal('hide');
                    }
                    else if(response.status == 200)
                    {
                        fetchStudent()
                        $('#DeleteStudentModal').modal('hide');
                        alert(response.message);

                    }
                }
            });
        });
//-----------------Delete Student End---------------

//-----------------Edit Student Start---------------
        $(document).on(`click`,'.edit_btn',function (e) {
        e.preventDefault();

            let edit_id = $(this).val();

            $('#edit_id').val(edit_id);
            $('#EDITStudentModal').modal('show');

            $.ajax({
                method: 'get',
                url: 'student-edit/'+edit_id,
                success: function (response) {
                    console.log(response.student.name);
                    $('#edit_name').val(response.student.name);
                    $('#edit_email').val(response.student.email);
                    $('#edit_phone').val(response.student.phone);
                    $('#imageId').html(`
                            <img src="uploads/student/`+response.student.image+`" width="50" height="50" alt="Image">
                    `)
                }
            });
        })
//-----------------Edit Student End---------------

//-----------------Update Student Start---------------
        $(document).on(`submit`,'#UpdateStudentFORM',function (e) {
            e.preventDefault();
            var id = $('#edit_id').val();

            let updateFormData = new FormData($('#UpdateStudentFORM')[0]);

            $.ajax({
                method:'POST',
                url:"student-update/"+id,
                data: updateFormData,
                contentType: false,
                processData: false,
                success:function (response) {
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


                        $('#UpdateStudentFORM').find('input').val('');
                        $('#EDITStudentModal').modal('hide');
                        fetchStudent()
                        alert(response.message);
                    }
                }
            })

        });
//-----------------Update Student End---------------
    });
</script>
