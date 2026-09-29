<!-- ================= HERO CAROUSEL ================= -->
<header class="hero-carousel">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">

            <div class="carousel-item active"
                style="background-image:url('{{ asset('frontend/images/slider/up.jpg') }}');">
                <div class="slide-gradient"></div>
                <div class="container container-narrow hero-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <p class="hero-eyebrow">Who we are</p>
                            <h1>A leading child protection organisation, rooted in Thika since 2004.</h1>
                            <p class="lead mt-3">We promote access to equal and sustainable opportunities for children
                                and vulnerable families across Kiambu, Murang'a and Nairobi counties.</p>
                            <div class="d-flex gap-3 mt-4 flex-wrap">
                                <a href="#focus" class="btn-primary-afcic">Our focus areas</a>
                                <a href="#about" class="btn-outline-afcic">Learn more →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="background-image:url('{{ asset('frontend/images/trc/trc3.jpeg') }} ');">
                <div class="slide-gradient"></div>
                <div class="container container-narrow hero-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <p class="hero-eyebrow">What we do</p>
                            <h1>Projects at the heart of the community.</h1>
                            <p class="lead mt-3">Child protection, education empowerment, health and community
                                empowerment — delivered through two rescue centres and daily outreach.</p>
                            <div class="d-flex gap-3 mt-4 flex-wrap">
                                <a href="#centers" class="btn-primary-afcic">Our centres</a>
                                <a href="#stories" class="btn-outline-afcic">Watch stories</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item"
                style="background-image:url('{{ asset('frontend/images/slider/slider2.jpg') }}');">
                <div class="slide-gradient"></div>
                <div class="container container-narrow hero-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <p class="hero-eyebrow">Why we do it</p>
                            <h1>Ending the cycle of poverty, one family at a time.</h1>
                            <p class="lead mt-3">Every programme is built to empower children today and impact the
                                community for generations to come.</p>
                            <div class="d-flex gap-3 mt-4 flex-wrap">
                                <a href="#donate" class="btn-primary-afcic">Donate now</a>
                                <a href="#donate" class="btn-outline-afcic">Donation causes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>

<!-- ================= STATS OVERLAP CARD ================= -->
<div class="container container-narrow stats-overlap">
    <div class="stats-card">
        <div class="stat">
            <div class="num" data-count-to="1500" data-suffix="+">0</div>
            <div class="label">Children supported</div>
        </div>
        <div class="stat">
            <div class="num" data-count-to="300" data-suffix="">0</div>
            <div class="label">Active volunteers</div>
        </div>
        <div class="stat">
            <div class="num" data-count-to="10" data-suffix="">0</div>
            <div class="label">Partner organisations</div>
        </div>
        <div class="stat">
            <div class="num" data-count-to="20" data-suffix="+">0</div>
            <div class="label">Years in Thika</div>
        </div>
    </div>
</div>
