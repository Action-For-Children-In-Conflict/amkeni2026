@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= ABOUT US ================= -->
    <section class="section-pad about-page">
        <div class="container container-narrow">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="section-head mb-0">
                        <span class="section-eyebrow">Who We Are</span>
                        <h2>Action for Children in Conflict (AfCiC)</h2>
                        <hr class="rule">
                        <p>Action for Children in Conflict (AfCiC) is a Kenyan Non-Governmental Organisation (NGO) established in 2004 and registered with the NGO Coordination Board of Kenya. We are based in Thika and work across Kiambu, Murang'a and Nairobi counties.</p>
                        <p>Our work is anchored in child protection, with a holistic approach that addresses education, health, psychosocial support, justice and economic empowerment for children, young people and their families. We focus on prevention and response to child abuse, neglect and exploitation, while strengthening families and communities to become safer and more resilient.</p>
                        <p>Over the years, we have rescued and rehabilitated street-connected children through our Temporary Rescue Centre, supported vulnerable children to stay in school, empowered women and girls, and promoted environmental stewardship through climate action initiatives.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-hero-media">
                        <img src="{{ asset('frontend/images/slider/slider2.jpeg') }}"
                            alt="Children and caregivers supported by AfCiC" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= MISSION VISION CORE VALUES ================= -->
    <section class="section-pad section-tint-blue">
        <div class="container container-narrow">
            <div class="section-head text-center mx-auto">
                <span class="section-eyebrow">Our Foundation</span>
                <h2>Mission, Vision & Core Values</h2>
                <hr class="rule mx-auto">
                <p>Guided by our commitment to every child, we work to create a world where all children can grow up safe, healthy, educated and empowered.</p>
            </div>

            <div class="row g-4 about-mv-grid">
                <div class="col-lg-4 d-flex">
                    <article class="about-mv-card">
                        <div class="about-mv-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                            </svg>
                        </div>
                        <h3>Our Mission</h3>
                        <p>To enhance and support the growth of children, young people and their families by facilitating access to justice, education, health, psychosocial support and economic empowerment, with communities at the centre of their own growth.</p>
                    </article>
                </div>
                <div class="col-lg-4 d-flex">
                    <article class="about-mv-card about-mv-card-accent">
                        <div class="about-mv-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                        <h3>Our Vision</h3>
                        <p>A world of equal and sustainable opportunities for every child — regardless of where they were born or what they have been through.</p>
                    </article>
                </div>
                <div class="col-lg-4 d-flex">
                    <article class="about-mv-card">
                        <div class="about-mv-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3>Our Core Values</h3>
                        <ul class="about-values-list">
                            <li><strong>Child-Centredness</strong> — The best interest of the child guides all our decisions.</li>
                            <li><strong>Integrity</strong> — We uphold transparency, accountability and ethical practice.</li>
                            <li><strong>Respect & Dignity</strong> — We value every person and treat them with compassion.</li>
                            <li><strong>Inclusivity</strong> — We embrace diversity and leave no child behind.</li>
                            <li><strong>Participation</strong> — Children and families are active partners in solutions.</li>
                            <li><strong>Empowerment</strong> — We build capacity for lasting change.</li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= APPROACH ================= -->
    <section class="section-pad">
        <div class="container container-narrow">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="section-head mb-0">
                        <span class="section-eyebrow">How We Work</span>
                        <h2>Prevention, protection and empowerment</h2>
                        <hr class="rule">
                        <p>We take a holistic, rights-based approach that combines direct care with advocacy, family strengthening and community mobilisation.</p>
                    </div>
                    <div class="about-approach-list">
                        <article class="about-approach-item">
                            <div class="about-approach-dot"></div>
                            <div>
                                <h4>Rescue &amp; Rehabilitation</h4>
                                <p>Safe shelter, care and reintegration for street-connected children through our Temporary Rescue Centre.</p>
                            </div>
                        </article>
                        <article class="about-approach-item">
                            <div class="about-approach-dot"></div>
                            <div>
                                <h4>Education &amp; Skills</h4>
                                <p>School support, bursaries, vocational training and mentorship to keep children learning and dreaming big.</p>
                            </div>
                        </article>
                        <article class="about-approach-item">
                            <div class="about-approach-dot"></div>
                            <div>
                                <h4>Family &amp; Economic Empowerment</h4>
                                <p>Strengthening caregivers with skills, savings groups and income opportunities for stronger, safer homes.</p>
                            </div>
                        </article>
                        <article class="about-approach-item">
                            <div class="about-approach-dot"></div>
                            <div>
                                <h4>Child Protection &amp; Climate Action</h4>
                                <p>Advocacy, awareness, psychosocial support and environmental stewardship for a safer future.</p>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="about-hero-media about-hero-media-offset">
                        <img src="{{ asset('frontend/images/slider/trc-slider.jpeg') }}"
                            alt="Children learning and playing in a safe space" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.cta')
@endsection
