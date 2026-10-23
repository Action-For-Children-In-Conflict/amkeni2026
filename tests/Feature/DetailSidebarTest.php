<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Tag;
use App\Models\Testmonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DetailSidebarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_program_detail_sidebar_lists_other_programs(): void
    {
        $user = User::factory()->create();
        $tag = Tag::create(['title' => 'Programs', 'slug' => 'programs']);

        $current = Program::create([
            'title' => 'Current Program',
            'slug' => 'current-program',
            'user_id' => $user->id,
            'tag_id' => $tag->id,
            'image_url' => 'programs/current.jpg',
            'content' => 'Current program content.',
            'description' => 'Current program description.',
        ]);

        $other = Program::create([
            'title' => 'Feeding Program',
            'slug' => 'feeding-program',
            'user_id' => $user->id,
            'tag_id' => $tag->id,
            'image_url' => 'programs/feeding.jpg',
            'content' => 'Feeding program content.',
            'description' => 'Feeding program description.',
        ]);

        $this->get(route('programs.show', $current->slug))
            ->assertOk()
            ->assertSee('Recent Programs')
            ->assertSee($other->title)
            ->assertSee(route('programs.show', $other->slug), false);
    }

    public function test_story_detail_sidebar_lists_other_stories(): void
    {
        $user = User::factory()->create();

        $current = Testmonial::create([
            'name' => 'Current Storyteller',
            'slug' => 'current-story',
            'content' => 'Current story content.',
            'position' => 'Current Story Headline',
            'user_id' => $user->id,
        ]);

        $other = Testmonial::create([
            'name' => 'Nelly',
            'slug' => 'nellys-story',
            'content' => 'Nelly story content.',
            'position' => 'Nelly: A brighter future',
            'user_id' => $user->id,
        ]);

        $this->get(route('frontend.stories', $current->slug))
            ->assertOk()
            ->assertSee('Recent Stories')
            ->assertSee($other->position)
            ->assertSee(route('frontend.stories', $other->slug), false);
    }

    public function test_partner_sidebar_lists_partners_from_the_database(): void
    {
        $user = User::factory()->create();

        Partner::create([
            'name' => 'Database Partner',
            'slug' => 'database-partner',
            'role' => 'Funder',
            'user_id' => $user->id,
            'website_url' => 'https://example.com',
            'image_url' => 'partners/example.png',
            'content' => 'Partner details.',
        ]);

        $this->get(route('trc'))
            ->assertOk()
            ->assertSee('Database Partner')
            ->assertSee('https://example.com', false)
            ->assertDontSee('Capwell Industries Limited');
    }

    public function test_blog_detail_sidebar_lists_other_blog_posts(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['title' => 'Articles', 'slug' => 'articles']);

        $current = Blog::create([
            'title' => 'Current Blog Post',
            'slug' => 'current-blog-post',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'image_url' => 'blogs/current.jpg',
            'content' => 'Current blog content.',
        ]);

        $other = Blog::create([
            'title' => 'The Power of Play',
            'slug' => 'power-of-play',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'image_url' => 'blogs/play.jpg',
            'content' => 'Play blog content.',
        ]);

        $this->get(route('frontend.blogs.show', $current->slug))
            ->assertOk()
            ->assertSee('Recent Posts')
            ->assertSee($other->title)
            ->assertSee(route('frontend.blogs.show', $other->slug), false);
    }
}
