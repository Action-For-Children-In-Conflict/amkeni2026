<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PwaTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_exposes_the_pwa_metadata(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('rel="manifest"', false)
            ->assertSee('/site.webmanifest', false)
            ->assertSee('name="theme-color"', false)
            ->assertSee('navigator.serviceWorker.register', false)
            ->assertSee('/sw.js', false);
    }

    public function test_web_manifest_is_valid_and_installable(): void
    {
        $path = public_path('site.webmanifest');

        $this->assertFileExists($path);

        $manifest = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame('/', $manifest['start_url']);
        $this->assertSame('/', $manifest['scope']);
        $this->assertSame('standalone', $manifest['display']);
        $this->assertNotEmpty($manifest['name']);
        $this->assertNotEmpty($manifest['short_name']);
        $this->assertNotEmpty($manifest['theme_color']);

        $sizes = collect($manifest['icons'])
            ->map(fn (array $icon): string => $icon['sizes'])
            ->all();

        $this->assertContains('192x192', $sizes);
        $this->assertContains('512x512', $sizes);

        collect($manifest['icons'])->each(function (array $icon): void {
            $this->assertFileExists(public_path(ltrim($icon['src'], '/')));
        });
    }

    public function test_web_manifest_ships_wide_and_narrow_screenshots(): void
    {
        $manifest = json_decode(
            (string) file_get_contents(public_path('site.webmanifest')),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        $this->assertNotEmpty($manifest['screenshots']);

        $screenshots = collect($manifest['screenshots']);

        // Chrome only shows the richer install UI when both a wide (desktop)
        // and a narrow (mobile) screenshot are provided.
        $this->assertTrue($screenshots->contains('form_factor', 'wide'));
        $this->assertTrue($screenshots->contains(
            fn (array $screenshot): bool => ! isset($screenshot['form_factor']) || $screenshot['form_factor'] !== 'wide',
        ));

        $screenshots->each(function (array $screenshot): void {
            $path = public_path(ltrim($screenshot['src'], '/'));

            $this->assertFileExists($path);
            $this->assertSame('image/png', $screenshot['type']);

            [$width, $height] = getimagesize($path);
            $this->assertSame($screenshot['sizes'], "{$width}x{$height}");
        });
    }

    public function test_offline_page_and_service_worker_are_published(): void
    {
        $this->assertFileExists(public_path('offline.html'));
        $this->assertFileExists(public_path('sw.js'));

        $worker = (string) file_get_contents(public_path('sw.js'));

        $this->assertStringContainsString('/offline.html', $worker);
        $this->assertStringContainsString("'/admin'", $worker);
    }
}
