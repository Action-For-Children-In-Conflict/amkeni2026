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
            <a class="navbar-brand" href="#">AfCi<span>C</span></a>
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
                    <div class="footer-brand mb-3">AfCi<span>C</span></div>
                    <p>Action for Children in Conflict — Section 9, Thika, Kenya. P.O. Box 6439-01000.</p>
                    <div class="mt-3">
                        <a href="https://x.com/AfCiC" class="social-dot">X</a>
                        <a href="https://www.facebook.com/ActionChildren" class="social-dot">f</a>
                        <a href="https://www.linkedin.com/company/action-for-children-in-conflict-afcic"
                            class="social-dot">in</a>
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
                    <p class="mb-1">+254 714 038285</p>
                    <p class="mb-1">infokenya@actionchildren.or.ke</p>
                    <p>Open Monday–Friday, 8am–5pm EAT</p>
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
