<?php

namespace Tests\Feature;

use App\Livewire\Programs\Create;
use App\Livewire\Programs\Edit;
use App\Models\Program;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ProgramDescriptionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Storage::fake('public');
    }

    public function test_description_is_required_when_creating_a_program(): void
    {
        $user = User::factory()->create();
        $tag = Tag::create(['title' => 'Education', 'slug' => 'education']);

        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('title', 'Education Support')
            ->set('tag_id', $tag->id)
            ->set('image', UploadedFile::fake()->image('program.jpg'))
            ->set('content', '<p>Program content.</p>')
            ->set('description', '')
            ->call('save')
            ->assertHasErrors(['description' => 'required']);

        $this->assertDatabaseCount('programs', 0);
    }

    public function test_description_is_saved_when_creating_a_program(): void
    {
        $user = User::factory()->create();
        $tag = Tag::create(['title' => 'Education', 'slug' => 'education']);

        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('title', 'Education Support')
            ->set('tag_id', $tag->id)
            ->set('image', UploadedFile::fake()->image('program.jpg'))
            ->set('content', '<p>Program content.</p>')
            ->set('description', 'A short summary for the program listing.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('programs', [
            'title' => 'Education Support',
            'description' => 'A short summary for the program listing.',
        ]);
    }

    public function test_description_can_be_viewed_and_updated_when_editing_a_program(): void
    {
        $user = User::factory()->create();
        $tag = Tag::create(['title' => 'Education', 'slug' => 'education']);
        $program = Program::create([
            'title' => 'Education Support',
            'description' => 'Original description.',
            'slug' => 'education-support',
            'tag_id' => $tag->id,
            'user_id' => $user->id,
            'image_url' => 'programs/program.jpg',
            'content' => '<p>Program content.</p>',
        ]);

        Livewire::actingAs($user)
            ->test(Edit::class, ['program' => $program])
            ->assertSet('description', 'Original description.')
            ->set('description', 'Updated description.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('programs', [
            'id' => $program->id,
            'description' => 'Updated description.',
        ]);
    }
}
