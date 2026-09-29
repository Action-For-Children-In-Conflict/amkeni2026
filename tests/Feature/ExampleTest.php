<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
    }

    public function test_home_page_sections_have_consistent_headings_and_subheadings(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();

        // Section Eyebrows
        $response->assertSee('Our Focus Areas');
        $response->assertSee('Rescue & Rehabilitation');
        $response->assertSee('Stories of Transformation');
        $response->assertSee('Make A Difference');
        $response->assertSee('Media Gallery');
        $response->assertSee('Our Partners & Allies');

        // Section Headings
        $response->assertSee('Four areas, one goal');
        $response->assertSee('Safe havens where hope and healing begin');
        $response->assertSee('Turning adversity into opportunity');
        $response->assertSee('Your contribution keeps our centres running');
        $response->assertSee('See the work in motion');
        $response->assertSee('Standing together for children and families');

        // Hierarchy classes
        $response->assertSee('section-head');
        $response->assertSee('section-eyebrow');
        $response->assertSee('rule');
    }
}
