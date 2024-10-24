<?php

namespace App\Services\Facade;

use App\Entity\Student;
use App\Services\StudentService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array list()
 * @method static Student find(int $id)
 * @method static void create(Student $student)
 * @method static void update(Student $student)
 * @method static void delete(int $id)
 * @method static array search(string $search)
 */

class StudentFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return StudentService::class;
    }
}
