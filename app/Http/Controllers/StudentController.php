<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }

    public function fetchStudent()
    {
        $student = Student::all();
        return response()->json([
            'student'=>$student,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required',
            'phone'=>'required|max:191',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $student = new Student;
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');

            if ($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('uploads/student/', $filename);
                $student->image =$filename;
            }
            $student->save();

            return response()->json([
                'status'=>200,
                'message'=>'Employee image data Added successfully'
            ]);
        }
    }

    public function updateStudent(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required',
            'phone'=>'required|max:191',
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {

            $student =  Student::find($id);
            if ($student)
            {
                $student->name = $request->input('name');
                $student->email = $request->input('email');
                $student->phone = $request->input('phone');

                if ($request->hasFile('image'))
                {
                    $path = 'uploads/student/'.$student->image;
                    if (File::exists($path))
                    {
                        File::delete($path);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('uploads/student/', $filename);
                    $student->image =$filename;
                }
                $student->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Student Updated successfully'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Student not found'
                ]);
            }

        }
    }

    public function deleteStudent($id)
    {
        $studentId = Student::find($id);
        if ($studentId)
        {
            $path = 'uploads/student/'.$studentId->image;
            if (File::exists($path))
            {
                File::delete($path);
            }
            $studentId->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student deleted  successfully'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Student not found'
            ]);
        }

    }

    public function editStudent($id)
    {
        $student = Student::find($id);
        if ($student)
        {
            return response()->json([
                'status'=>200,
                'student'=>$student,
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Student not found'
            ]);
        }
    }
}
