<?php

namespace Tests\Feature;

use App\Enums\ContactType;
use App\Livewire\Contacts\Index;
use App\Mail\ContactSubmission;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_contact_volunteer_and_partner_pages_are_available(): void
    {
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Send us a message')
            ->assertSee('value="contact"', false);

        $this->get(route('volunteer'))
            ->assertOk()
            ->assertSee('Join our volunteer team')
            ->assertSee('value="volunteer"', false);

        $this->get(route('partner'))
            ->assertOk()
            ->assertSee('Start a partnership conversation')
            ->assertSee('value="partner"', false);
    }

    public function test_enquiries_from_each_form_are_stored_and_emailed_to_the_contact_address(): void
    {
        Mail::fake();

        foreach (ContactType::cases() as $type) {
            $response = $this->post(route('contact.submit'), [
                'type' => $type->value,
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'phone' => '+254 700 000000',
                'organization' => 'Example Org',
                'subject' => 'Hello there',
                'message' => 'I would like to learn more about your work.',
            ]);

            $response->assertRedirect();
            $response->assertSessionHas('success');

            $this->assertDatabaseHas('contacts', [
                'type' => $type->value,
                'email' => 'jane@example.com',
            ]);
        }

        $this->assertDatabaseCount('contacts', 3);

        Mail::assertSent(ContactSubmission::class, 3);
        Mail::assertSent(ContactSubmission::class, function (ContactSubmission $mail): bool {
            return $mail->hasTo(config('mail.contact_recipient'))
                && $mail->hasTo('info@actionchildren.or.ke')
                && $mail->contact->name === 'Jane Doe';
        });
    }

    public function test_enquiry_requires_valid_details(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.submit'), [
            'type' => 'not-a-real-type',
            'name' => '',
            'email' => 'not-an-email',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['type', 'name', 'email', 'message']);

        $this->assertDatabaseCount('contacts', 0);
        Mail::assertNothingSent();
    }

    public function test_admin_can_see_and_search_enquiries(): void
    {
        $user = User::factory()->create();

        Contact::factory()->create([
            'type' => ContactType::Partner,
            'name' => 'Acme Foundation',
            'email' => 'partners@acme.test',
        ]);

        $this->actingAs($user);

        $this->get(route('admin.contacts.index'))
            ->assertOk()
            ->assertSee('Enquiries');

        Livewire::test(Index::class)
            ->assertSee('Acme Foundation')
            ->set('search', 'partners@acme.test')
            ->assertSee('Acme Foundation')
            ->set('type', 'volunteer')
            ->assertDontSee('Acme Foundation');
    }
}
