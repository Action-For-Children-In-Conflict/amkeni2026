<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTitleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_home_page_uses_its_full_title_without_repeating_the_brand(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('<title>Action for Children in Conflict (AfCiC) — Thika, Kenya</title>', false);
    }

    public function test_static_pages_use_their_page_title_and_description(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSee('<title>About Us | Action for Children in Conflict (AfCiC)</title>', false)
            ->assertSee('<meta name="description" content="Learn about Action for Children in Conflict (AfCiC), our history, mission, vision and core values as we protect and empower children and families in Thika, Kenya.">', false);
    }

    public function test_blog_detail_uses_the_blog_title(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['title' => 'News', 'slug' => 'news']);

        $blog = Blog::create([
            'title' => 'A story from the field',
            'slug' => 'a-story-from-the-field',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'image_url' => 'blogs/story.jpg',
            'content' => '<p>Body copy.</p>',
        ]);

        $this->get(route('frontend.blogs.show', $blog->slug))
            ->assertOk()
            ->assertSee('<title>A story from the field | Action for Children in Conflict (AfCiC)</title>', false);
    }

    public function test_job_detail_uses_the_job_title(): void
    {
        $job = Job::factory()->create([
            'title' => 'Community Officer',
            'slug' => 'community-officer',
        ]);

        $this->get(route('careers.show', $job->slug))
            ->assertOk()
            ->assertSee('<title>Community Officer | Action for Children in Conflict (AfCiC)</title>', false);
    }

    public function test_layout_falls_back_to_the_site_title_when_a_page_provides_none(): void
    {
        $html = view('frontend.layouts.base')->render();

        $this->assertStringContainsString('<title>Action for Children in Conflict (AfCiC) | Empowering Children and Communities in Kenya</title>', $html);
    }
}
