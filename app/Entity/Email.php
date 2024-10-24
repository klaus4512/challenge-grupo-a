<?php

namespace App\Entity;

class Email implements \JsonSerializable
{
    private string $address;

    public function __construct(string $address)
    {
        if (filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid email');
        }
        $this->address = $address;
    }

    public function __toString():string
    {
        return $this->address;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
