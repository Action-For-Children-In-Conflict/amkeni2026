<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action for Children in Conflict (AfCiC) — Thika, Kenya</title>
    <meta name="description"
        content="AfCiC protects and empowers children and vulnerable families in Thika, Kenya through child protection, education, women's empowerment and climate action.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- Bootstrap 5 -->
    <link href="{{ asset('frontend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">
    {{-- custom css  --}}



</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-afcic sticky-top">
        <div class="container container-narrow">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/assets/logo.png') }}" alt="AfCiC logo" class="navbar-logo" style="max-height: 38px; width: auto; object-fit: contain;">
                <span>AfCi<span>C</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#about" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">About Us</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#about">About Us</a></li>
                            <li><a class="dropdown-item" href="#">Our Team</a></li>
                            <li><a class="dropdown-item" href="#partners">Our Partners</a></li>
                            <li><a class="dropdown-item" href="#contact">Our Location</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#focus" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Our Focus Areas</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="focus-child-protection.html">Child Protection</a></li>
                            <li><a class="dropdown-item" href="focus-education-empowerment.html">Education
                                    Empowerment</a></li>
                            <li><a class="dropdown-item" href="focus-womens-empowerment.html">Women's Empowerment</a>
                            </li>
                            <li><a class="dropdown-item" href="focus-climate-change.html">Climate Change</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#centers" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Our Centers</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="center-trc.html">Temporary Rescue Center</a></li>
                            <li><a class="dropdown-item" href="center-wcc.html">Working Children Center</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#stories" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Be Informed</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#stories">Success Stories</a></li>
                            <li><a class="dropdown-item" href="#news">Events</a></li>
                            <li><a class="dropdown-item" href="#news">Reports</a></li>
                            <li><a class="dropdown-item" href="#news">Blog</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn-donate" href="#donate">Donate</a></li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- add three flaoting icons on the right side of the page whatsapp call and email --}}


    @yield('content')



    <!-- ================= FOOTER ================= -->
    <footer id="contact" class="pt-5 pb-4">
        <div class="container container-narrow">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand mb-2">
                        <img src="{{ asset('images/assets/logo.png') }}" alt="AfCiC logo" class="footer-logo" style="max-height: 32px; width: auto; max-width: 130px; object-fit: contain;">
                    </div>
                    <p>Action for Children in Conflict — Section 9, Thika, Kenya. P.O. Box 6439-01000.</p>
                    <div class="mt-3 d-flex align-items-center flex-wrap">
                        <a href="https://x.com/AfCiC" class="social-dot" aria-label="X (Twitter)" target="_blank" rel="noopener">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/ActionChildren" class="social-dot" aria-label="Facebook" target="_blank" rel="noopener">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/company/action-for-children-in-conflict-afcic" class="social-dot" aria-label="LinkedIn" target="_blank" rel="noopener">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2V10.9H6.46M7.83 6.45a1.6 1.6 0 0 0-1.6 1.6 1.6 1.6 0 0 0 1.6 1.6 1.6 1.6 0 0 0 1.6-1.6 1.6 1.6 0 0 0-1.6-1.6z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>About</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#about">Our story</a></li>
                        <li class="mb-2"><a href="#focus">Focus areas</a></li>
                        <li class="mb-2"><a href="#stories">Success stories</a></li>
                        <li class="mb-2"><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Get involved</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#donate">Donate</a></li>
                        <li class="mb-2"><a href="#">Volunteer</a></li>
                        <li class="mb-2"><a href="#">Partner with us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Head office</h5>
                    <p class="mb-2 d-flex align-items-center footer-contact-item">
                        <span class="footer-contact-icon me-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </span>
                        <a href="tel:+254714038285" class="footer-contact-link">+254 714 038285</a>
                    </p>
                    <p class="mb-2 d-flex align-items-center footer-contact-item">
                        <span class="footer-contact-icon me-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </span>
                        <a href="mailto:infokenya@actionchildren.or.ke" class="footer-contact-link">infokenya@actionchildren.or.ke</a>
                    </p>
                    <p class="mb-2 d-flex align-items-center footer-contact-item">
                        <span class="footer-contact-icon me-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </span>
                        <span>Open Monday–Friday, 8am–5pm EAT</span>
                    </p>
                    <div class="footer-map-card">
                        <div class="footer-map-frame">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!4v1792180164460!6m8!1m7!1s-w9YFVw6xoLv24lAER64cg!2m2!1d-1.03713701705676!2d37.07086702328631!3f334.40112!4f0!5f0.7820865974627469" 
                                title="AfCiC Location in Section 9, Thika, Kenya"
                                width="100%" 
                                height="180" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="strict-origin-when-cross-origin">
                            </iframe>
                        </div>
                        <div class="footer-map-meta">
                            <span class="footer-map-location">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--orange);"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Section 9, Thika, Kenya
                            </span>
                            <a href="https://maps.google.com/?q=-1.037137,37.070867" target="_blank" rel="noopener" class="footer-map-link">
                                Open in Maps &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom pt-4 mt-4 d-flex flex-column flex-sm-row justify-content-between">
                <span>© 2026 Action for Children in Conflict. All rights reserved.</span>
                <span>Starter template — built for actionchildren.or.ke</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('frontend/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     
    <script>
        // Count-up animation for stat figures, triggered once each enters view.
        (function() {
            var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            function formatNumber(n) {
                return Math.round(n).toLocaleString('en-US');
            }

            function animateCount(el) {
                var target = parseFloat(el.getAttribute('data-count-to'), 10);
                var suffix = el.getAttribute('data-suffix') || '';
                if (prefersReduced || isNaN(target)) {
                    el.textContent = formatNumber(target) + suffix;
                    return;
                }
                var duration = 1400;
                var start = null;

                function step(timestamp) {
                    if (!start) start = timestamp;
                    var progress = Math.min((timestamp - start) / duration, 1);
                    var eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
                    el.textContent = formatNumber(target * eased) + suffix;
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        el.textContent = formatNumber(target) + suffix;
                    }
                }
                window.requestAnimationFrame(step);
            }

            var counters = document.querySelectorAll('[data-count-to]');
            if (!counters.length) return;

            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            animateCount(entry.target);
                            obs.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });

                counters.forEach(function(el) {
                    observer.observe(el);
                });
            } else {
                counters.forEach(animateCount);
            }
        })();
    </script>
</body>

</html>
