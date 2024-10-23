<?php

namespace Tests\Unit\Services;

use App\Entity\CPF;
use App\Entity\Email;
use App\Entity\Student;
use App\Repositories\StudentRepository;
use App\Services\StudentService;
use PHPUnit\Framework\TestCase;

class StudentServiceTest extends TestCase
{
    private $studentRepository;
    private $studentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->studentRepository = $this->createMock(StudentRepository::class);
        $this->studentService = new StudentService($this->studentRepository);
    }

    public function testList(): void
    {
        $students = [new Student('John Doe', new CPF('348.491.410-64'), new Email('john@example.com'), 12345)];
        $this->studentRepository->method('all')->willReturn($students);

        $result = $this->studentService->list();
        $this->assertEquals($students, $result);
    }

    public function testFind(): void
    {
        $student = new Student('John Doe', new CPF('348.491.410-64'), new Email('john@example.com'), 12345);
        $this->studentRepository->method('find')->with(12345)->willReturn($student);

        $result = $this->studentService->find(12345);
        $this->assertEquals($student, $result);
    }

    public function testCreate(): void
    {
        $student = new Student('John Doe', new CPF('348.491.410-64'), new Email('john@example.com'), 12345);
        $this->studentRepository->expects($this->once())->method('create')->with($student);

        $this->studentService->create($student);
    }

    public function testUpdate(): void
    {
        $student = new Student('John Doe', new CPF('348.491.410-64'), new Email('john@example.com'), 12345);
        $this->studentRepository->expects($this->once())->method('update')->with($student);

        $this->studentService->update($student);
    }

    public function testDelete(): void
    {
        $this->studentRepository->expects($this->once())->method('delete')->with(12345);

        $this->studentService->delete(12345);
    }

    public function testSearch(): void
    {
        $students = [new Student('John Doe',  new CPF('348.491.410-64'), new Email('john@example.com'), 12345)];
        $this->studentRepository->method('search')->with('John')->willReturn($students);

        $result = $this->studentService->search('John');
        $this->assertEquals($students, $result);
    }
}
