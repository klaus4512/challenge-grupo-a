<?php

namespace App\Http\Controllers;

use App\Entity\CPF;
use App\Entity\Email;
use App\Entity\Student;
use App\Http\Requests\StoreStudent;
use App\Rules\ValidateCPF;
use App\Services\Facade\StudentFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'search' => 'nullable|string',
        ]);

        if ($request->has('search')) {
            return response()->json([
                'students' => StudentFacade::search($request->get('search'))
            ], 200);
        }

        return response()->json([
            'students' => StudentFacade::list()
        ], 200);
    }

    public function show(int $ra): JsonResponse
    {
        return response()->json([
            'student' => StudentFacade::find($ra)
        ], 200);
    }

    public function store(StoreStudent $request): JsonResponse
    {
        $data = $request->all();
        $student = new Student(
            $data['name'],
            new CPF($data['cpf']),
            new Email($data['email']),
            $data['ra']
        );

        StudentFacade::create($student);

        return response()->json([
            'message' => 'Student created'
        ], 201);
    }

    public function update(Request $request, int $ra): JsonResponse
    {
       $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $student = StudentFacade::find($ra);

        $data = $request->all();

        $student->setName($data['name']);
        $student->setEmail(new Email($data['email']));

        StudentFacade::update($student);

        return response()->json([
            'message' => 'Student updated'
        ], 200);
    }

    public function destroy(int $ra): JsonResponse
    {
        StudentFacade::delete($ra);

        return response()->json([
            'message' => 'Student deleted'
        ], 200);
    }
}
