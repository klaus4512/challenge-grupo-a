<?php

namespace App\Entity;

class Student implements \JsonSerializable
{
    private string $name;
    private CPF $cpf;

    private Email $email;

    private int $ra;

    public function __construct(string $name, CPF $cpf, Email $email, int $ra)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->ra = $ra;
    }


    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function getCpf(): CPF
    {
        return $this->cpf;
    }

    public function getRa(): int
    {
        return $this->ra;
    }
}
