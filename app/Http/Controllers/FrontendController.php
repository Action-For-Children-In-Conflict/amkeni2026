<?php

namespace App\Http\Controllers;

use App\Enums\ContactType;
use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactSubmission;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Publication;
use App\Models\Staff;
use App\Models\Testmonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class FrontendController extends Controller
{
    public function index()
    {
        $title = 'Action for Children in Conflict (AfCiC) — Thika, Kenya';
        $meta_description = "AfCiC protects and empowers children and vulnerable families in Thika, Kenya through child protection, education, women's empowerment and climate action.";
        $programs = Program::with('tag')->oldest()->paginate(12);
        $testmonialstories = Testmonial::latest()->paginate(3);
        $partners = Partner::latest()->get();
        $blogs = Blog::latest()->paginate(6);

        // dd($programs);
        return view('frontend.index', compact('title', 'meta_description', 'programs', 'testmonialstories', 'partners', 'blogs'));
    }

    /* All Programs Page */
    public function programs()
    {
        $pageTitle = 'Afcic Programs';
        $meta_description = 'Explore all AfCiC programs on child protection, education, women\'s empowerment and climate action in Thika, Kenya.';
        $programs = Program::with('tag')->latest()->paginate(8);

        return view('frontend.indexes.programIndex', compact('pageTitle', 'meta_description', 'programs'));
    }

    /* All Success Stories Page */
    public function stories()
    {
        $pageTitle = 'Success Stories';
        $meta_description = 'Read inspiring success stories from children and families whose lives have been transformed by AfCiC in Thika, Kenya.';
        $stories = Testmonial::latest()->paginate(9);

        return view('frontend.indexes.storiesIndex', compact('pageTitle', 'meta_description', 'stories'));
    }

    /* All Blogs Page (list) */
    public function blogsIndex()
    {
        $pageTitle = 'Blog & Articles';
        $meta_description = "Read our latest blog posts and articles on child protection, education, women's empowerment, and climate action in Thika, Kenya.";
        $blogs = Blog::with(['user', 'category'])->latest()->paginate(9);

        return view('frontend.indexes.blogIndex', compact('pageTitle', 'meta_description', 'blogs'));
    }

    /* All Publications Page */
    public function publications()
    {
        $pageTitle = 'Publications';
        $meta_description = 'Browse our publications, reports and resources on child protection, education, women\'s empowerment and climate action in Thika, Kenya.';
        $publications = Publication::with(['user', 'category'])
            ->where('is_published', true)
            ->latest()
            ->paginate(9);

        return view('frontend.indexes.publicationIndex', compact('pageTitle', 'meta_description', 'publications'));
    }

    /* program detail Page */
    public function allprograms(string $slug)
    {
        $pageTitle = 'Afcic Progams';
        // dd($slug);
        $programdetail = Program::where('slug', $slug)->firstOrFail();

        $recentPosts = Program::where('id', '!=', $programdetail->id)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Program $program): array => [
                'title' => $program->title,
                'url' => route('programs.show', $program->slug),
                'image' => asset('storage/'.$program->image_url),
                'meta' => $program->created_at?->format('d M Y'),
            ]);

        $recentPostsTitle = 'Recent Programs';
        $galleryImages = $programdetail->galleryImages;

        return view('frontend.dynamic.programDetails', compact('pageTitle', 'programdetail', 'recentPosts', 'recentPostsTitle', 'galleryImages'));
    }

    /* stories Page */
    public function allstories(string $slug)
    {
        $pageTitle = 'Success Stories';
        // dd($slug);
        $storydetail = Testmonial::where('slug', $slug)->firstOrFail();

        $recentPosts = $this->recentStories($storydetail->id);
        $recentPostsTitle = 'Recent Stories';
        $galleryImages = $storydetail->galleryImages;

        return view('frontend.dynamic.storiesDetails', compact('pageTitle', 'storydetail', 'recentPosts', 'recentPostsTitle', 'galleryImages'));
    }

    /* CENTERS
     */
    public function trc()
    {
        $pageTitle = 'Temporary Rescue Center (TRC)';
        $meta_description = 'Learn more about our Thika Resource Center and the services we provide to support children and families in need.';
        $recentPosts = $this->recentStories();
        $recentPostsTitle = 'Recent Stories';

        return view('frontend.static.trc', compact('pageTitle', 'meta_description', 'recentPosts', 'recentPostsTitle'));
    }

    /* Donate Page */
    public function donate(): View
    {
        $pageTitle = 'Donate';
        $meta_description = 'Support AfCiC with a secure donation by PayPal, M-Pesa or bank transfer, and help protect and empower children in Thika, Kenya.';

        return view('frontend.static.donate', compact('pageTitle', 'meta_description'));
    }

    /* All Partners Page */
    public function partners(): View
    {
        $pageTitle = 'Our Partners';
        $meta_description = 'Meet the organizations, foundations and companies that partner with AfCiC to protect and empower children in Thika, Kenya.';
        $partners = Partner::latest()->get();

        return view('frontend.indexes.partnerIndex', compact('pageTitle', 'meta_description', 'partners'));
    }

    /* Our Team Page */
    public function team(): View
    {
        $pageTitle = 'Our Team';
        $meta_description = 'Meet the dedicated team at Action for Children in Conflict (AfCiC) working to protect and empower children and families in Thika, Kenya.';
        $teamMembers = Staff::query()
            ->with('user')
            ->orderBy('id')
            ->get();

        return view('frontend.indexes.teamIndex', compact('pageTitle', 'meta_description', 'teamMembers'));
    }

    /* Contact Us page */
    public function contact(): View
    {
        return view('frontend.static.enquiry', [
            'pageTitle' => 'Contact Us',
            'eyebrow' => 'Get in touch',
            'introTitle' => 'We would love to hear from you',
            'intro' => 'Whether you have a question about our work, want to support a child, or simply want to say hello, our team in Thika is always happy to hear from you.',
            'points' => [],
            'details' => [
                ['label' => 'Visit us', 'value' => 'Section 9, Thika, Kenya. P.O. Box 6439-01000.', 'icon' => 'pin'],
                ['label' => 'Call us', 'value' => '+254 714 038285', 'link' => 'tel:+254714038285', 'icon' => 'phone'],
                ['label' => 'Email us', 'value' => 'info@actionchildren.or.ke', 'link' => 'mailto:info@actionchildren.or.ke', 'icon' => 'mail'],
                ['label' => 'Office hours', 'value' => 'Monday to Friday, 8am - 5pm EAT', 'icon' => 'clock'],
            ],
            'type' => ContactType::Contact,
            'formTitle' => 'Send us a message',
            'organizationLabel' => 'Organization (optional)',
            'subjectPlaceholder' => 'How can we help?',
            'messagePlaceholder' => 'Tell us a little more about your enquiry...',
            'buttonLabel' => 'Send message',
        ]);
    }

    /* Volunteer page */
    public function volunteer(): View
    {
        return view('frontend.static.enquiry', [
            'pageTitle' => 'Volunteer',
            'eyebrow' => 'Give your time',
            'introTitle' => 'Volunteer with AfCiC',
            'intro' => 'Every hour you give helps a child in Thika feel safer, seen and supported. Whether you can teach, mentor, coach or lend a professional skill, there is a place for you here.',
            'points' => [
                'Mentor and tutor children at our Temporary Rescue Center.',
                'Share a skill such as art, music, sports or photography.',
                'Support women\'s empowerment and climate action programmes.',
                'Help with events, fundraising and communications.',
            ],
            'details' => [],
            'type' => ContactType::Volunteer,
            'formTitle' => 'Join our volunteer team',
            'organizationLabel' => 'Organization or school (optional)',
            'subjectPlaceholder' => 'What would you like to help with?',
            'messagePlaceholder' => 'Tell us about your skills, availability and why you want to volunteer...',
            'buttonLabel' => 'Send volunteer enquiry',
        ]);
    }

    /* Partner with us page */
    public function partner(): View
    {
        return view('frontend.static.enquiry', [
            'pageTitle' => 'Partner With Us',
            'eyebrow' => 'Work together',
            'introTitle' => 'Partner with AfCiC',
            'intro' => 'Lasting change takes all of us. We work with companies, foundations, schools and community groups who want to invest in children and families in Thika.',
            'points' => [
                'Fund a programme, a centre or a specific project.',
                'Provide in-kind support, equipment or professional expertise.',
                'Engage your staff through team volunteering days.',
                'Build a long-term strategic partnership with measurable impact.',
            ],
            'details' => [],
            'type' => ContactType::Partner,
            'formTitle' => 'Start a partnership conversation',
            'organizationLabel' => 'Organization',
            'subjectPlaceholder' => 'What kind of partnership do you have in mind?',
            'messagePlaceholder' => 'Tell us about your organization and how you would like to partner with us...',
            'buttonLabel' => 'Send partnership enquiry',
        ]);
    }

    /* Store an enquiry from any of the shared contact forms */
    public function submitContact(StoreContactRequest $request): RedirectResponse
    {
        $contact = Contact::create($request->validated());

        try {
            Mail::to(config('mail.contact_recipient'))->send(new ContactSubmission($contact));
        } catch (Throwable $exception) {
            Log::error('Contact enquiry email could not be sent.', [
                'contact_id' => $contact->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return back()->with('success', 'Thank you for getting in touch. Our team will reply as soon as possible.');
    }

    public function wcc()
    {
        $pageTitle = 'Working Children Center (WCC)';
        $meta_description = "Discover how our Women's Care Center empowers women and supports their families in Thika, Kenya.";
        $recentPosts = $this->recentStories();
        $recentPostsTitle = 'Recent Stories';

        return view('frontend.static.wcc', compact('pageTitle', 'meta_description', 'recentPosts', 'recentPostsTitle'));
    }

    public function blogs()
    {
        $pageTitle = 'Blog & Articles';
        $meta_description = "Read our latest blog posts and articles on child protection, education, women's empowerment, and climate action in Thika, Kenya.";

        return view('frontend.blogs.index', compact('pageTitle', 'meta_description'));
    }

    public function blog(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $pageTitle = 'Afcic articles & Blogs';
        $meta_description = $blog->title;

        $recentPosts = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Blog $post): array => [
                'title' => $post->title,
                'url' => route('frontend.blogs.show', $post->slug),
                'image' => asset('storage/'.$post->image_url),
                'meta' => $post->created_at?->format('d M Y'),
            ]);

        $recentPostsTitle = 'Recent Posts';
        $galleryImages = $blog->galleryImages;

        return view('frontend.dynamic.blogDetails', compact('pageTitle', 'meta_description', 'blog', 'recentPosts', 'recentPostsTitle', 'galleryImages'));
    }

    /* About Us Page */
    public function about(): View
    {
        $pageTitle = 'About Us';
        $meta_description = 'Learn about Action for Children in Conflict (AfCiC), our history, mission, vision and core values as we protect and empower children and families in Thika, Kenya.';

        return view('frontend.static.about', compact('pageTitle', 'meta_description'));
    }

    /* Mission Page */
    public function mission(): View
    {
        $pageTitle = 'Our Mission';
        $meta_description = 'Read our mission statement: enhancing the growth of children, young people and their families through access to justice, education, health, psychosocial and economic support.';

        return view('frontend.static.mission', compact('pageTitle', 'meta_description'));
    }

    /* Vision Page */
    public function vision(): View
    {
        $pageTitle = 'Our Vision';
        $meta_description = 'Our vision is a world of equal and sustainable opportunities for every child, regardless of where they were born or what they have been through.';

        return view('frontend.static.vision', compact('pageTitle', 'meta_description'));
    }

    /* All Events Page */
    public function events(): View
    {
        $pageTitle = 'Events';
        $meta_description = 'Upcoming and past events from Action for Children in Conflict (AfCiC) in Thika, Kenya.';

        $events = Event::with(['tag'])
            ->latest()
            ->paginate(9);

        return view('frontend.indexes.eventsIndex', compact('pageTitle', 'meta_description', 'events'));
    }

    /* Event Detail Page */
    public function event(string $slug): View
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $pageTitle = $event->title;
        $meta_description = Str::limit(strip_tags($event->content), 160);
        $galleryImages = $event->galleryImages;

        $recentEvents = Event::where('id', '!=', $event->id)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Event $recentEvent): array => [
                'title' => $recentEvent->title,
                'url' => route('frontend.events.show', $recentEvent->slug),
                'image' => $recentEvent->image_url ? asset('storage/'.$recentEvent->image_url) : null,
                'meta' => trim(collect([$recentEvent->date, $recentEvent->location])->filter()->implode(' · ')),
            ]);

        $recentPostsTitle = 'Recent Events';

        return view('frontend.dynamic.eventDetails', compact('pageTitle', 'meta_description', 'event', 'galleryImages', 'recentEvents', 'recentPostsTitle'));
    }

    /**
     * Get the latest success stories for the detail-page sidebar.
     *
     * @return Collection<int, array{title: string, url: string, image: ?string, meta: string}>
     */
    private function recentStories(?int $excludeId = null): Collection
    {
        return Testmonial::query()
            ->when($excludeId, fn ($query) => $query->where('id', '!=', $excludeId))
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Testmonial $story): array => [
                'title' => $story->position ?: $story->name,
                'url' => route('frontend.stories', $story->slug),
                'image' => $story->image ? asset('storage/'.$story->image) : null,
                'meta' => $story->position ? $story->name : $story->created_at?->format('d M Y'),
            ]);
    }
}
