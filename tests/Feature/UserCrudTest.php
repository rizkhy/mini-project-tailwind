<?php

namespace Tests\Feature;

use App\Livewire\User\UserPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        Livewire::test(UserPage::class)
            ->set('name', 'Jeki')
            ->set('position', 'staff')
            ->set('nip', 4321)
            ->set('password', bcrypt('123456'))
            ->call('saved');

        $this->assertCount(1, User::all());
    }
}
