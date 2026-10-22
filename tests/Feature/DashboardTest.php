<?php

namespace Tests\Feature;

use App\Livewire\Dashboard\Statistics;
use App\Models\Program;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $user = User::factory()->create();
        $team = $user->currentTeam;

        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_visit_the_dashboard(): void
    {
        $user = User::factory()->create();
        $team = $user->currentTeam;

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk();
    }

    public function test_dashboard_displays_statistics_for_every_model(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk();

        foreach ([
            'Programs',
            'Blog Posts',
            'Events',
            'Publications',
            'Success Stories',
            'Partners',
            'Staff',
            'Volunteers',
            'Categories',
            'Tags',
            'Users',
            'Teams',
            'Team Members',
            'Pending Invitations',
        ] as $label) {
            $response->assertSee($label);
        }
    }

    public function test_dashboard_statistics_count_records_created_this_month(): void
    {
        $user = User::factory()->create();

        $tag = Tag::create([
            'title' => 'Feeding',
            'slug' => 'feeding',
        ]);

        Program::create([
            'title' => 'Feeding Program',
            'slug' => 'feeding-program',
            'user_id' => $user->id,
            'tag_id' => $tag->id,
            'image_url' => 'programs/feeding-program.jpg',
            'content' => '<p>Meals for children.</p>',
        ]);

        Livewire::test(Statistics::class)
            ->assertViewHas('contentTotal', 2)
            ->assertViewHas('contentStats', function (array $stats): bool {
                $programs = collect($stats)->firstWhere('label', __('Programs'));

                return $programs['count'] === 1
                    && $programs['this_month'] === 1
                    && $programs['route'] === 'admin.programs.index';
            })
            ->assertViewHas('platformStats', function (array $stats): bool {
                $users = collect($stats)->firstWhere('label', __('Users'));

                return $users['count'] === 1;
            });
    }
}
