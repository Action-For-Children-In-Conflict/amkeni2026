<?php

namespace Tests\Feature;

use App\Livewire\Jobs\Create;
use App\Livewire\Jobs\Edit;
use App\Livewire\Jobs\Index;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Storage::fake('public');
    }

    public function test_careers_page_lists_job_openings(): void
    {
        Job::factory()->create(['title' => 'Programme Officer']);

        $this->get(route('careers'))
            ->assertOk()
            ->assertSee('Programme Officer');
    }

    public function test_careers_page_shows_a_message_when_there_are_no_openings(): void
    {
        $this->get(route('careers'))
            ->assertOk()
            ->assertSee('There are no open positions at the moment.');
    }

    public function test_job_detail_page_shows_the_job_and_its_document(): void
    {
        $job = Job::factory()->create([
            'title' => 'Social Worker',
            'slug' => 'social-worker',
            'document_path' => 'jobs/documents/social-worker.pdf',
        ]);

        $this->get(route('careers.show', $job->slug))
            ->assertOk()
            ->assertSee('Social Worker')
            ->assertSee(asset('storage/jobs/documents/social-worker.pdf'));
    }

    public function test_guests_cannot_access_job_management(): void
    {
        $this->get(route('admin.jobs.index'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_can_create_a_job(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(Create::class)
            ->set('title', 'Programme Officer')
            ->set('description', 'Lead our education programme in Thika.')
            ->set('content', '<p>Full role details.</p>')
            ->set('image', UploadedFile::fake()->image('role.jpg'))
            ->set('document', UploadedFile::fake()->create('role.pdf', 100, 'application/pdf'))
            ->call('saveJob')
            ->assertHasNoErrors()
            ->assertRedirect(route('admin.jobs.index'));

        $job = Job::firstWhere('title', 'Programme Officer');

        $this->assertNotNull($job);
        $this->assertSame('programme-officer', $job->slug);
        $this->assertSame($user->id, $job->user_id);
        Storage::disk('public')->assertExists($job->image_url);
        Storage::disk('public')->assertExists($job->document_path);
    }

    public function test_job_creation_validates_required_fields(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)
            ->call('saveJob')
            ->assertHasErrors(['title', 'description', 'content', 'image']);

        $this->assertDatabaseCount('job_listings', 0);
    }

    public function test_admin_can_update_a_job_and_remove_its_document(): void
    {
        $user = User::factory()->create();
        $job = Job::factory()->create([
            'user_id' => $user->id,
            'title' => 'Old title',
            'slug' => 'old-title',
            'description' => 'Old description here.',
            'document_path' => 'jobs/documents/old.pdf',
        ]);

        Storage::disk('public')->put('jobs/documents/old.pdf', 'document');

        $this->actingAs($user);

        Livewire::test(Edit::class, ['job' => $job])
            ->assertSet('title', 'Old title')
            ->set('title', 'New title')
            ->set('description', 'Updated description for the role.')
            ->set('content', '<p>Updated content.</p>')
            ->set('removeDocument', true)
            ->call('updateJob')
            ->assertHasNoErrors()
            ->assertRedirect(route('admin.jobs.index'));

        $job->refresh();

        $this->assertSame('New title', $job->title);
        $this->assertSame('new-title', $job->slug);
        $this->assertNull($job->document_path);
        Storage::disk('public')->assertMissing('jobs/documents/old.pdf');
    }

    public function test_admin_can_delete_a_job(): void
    {
        $user = User::factory()->create();
        $job = Job::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test(Index::class)
            ->call('openDeleteModal', $job->id)
            ->call('confirmDelete')
            ->assertHasNoErrors();

        $this->assertModelMissing($job);
    }
}
