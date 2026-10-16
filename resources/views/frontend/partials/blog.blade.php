 <!-- ================= NEWS & ARTICLES SLIDER ================= -->
 <section class="section-pad news-slider" id="news">
     <div class="container container-narrow">
         <div class="section-head">
             <hr class="rule">
             <h2>Blog &amp; articles</h2>
             <p>Updates from the centers, the field, and the wider programms.</p>
         </div>

         <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
             <div class="carousel-inner">

                 @forelse ($blogs as $blog)
                     <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                         <div class="news-slide">
                             <div class="news-slide-img"
                                 style="background-image:url('{{ asset('storage/' . $blog->image_url) }}');"></div>
                             <div class="news-slide-body">
                                 <span class="news-tag">News · {{ $blog->created_at->format('j M Y') }}</span>
                                 <h3>{{ $blog->title }}</h3>
                                 <p>{!! Str::limit($blog->content, 200) !!}</p>
                                 <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="news-link">Read article</a>
                             </div>
                         </div>
                     </div>
                 @empty
                     <span>No blog posts available.</span>
                 @endforelse




             </div>

             <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Previous</span>
             </button>
             <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Next</span>
             </button>

             <div class="carousel-indicators news-indicators">
                 <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"
                     aria-label="Article 1"></button>
                 <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1"
                     aria-label="Article 2"></button>
                 <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="2"
                     aria-label="Article 3"></button>
             </div>
         </div>
     </div>
 </section>
