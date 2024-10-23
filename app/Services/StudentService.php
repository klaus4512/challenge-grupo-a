<?php

namespace App\Services;

use App\Entity\Student;
use App\Repositories\StudentRepository;

class StudentService
{

    public function __construct(private readonly StudentRepository $studentRepository)
    {
        //
    }

    public function list():array
    {
        return $this->studentRepository->all();
    }

    public function find(int $ra): ?Student
    {
        return $this->studentRepository->find($ra);
    }

    public function create(Student $student): void
    {
        $this->studentRepository->create($student);
    }

    public function update(Student $student): void
    {
        $this->studentRepository->update($student);
    }

    public function delete(int $ra): void
    {
        $this->studentRepository->delete($ra);
    }

    public function search(string $search): array
    {
        return $this->studentRepository->search($search);
    }
}
