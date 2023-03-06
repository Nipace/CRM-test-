<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class CompanyTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_create_a_company()
    {
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

    /** @test */
    public function a_user_can_update_a_company()
    {
        $company = Company::factory()->create();
        $data = [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
            'logo' => UploadedFile::fake()->image('default-logo.jpg'),
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

    /** @test */
    public function a_user_can_delete_a_company()
    {
        $company = Company::factory()->create();
        $response = $this->delete(route('companies.destroy', $company));
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('companies', ['id' => $company->id]); 

    }
}
