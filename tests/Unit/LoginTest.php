<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_redirected_to_admin_dashboard()
    {
        $this->actingAsAdmin();

        $response = $this->get('/dashboard');

        $response->assertRedirect('/admin/dashboard');
    }
    public function test_expert_redirected_to_expert_dashboard()
    {
        $this->actingAsExpert();
        $response = $this->get('/dashboard');

        $response->assertRedirect('/expert/dashboard');
    }

    private function actingAsAdmin()
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);
    }

    private function actingAsExpert()
    {
        $user = User::factory()->create([
            'role' => 'expert',
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);
    }
}
