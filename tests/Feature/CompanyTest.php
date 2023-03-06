<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * Test if user can create a company
     *
     * @return void
     */
    /** @test */    
    public function a_user_can_create_a_company()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);
        $this->actingAs($user)
            ->get('/home')
            ->assertStatus(200);
        
        $data = [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
            'logo' => UploadedFile::fake()->image('logo.jpg'),
        ];
        $response = $this->post(route('companies.store'), $data);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $company = Company::first();
        $this->assertEquals($data['name'], $company->name);
        $this->assertEquals($data['email'], $company->email);
        $this->assertEquals($data['website'], $company->website);
        $this->assertNotNull($company->logo);

    }

    /**
     * Test if user can edit company
     *
     * @return void
     */
    /** @test */    
    public function a_user_can_update_a_company()
    {
        Storage::fake('public');

        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);
        $this->actingAs($user)
            ->get('/home')
            ->assertStatus(200);
        
        $company = Company::factory()->create(['logo'=>'null']);
        $data = [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
        ];
        $response = $this->put(route('companies.update', $company), $data);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $company->refresh();
        $this->assertEquals($data['name'], $company->name);
        $this->assertEquals($data['email'], $company->email);
        $this->assertEquals($data['website'], $company->website);
        $this->assertNotNull($company->logo);

    }

    /**
     * Test if user can delete company
     *
     * @return void
     */
    /** @test */    
    public function a_user_can_delete_a_company()
    {
        Storage::fake('logos');

        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password')
        ]);
        $this->actingAs($user)
            ->get('/home')
            ->assertStatus(200);
        
        $company = Company::factory()->create();
        $response = $this->delete(route('companies.destroy', $company));
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('companies', ['id' => $company->id]); 
        Storage::disk('logos')->assertMissing('logos/avatar.jpg');


    }
}
