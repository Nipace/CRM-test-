<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test employee creation.
     *
     * @return void
     */
    /** @test */
    public function test_employee_creation()
    {
        $company = Company::factory()->create();

        $response = $this->post('/employees', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => $company->id,
            'email' => 'john@example.com',
            'phone' => '1234567890',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/employees');

        $this->assertDatabaseHas('employees', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => $company->id,
            'email' => 'john@example.com',
            'phone' => '1234567890',
        ]);
    }

    public function test_edit_employee()
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->id]);

        $newFirstName = 'New First Name';
        $newLastName = 'New Last Name';

        $response = $this->put(route('employees.update', $employee->id), [
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
            'company_id' => $company->id,
            'email' => $employee->email,
            'phone' => $employee->phone,
        ]);

        $response->assertRedirect(route('employees.index'));
        $response->assertSessionHas('message');

        $employee = $employee->fresh();

        $this->assertEquals($newFirstName, $employee->first_name);
        $this->assertEquals($newLastName, $employee->last_name);
        $this->assertEquals($company->id, $employee->company_id);
    }

    public function testDeleteEmployee()
{
    $employee = Employee::factory()->create();

    $response = $this->delete(route('employees.destroy', $employee->id));

    $response->assertStatus(302);
    $response->assertRedirect(route('employees.index'));
    $this->assertDatabaseMissing('employees', ['id' => $employee->id]); 
}
}
