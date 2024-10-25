<?php

namespace App\Entity;

class CPF implements \JsonSerializable
{
    private string $number;

    public function __construct(string $number)
    {
        if ($this->checkCPF($number) === false) {
            throw new \InvalidArgumentException('Invalid CPF');
        }
        $this->number = preg_replace("/[^A-Za-z0-9]/", "", $number);
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function __toString():string
    {
        return $this->number;
    }

    public function getNumber(): string
    {
        return $this->number;
    }



    private function checkCPF($cpf):bool
    {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) !== 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }
}
