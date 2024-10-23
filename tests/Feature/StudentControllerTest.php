<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{

    use RefreshDatabase;
    public function testIndexWithoutSearch(): void
    {
        $response = $this->getJson('api/students');
        $response->assertStatus(200)
            ->assertJsonStructure(['students']);
    }

    public function testIndexWithSearch(): void
    {
        $response = $this->getJson('api/students?search=John');
        $response->assertStatus(200)
            ->assertJsonStructure(['students']);
    }

    public function testShow(): void
    {
        $student = Student::factory()->create();
        $response = $this->getJson("api/students/".$student->ra);
        $response->assertStatus(200)
            ->assertJson(['student' => [
                'name' => $student->name,
                'cpf' => [
                    'number' => $student->cpf->getNumber()
                ],
                'email' => [
                    'address' => $student->email->getAddress()
                ],
                'ra' => $student->ra
            ]]);
    }

    public function testStore(): void
    {
        $data = [
            'name' => 'John Doe',
            'cpf' => '348.491.410-64',
            'email' => 'john@example.com',
            'ra' => 12345,
        ];

        $response = $this->postJson('api/students', $data);
        $response->assertStatus(201)
            ->assertJson(['message' => 'Student created']);
    }

    public function testUpdate(): void
    {
        $student = Student::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ];

        $response = $this->putJson("api/students/{$student->ra}", $data);
        $response->assertStatus(200)
            ->assertJson(['message' => 'Student updated']);
    }

    public function testDestroy(): void
    {
        $student = Student::factory()->create();
        $response = $this->deleteJson("api/students/{$student->ra}");
        $response->assertStatus(200)
            ->assertJson(['message' => 'Student deleted']);
    }
}
