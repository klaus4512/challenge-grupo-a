<?php

use PHPUnit\Framework\TestCase;
use App\Entity\CPF;

class CPFTest extends TestCase
{
    public function testValidCPF(): void
    {
        $cpf = new CPF('123.456.789-09');
        $this->assertEquals('12345678909', $cpf->getNumber());
    }

    public function testInvalidCPF(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid CPF');
        new CPF('111.111.111-11');
    }

    public function testToString(): void
    {
        $cpf = new CPF('123.456.789-09');
        $this->assertEquals('12345678909', (string)$cpf);
    }

    public function testJsonSerialize(): void
    {
        $cpf = new CPF('123.456.789-09');
        $expected = ['number' => '12345678909'];
        $this->assertEquals($expected, $cpf->jsonSerialize());
    }
}
