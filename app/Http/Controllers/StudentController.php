<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\ClassesResouce;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $studentsQuery = Student::query();

        $this->applySearch($studentsQuery, $request->search);

        $students = StudentResource::collection(
            $studentsQuery->paginate(10)
        );

        return inertia('Students/Index',
            [
                'students' => $students,
                'search' => $request->search ?? '',
            ]
        );
    }

    protected function  applySearch($query ,$search){

        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $classes = ClassesResouce::collection(Classes::all());

        return inertia('Students/Create',
            [
                'classes' => $classes,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
            Student::create($request->validated());

            return redirect()->route('students.index');
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
    public function edit(Student  $student)
    {
        $classes = ClassesResouce::collection(Classes::all());

        return inertia('Students/Edit',
            [
                'classes' => $classes,
                'student' => StudentResource::make($student),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());


        return redirect()->route('students.index');

        
    }
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete(); 

        return redirect()->route('students.index');
    }
    
}
