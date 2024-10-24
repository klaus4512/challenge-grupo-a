<?php

namespace App\Repositories;

use App\Entity\Student;

interface StudentRepository
{
    public function all(): array;
    public function find(int $ra): ?Student;
    public function create(Student $student): void;
    public function update(Student $student): void;
    public function delete(int $ra): void;
    public function search(string $search): array;
}
