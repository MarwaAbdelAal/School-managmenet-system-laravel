<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest as RequestsStudentRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Track;
use Auth;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return students of this track
        // $all_students = Student::where('track_id', 1)->withTrashed()->get();
        $all_students = Student::all();
        return view('students.index', ['students' => $all_students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // authorize user
        $this->authorize('create', Student::class);
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        if(Auth::user()->cannot('create', Student::class)) {
            abort(403);
        }
        // $student = Student::create($request->all());
        $student = $request->user()->students()->create(array_merge($request->all(), ['user_id' => 1, 'track_id' => 1]));
        if($student->save()) {
            return redirect()->route('students.index')->with('success', 'Student created successfully.');
        }
        return back()->with('error', 'Student not created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        // authorize user
        $this->authorize('update', $student);
        return view('students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // authorize user
        if($request->user()->cannot('update', $student)) {
            abort(403);
            // return back()->with('error', 'You do not own this student.');
        }
        // compare current student with request
        if ($student->IDno != $request->IDno) {
            $request->validate([
                'IDno' => 'required|unique:students,IDno,NULL,id,deleted_at,NULL|max:10',
            ]);
            $student->IDno = $request->IDno;
        }
        if ($student->name != $request->name) {
            $request->validate([
                'name' => 'required|max:20',
            ]);
            $student->name = $request->name;
        }
        if ($student->age != $request->age) {
            $request->validate([
                'age' => 'required',
            ]);
            $student->age = $request->age;
        }
        if ($student->save()) {
            // $request->session()->flash('success', 'Student updated successfully.');
            return redirect()->route('students.index')->with('success', 'Student updated successfully.');
        }
        return back()->with('error', 'Student not updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Student::destroy($id)) {
            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        }
        return back()->with('error', 'Student not deleted.');
    }
}
