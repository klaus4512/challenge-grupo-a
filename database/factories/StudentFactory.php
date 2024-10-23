<?php

namespace Database\Factories;


use App\Entity\CPF;
use App\Entity\Email;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cpf' => new CPF($this->generateValidCPF()),
            'email' => new Email($this->faker->unique()->safeEmail),
            'ra' => $this->faker->unique()->randomNumber(5),
        ];
    }

    private function generateValidCPF(): string
    {
        $cpf = [];
        for ($i = 0; $i < 9; $i++) {
            $cpf[] = rand(0, 9);
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            $cpf[] = $d;
        }

        return implode('', $cpf);
    }
}
