<!-- ================= VIDEO SLIDER ================= -->
<section class="section-pad video-slider" id="videos">
    <div class="container container-narrow">
        <div class="section-head text-center mx-auto">
            <span class="section-eyebrow">Media Gallery</span>
            <h2>See the work in motion</h2>
            <hr class="rule mx-auto">
            <p class="mx-auto">Short films from our rescue centres, classrooms, and community outreach in Thika.</p>
        </div>

        <div id="videoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="video-slide">
                        <div class="ratio ratio-16x9 video-frame video-thumb"
                            data-video-id="DzUNvcJrn4E" role="button" tabindex="0"
                            aria-label="Play video: Dialogue Works project">
                            <img src="https://i.ytimg.com/vi/DzUNvcJrn4E/maxresdefault.jpg"
                                onerror="this.src='https://i.ytimg.com/vi/DzUNvcJrn4E/hqdefault.jpg'"
                                alt="Dialogue Works project creates a platform where children can express themselves!"
                                loading="lazy">
                            <span class="play-btn" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
                        </div>
                        <h3 class="video-caption">Dialogue Works project creates a platform where children can express
                            themselves!</h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="video-slide">
                        <div class="ratio ratio-16x9 video-frame video-thumb"
                            data-video-id="ZpmTqfkwuQs" data-start="16" role="button" tabindex="0"
                            aria-label="Play video: From the Streets to Soaring high in Education">
                            <img src="https://i.ytimg.com/vi/ZpmTqfkwuQs/maxresdefault.jpg"
                                onerror="this.src='https://i.ytimg.com/vi/ZpmTqfkwuQs/hqdefault.jpg'"
                                alt="AfCiC Education Empowerment Project Restores Dreams"
                                loading="lazy">
                            <span class="play-btn" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
                        </div>
                        <h3 class="video-caption">
                            🎉 From the Streets to Soaring high in Education! AfCiC Education Empowerment Project
                            Restores Dreams.</h3>
                    </div>
                </div>

               

                <div class="carousel-item">
                    <div class="video-slide">
                        <div class="ratio ratio-16x9 video-frame video-thumb"
                            data-video-id="tIQ9G2TIyrc" data-start="16" role="button" tabindex="0"
                            aria-label="Play video: AfCiC Medical camp in Laikipia, Kenya">
                            <img src="https://i.ytimg.com/vi/tIQ9G2TIyrc/maxresdefault.jpg"
                                onerror="this.src='https://i.ytimg.com/vi/tIQ9G2TIyrc/hqdefault.jpg'"
                                alt="AfCiC Medical camp in Laikipia, Kenya"
                                loading="lazy">
                            <span class="play-btn" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
                        </div>
                        <h3 class="video-caption">🎉 AfCiC Medical camp in Laikipia, Kenya!</h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="video-slide">
                        <div class="ratio ratio-16x9 video-frame video-thumb"
                            data-video-id="7ex86_0HXl8" role="button" tabindex="0"
                            aria-label="Play video: Empowering Youth and Ending FGM/C - Voices from the Wezesha Wasichana Project">
                            <img src="https://i.ytimg.com/vi/7ex86_0HXl8/maxresdefault.jpg"
                                onerror="this.src='https://i.ytimg.com/vi/7ex86_0HXl8/hqdefault.jpg'"
                                alt="Empowering Youth & Ending FGM/C: Voices from the Wezesha Wasichana Project"
                                loading="lazy">
                            <span class="play-btn" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
                        </div>
                        <h3 class="video-caption">🎉 Empowering Youth & Ending FGM/C: Voices from the Wezesha Wasichana
                            Project</h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="video-slide">
                        <div class="ratio ratio-16x9 video-frame video-thumb"
                            data-video-id="78vawqo4NBk" role="button" tabindex="0"
                            aria-label="Play video: International Volunteer shares experience at AfCiC in Kenya">
                            <img src="https://i.ytimg.com/vi/78vawqo4NBk/maxresdefault.jpg"
                                onerror="this.src='https://i.ytimg.com/vi/78vawqo4NBk/hqdefault.jpg'"
                                alt="International Volunteer shares experience at AfCiC in Kenya"
                                loading="lazy">
                            <span class="play-btn" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
                        </div>
                        <h3 class="video-caption">International Volunteer shares experience at AfCiC in Kenya</h3>
                    </div>
                </div>

            </div>

            <script>
                document.querySelectorAll('.video-thumb').forEach(function (thumb) {
                    function play() {
                        var id = thumb.dataset.videoId;
                        var start = thumb.dataset.start ? '&start=' + thumb.dataset.start : '';
                        thumb.innerHTML = '<iframe width="560" height="315" ' +
                            'src="https://www.youtube-nocookie.com/embed/' + id + '?autoplay=1&rel=0' + start + '" ' +
                            'title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; ' +
                            'clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" ' +
                            'referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                    }
                    thumb.addEventListener('click', play);
                    thumb.addEventListener('keydown', function (e) {
                        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); play(); }
                    });
                });
            </script>

            <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <div class="carousel-indicators video-indicators">
                <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="0" class="active"
                    aria-label="Video 1"></button>
                <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="1"
                    aria-label="Video 2"></button>
                <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="2"
                    aria-label="Video 3"></button>
                <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="3"
                    aria-label="Video 4"></button>
                <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="4"
                    aria-label="Video 5"></button>
                <button type="button" data-bs-target="#videoCarousel" data-bs-slide-to="5"
                    aria-label="Video 6"></button>
            </div>
        </div>
    </div>
</section>
