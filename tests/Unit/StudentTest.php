<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Student;
use App\Entity\CPF;
use App\Entity\Email;

class StudentTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testStudentCreation(): void
    {
        $cpf = $this->createMock(CPF::class);
        $email = $this->createMock(Email::class);
        $student = new Student('John Doe', $cpf, $email, 12345);

        $this->assertEquals('John Doe', $student->getName());
        $this->assertSame($cpf, $student->getCpf());
        $this->assertSame($email, $student->getEmail());
        $this->assertEquals(12345, $student->getRa());
    }

    public function testSetName(): void
    {
        $cpf = $this->createMock(CPF::class);
        $email = $this->createMock(Email::class);
        $student = new Student('John Doe', $cpf, $email, 12345);

        $student->setName('Jane Doe');
        $this->assertEquals('Jane Doe', $student->getName());
    }

    public function testSetEmail(): void
    {
        $cpf = $this->createMock(CPF::class);
        $email = $this->createMock(Email::class);
        $newEmail = $this->createMock(Email::class);
        $student = new Student('John Doe', $cpf, $email, 12345);

        $student->setEmail($newEmail);
        $this->assertSame($newEmail, $student->getEmail());
    }

    public function testJsonSerialize(): void
    {
        $cpf = $this->createMock(CPF::class);
        $email = $this->createMock(Email::class);
        $student = new Student('John Doe', $cpf, $email, 12345);

        $expected = [
            'name' => 'John Doe',
            'cpf' => $cpf,
            'email' => $email,
            'ra' => 12345,
        ];

        $this->assertEquals($expected, $student->jsonSerialize());
    }
}
