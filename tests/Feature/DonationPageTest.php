<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_donation_page_shows_paypal_mpesa_and_bank_options(): void
    {
        $response = $this->get(route('donate'));

        $response->assertOk();
        $response->assertSee('PayPal');
        $response->assertSee('https://www.paypal.com/donate/?hosted_button_id=LU7GDTJZH7NLG', false);
        $response->assertSee('M-Pesa');
        $response->assertSee('56476');
        $response->assertSee('Bank / Card');
        $response->assertSee('info@actionchildren.or.ke');
        $response->assertSee('+254 714 038285');
    }

    public function test_donate_links_point_to_the_donation_page(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee(route('donate'), false);
    }
}
