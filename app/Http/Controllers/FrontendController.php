<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Publication;
use App\Models\Testmonial;

class FrontendController extends Controller
{
    public function index()
    {
        $title = 'Action for Children in Conflict (AfCiC) — Thika, Kenya';
        $meta_description = "AfCiC protects and empowers children and vulnerable families in Thika, Kenya through child protection, education, women's empowerment and climate action.";
        $programs = Program::with('tag')->latest()->paginate(4);
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

        // dd($programdetail->slug);
        return view('frontend.dynamic.programDetails', compact('pageTitle', 'programdetail'));
    }

    /* stories Page */
    public function allstories(string $slug)
    {
        $pageTitle = 'Success Stories';
        // dd($slug);
        $storydetail = Testmonial::where('slug', $slug)->firstOrFail();

        // dd($programdetail->slug);
        return view('frontend.dynamic.storiesDetails', compact('pageTitle', 'storydetail'));
    }

    /* CENTERS
     */
    public function trc()
    {
        $pageTitle = 'Temporary Rescue Center (TRC)';
        $meta_description = 'Learn more about our Thika Resource Center and the services we provide to support children and families in need.';

        return view('frontend.static.trc', compact('pageTitle', 'meta_description'));
    }

    public function wcc()
    {
        $pageTitle = 'Working Children Center (WCC)';
        $meta_description = "Discover how our Women's Care Center empowers women and supports their families in Thika, Kenya.";

        return view('frontend.static.wcc', compact('pageTitle', 'meta_description'));
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

        return view('frontend.dynamic.blogDetails', compact('pageTitle', 'meta_description', 'blog'));
    }
}
