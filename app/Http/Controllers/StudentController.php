<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $all_students = student::all();
        return view('student.students_list', ['student' => $all_students]);
    }
    public function create_student(Request $request, $id = null)
    {
        if ($id) {
            $data = student::find($id);
            return view('student.createOrupdate', compact("data"));
        }else{
            return view('student.createOrupdate');
        }
    }
    public function store_students(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'city' => 'required',
                'age' => 'required',
                'stander' => 'required',
                'hobbies' => 'required',
                'gender' => 'required',
                'image' => 'required',
            ],
            [
                'name.required' => 'please enter student name',
                'email.required' => 'please enter student email',
                'city.required' => 'please enter student city',
                'age.required' => 'please enter student age',
                'image.required' => 'please select image',
                'hobbies.required' => 'please enter student hobbies',
                'stander.required' => 'please select student stander',
                'gender.required' => 'please enter student gender',

            ]
        );
        try {
            // dd($request->all());
            $student = new student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->city = $request->city;
            $student->age = $request->age;
            $student->gender = $request->gender;
            $student->stander = $request->stander;
            $student->hobbies = implode(',', $request->hobbies);
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('webimg'), $imageName);
                $student->image = $imageName;
            }
            $student->save();
            return redirect()->route('students.details')->with('success', 'Students Datails Added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'not inserted students data');
        }
    }
    // public function edit($id)
    // {
    //     $student_data = student::find($id);
    //     return view('student.update_student', ['students_update' => $student_data]);
    // }
    public function update(Request $request, $id)
    {
        try {
            $update = student::find($id);
            // $update = student::where('id',$id)->first();
            $update->name = $request->name;
            $update->email = $request->email;
            $update->city = $request->city;
            $update->age = $request->age;
            $update->gender = $request->gender;
            $update->stander = $request->stander;
            $update->hobbies = implode(',', $request->hobbies);
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('webimg'), $imageName);
                $update->image = $imageName;
            }
            $update->save();
            // flash()->success('Operation completed successfully.');
            return redirect()->route('students.details')->with('success', 'Students Datails Update successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Student Data Not Updated');
        }
    }
    public function destroy($id)
    {
        $student = student::find($id);
        if ($student->id) {
            $student_delete = $student->delete();
        }else{
            return response()->json(['error' => 'id is not available']);
        }
        // flash()->success('Operation Deleted successfully.');
        return response()->json(['success' => 'Record deleted successfully!']);
    }
    public function showData($id){
        $show_data =student::find($id);
        return view('student.student_details' , compact('show_data'));
    }
}
