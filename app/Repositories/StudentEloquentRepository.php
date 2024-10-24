<?php

namespace App\Repositories;

use App\Entity\CPF;
use App\Entity\Email;
use App\Entity\Student;

class StudentEloquentRepository implements StudentRepository
{

    private function modelToObject(?\App\Models\Student $studentModel): ?Student
    {
        if (is_null($studentModel)) {
            return null;
        }

        return new Student(
            $studentModel->name,
            new CPF($studentModel->cpf),
            new Email($studentModel->email),
            $studentModel->ra
        );
    }
    public function all(): array
    {
        return \App\Models\Student::all()->toArray();
    }

    public function find(int $ra): ?Student
    {
        return $this->modelToObject(\App\Models\Student::query()->where('ra', $ra)->first());
    }

    public function create(Student $student): void
    {
        $studentModel = new \App\Models\Student();
        $studentModel->name = $student->getName();
        $studentModel->email = $student->getEmail()->getAddress();
        $studentModel->cpf = $student->getCpf()->getNumber();
        $studentModel->ra = $student->getRa();
        $studentModel->save();
    }

    public function update(Student $student): void
    {
        $studentModel = \App\Models\Student::query()->where('ra', $student->getRa())->first();
        $studentModel->name = $student->getName();
        $studentModel->email = $student->getEmail()->getAddress();
        $studentModel->save();
    }

    public function delete(int $ra): void
    {
        \App\Models\Student::query()->where('ra', $ra)->delete();
    }

    public function search(string $search): array
    {
        return \App\Models\Student::query()
            ->where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhere('cpf', 'like', "%$search%")
            ->orWhere('ra', 'like', "%$search%")
            ->get()
            ->toArray();
    }



}
