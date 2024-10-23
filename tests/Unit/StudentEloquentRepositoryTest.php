<?php

namespace Tests\Unit;

use App\Entity\CPF;
use App\Entity\Email;
use App\Entity\Student;
use App\Models\Student as StudentModel;
use App\Repositories\StudentEloquentRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class StudentEloquentRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private StudentEloquentRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new StudentEloquentRepository();
    }

    public function testAll(): void
    {
        StudentModel::factory()->count(3)->create();
        $students = $this->repository->all();
        $this->assertCount(3, $students);
    }

    public function testFind(): void
    {
        $studentModel = StudentModel::factory()->create(['ra' => 12345]);
        $student = $this->repository->find(12345);
        $this->assertNotNull($student);
        $this->assertEquals($studentModel->name, $student->getName());
    }

    public function testCreate(): void
    {
        $student = new Student('John Doe', new CPF('348.491.410-64'), new Email('john@example.com'), 12345);
        $this->repository->create($student);
        $this->assertDatabaseHas('students', ['ra' => 12345]);
    }

    public function testUpdate(): void
    {
        $studentModel = StudentModel::factory()->create(['ra' => 12345, 'name' => 'John Doe', 'email' => 'test@gmail.com']);

        $student = $this->repository->find(12345);
        $student->setName('Jane Doe');
        $student->setEmail(new Email('teste2@gmail.com'));
        $this->repository->update($student);
        $this->assertDatabaseHas('students', ['ra' => 12345, 'name' => 'Jane Doe', 'email' => 'teste2@gmail.com']);
    }

    public function testDelete(): void
    {
        $studentModel = StudentModel::factory()->create(['ra' => 12345]);
        $this->repository->delete(12345);
        $this->assertDatabaseMissing('students', ['ra' => 12345]);
    }

    public function testSearch(): void
    {
        StudentModel::factory()->create(['name' => 'John Doe']);
        $students = $this->repository->search('John');
        $this->assertCount(1, $students);
    }
}
