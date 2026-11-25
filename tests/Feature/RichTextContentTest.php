<?php

namespace Tests\Feature;

use App\Livewire\Testmonials\Create as CreateTestimonial;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Staff;
use App\Models\User;
use App\Support\RichContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RichTextContentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_every_admin_form_with_a_rich_text_field_uses_the_shared_editor(): void
    {
        $forms = [
            'blog/create.blade.php',
            'blog/edit.blade.php',
            'events/create.blade.php',
            'events/edit.blade.php',
            'jobs/create.blade.php',
            'jobs/edit.blade.php',
            'partners/create.blade.php',
            'partners/edit.blade.php',
            'programs/create.blade.php',
            'programs/edit.blade.php',
            'publications/create.blade.php',
            'publications/edit.blade.php',
            'staff/create.blade.php',
            'staff/edit.blade.php',
            'testmonials/create.blade.php',
            'testmonials/edit.blade.php',
        ];

        foreach ($forms as $form) {
            $contents = file_get_contents(resource_path('views/livewire/'.$form));

            $this->assertStringContainsString('<x-quill-editor', $contents, $form.' should use the shared editor component.');
            $this->assertStringNotContainsString('new Quill', $contents, $form.' should not define its own editor instance.');
            $this->assertStringNotContainsString('quill.snow.css', $contents, $form.' should not load the editor styles twice.');
        }
    }

    public function test_the_shared_editor_renders_the_full_toolbar_on_every_form(): void
    {
        $user = User::factory()->create();

        $html = Livewire::actingAs($user)->test(CreateTestimonial::class)->html();

        $this->assertStringContainsString(".entangle('content')", $html);
        $this->assertStringContainsString("['link', 'image', 'video']", $html);
        $this->assertStringContainsString("'align'", $html);
        $this->assertStringContainsString("'size'", $html);
        $this->assertStringContainsString("'direction'", $html);
        $this->assertStringContainsString("'font'", $html);
        $this->assertStringContainsString("'blockquote', 'code-block'", $html);
    }

    public function test_frontend_detail_views_render_editor_output_as_rich_content(): void
    {
        $views = [
            'blogDetails',
            'eventDetails',
            'jobDetails',
            'programDetails',
            'storiesDetails',
        ];

        foreach ($views as $view) {
            $contents = file_get_contents(resource_path('views/frontend/dynamic/'.$view.'.blade.php'));

            $this->assertStringContainsString('class="rich-content"', $contents, $view.' should wrap editor output in the rich-content styles.');
        }
    }

    public function test_blog_detail_page_renders_stored_content(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['title' => 'News', 'slug' => 'news']);

        $blog = Blog::create([
            'title' => 'A story from the field',
            'slug' => 'a-story-from-the-field',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'image_url' => 'blogs/story.jpg',
            'content' => '<h2>Heading</h2><p>Body copy.</p>',
        ]);

        $this->get(route('frontend.blogs.show', $blog->slug))
            ->assertOk()
            ->assertSee('<div class="rich-content">', false)
            ->assertSee('<h2>Heading</h2>', false);
    }

    public function test_team_cards_render_editor_output(): void
    {
        $user = User::factory()->create();

        Staff::create([
            'name' => 'Jane Doe',
            'slug' => 'jane-doe',
            'role' => 'Programme Officer',
            'user_id' => $user->id,
            'image_url' => 'staff/jane.jpg',
            'content' => '<p>Jane supports children in Thika.</p>',
        ]);

        $this->get(route('team'))
            ->assertOk()
            ->assertSee('team-card-bio', false)
            ->assertSee('Jane supports children in Thika.');
    }

    public function test_bare_urls_in_editor_content_become_clickable_links(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['title' => 'News', 'slug' => 'news']);

        $blog = Blog::create([
            'title' => 'A story from the field',
            'slug' => 'a-story-from-the-field',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'image_url' => 'blogs/story.jpg',
            'content' => '<p>Visit https://example.org/programs?a=1&amp;b=2, or www.example.org.</p>',
        ]);

        $this->get(route('frontend.blogs.show', $blog->slug))
            ->assertOk()
            ->assertSee('<a href="https://example.org/programs?a=1&amp;b=2" target="_blank" rel="noopener noreferrer">https://example.org/programs?a=1&amp;b=2</a>,', false)
            ->assertSee('<a href="https://www.example.org" target="_blank" rel="noopener noreferrer">www.example.org</a>.', false);
    }

    public function test_rich_content_linkifies_text_without_touching_markup_or_existing_links(): void
    {
        $html = '<p>Read <a href="https://already.example">this guide</a> or paste https://new.example/path.</p>'
            .'<p><img src="https://cdn.example/image.jpg" alt="Example"></p>';

        $rendered = RichContent::render($html);

        $this->assertSame(1, substr_count($rendered, 'href="https://already.example"'));
        $this->assertSame(1, substr_count($rendered, 'href="https://new.example/path"'));
        $this->assertStringContainsString('<img src="https://cdn.example/image.jpg"', $rendered);
        $this->assertStringContainsString('>this guide</a>', $rendered);
    }

    public function test_the_stylesheet_styles_rich_content_and_team_bios(): void
    {
        $css = file_get_contents(public_path('frontend/css/styles.css'));

        foreach (['.rich-content p', '.rich-content a', '.rich-content blockquote', '.rich-content .ql-align-center', '.rich-content .ql-font-serif', '.team-card-bio p', '.team-card-bio a'] as $selector) {
            $this->assertStringContainsString($selector, $css, $selector.' should be styled on the front end.');
        }

        // Links must look clickable and long URLs must not overflow the column.
        $this->assertMatchesRegularExpression('/\.rich-content a \{[^}]*overflow-wrap/s', $css);

        // Large or portrait images must not dominate the article column.
        $this->assertMatchesRegularExpression('/\.rich-content img \{[^}]*max-height/s', $css);
        $this->assertMatchesRegularExpression('/\.team-card-bio img \{[^}]*max-height/s', $css);
        $this->assertStringContainsString('.rich-content img[width]', $css);

        $adminCss = file_get_contents(resource_path('css/app.css'));

        // Inserted media must stay inside the editor instead of stretching the form.
        $this->assertMatchesRegularExpression('/\.quill-editor \.ql-editor img \{[^}]*max-height/s', $adminCss);
        $this->assertMatchesRegularExpression('/\.quill-editor \.ql-editor iframe,[^{]*\{[^}]*max-height/s', $adminCss);
    }
}
