<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Email;

class EmailTest extends TestCase
{
    public function testValidEmailCreation(): void
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', $email->getAddress());
    }

    public function testInvalidEmailCreation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid email');
        new Email('invalid-email');
    }

    public function testToString(): void
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', (string)$email);
    }

    public function testJsonSerialize(): void
    {
        $email = new Email('test@example.com');
        $expected = ['address' => 'test@example.com'];
        $this->assertEquals($expected, $email->jsonSerialize());
    }
}
