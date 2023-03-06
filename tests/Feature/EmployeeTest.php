<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if user can create employee.
     *
     * @return void
     */
    /** @test */
    public function test_employee_creation()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);
        $this->actingAs($user)
            ->get('/home')
            ->assertStatus(200);
        
        $company = Company::factory()->create(['logo' => 'null']);

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

    /**
     * Test if user can edit employee
     *
     * @return void
     */
     /** @test */  
    public function test_edit_employee()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);
        $this->actingAs($user)
            ->get('/home')
            ->assertStatus(200);
        $company = Company::factory()->create(['logo' => 'null']);
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

    /**
     * Test if user can delete employee
     *
     * @return void
     */
     /** @test */  
    public function testDeleteEmployee()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);
        $this->actingAs($user)
            ->get('/home')
            ->assertStatus(200);
        $employee = Employee::factory()->create();

        $response = $this->delete(route('employees.destroy', $employee->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
