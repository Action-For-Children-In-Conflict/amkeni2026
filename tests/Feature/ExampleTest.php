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

        // Section Headings
        $response->assertSee('Four areas, one goal');
        $response->assertSee('Safe havens where hope and healing begin');
        $response->assertSee('Turning adversity into opportunity');
        $response->assertSee('Your contribution keeps our centres running');
        $response->assertSee('See the work in motion');

        // Hierarchy classes
        $response->assertSee('section-head');
        $response->assertSee('section-eyebrow');
        $response->assertSee('rule');
    }

    public function test_home_page_exposes_the_floating_translator_widget(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();

        $response->assertSee('class="translate-widget"', false);
        $response->assertSee('id="translateToggle"', false);
        $response->assertSee('id="translatePanel" hidden', false);
        $response->assertSee('id="google_translate_element"', false);

        // Google's script must stay wired to the init callback.
        $response->assertSee('function googleTranslateElementInit', false);
        $response->assertSee('translate.google.com/translate_a/element.js', false);
    }
}
