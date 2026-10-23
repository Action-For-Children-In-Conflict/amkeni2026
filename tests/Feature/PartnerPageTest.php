<?php

namespace Tests\Feature;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartnerPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_partners_page_lists_each_partner_with_its_logo_and_website_link(): void
    {
        $user = User::factory()->create();

        Partner::create([
            'name' => 'Kindernothilfe',
            'slug' => 'kindernothilfe',
            'role' => 'Strategic Partner',
            'user_id' => $user->id,
            'website_url' => 'https://www.kindernothilfe.org',
            'image_url' => 'partners/kindernothilfe.png',
            'content' => 'A long-standing partner supporting child protection work.',
        ]);

        $response = $this->get(route('partners'));

        $response->assertOk();
        $response->assertSee('Our Partners');
        $response->assertSee('Kindernothilfe');
        $response->assertSee('Strategic Partner');
        $response->assertSee('https://www.kindernothilfe.org', false);
        $response->assertSee('storage/partners/kindernothilfe.png', false);
    }

    public function test_partners_page_is_linked_from_the_about_us_navigation(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee(route('partners'), false);
    }
}
