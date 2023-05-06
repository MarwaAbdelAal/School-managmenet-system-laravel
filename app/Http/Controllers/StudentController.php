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
        $all_students = Student::all();
        // $all_students = 
        // $all_students = Auth::user()->students()->withTrashed()->get();
        return view('students.index', ['students' => $all_students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $student = Student::create($request->all());
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
    public function edit(string $id)
    {
        $student = Student::find($id);
        return view('students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $student = Student::find($id);
        $student->update($request->all());
        if ($student->save()) {
            // $request->session()->flash('success', 'Student updated successfully.');
            return redirect()->route('students.index')->with('success', 'Student updated successfully.');
        }
        return back()->with('error', 'Student not updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if ($student->delete()) {
            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        }
        return back()->with('error', 'Student not deleted.');
    }
}
