<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["index", "show"]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return new StudentCollection(Student::paginate(10));
        return new StudentCollection(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = Auth::user()->students()->create($request->all());
        return response()->json([
            "message" => "Student created successfully",
            "student" => $student,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
