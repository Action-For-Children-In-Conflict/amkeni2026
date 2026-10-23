@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= DONATE ================= -->
    <section class="section-pad donation-section">
        <div class="container container-narrow">
            <div class="section-head text-center mx-auto">
                <span class="section-eyebrow">Make A Difference</span>
                <h2>Your gift keeps our doors open</h2>
                <hr class="rule mx-auto">
                <p>Every donation goes directly into child protection, education, women's empowerment and climate action
                    in Thika. Choose the giving option that works best for you.</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- PayPal -->
                <div class="col-lg-4 d-flex">
                    <div class="donation-card">
                        <span class="donation-icon donation-icon-paypal">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7.1 21.5H3.2L6.8 2.5h6.1c3.4 0 5.6 1.7 5.1 4.7-.5 3.4-3.1 5.3-6.3 5.3H9.3l-2.2 9zm2.4-11.8h1.9c1.6 0 2.9-.8 3.2-2.4.2-1.4-.6-2.2-2-2.2H10.7l-1.2 4.6z"/>
                                <path d="M13.6 21.5h-3.9l2.2-9h2.9c3.3 0 5.5 1.7 5 4.7-.5 3.4-3.1 5.3-6.2 5.3h-1.2l1.2-1z" opacity=".55"/>
                            </svg>
                        </span>
                        <h3>PayPal</h3>
                        <p class="donation-copy">Give securely from anywhere in the world with a PayPal account or a debit
                            or credit card.</p>
                        <div class="donation-actions">
                            <a href="https://www.paypal.com/donate/?hosted_button_id=LU7GDTJZH7NLG"
                                class="btn-primary-afcic w-100" target="_blank" rel="noopener">
                                Donate with PayPal
                            </a>
                        </div>
                    </div>
                </div>

                <!-- M-Pesa -->
                <div class="col-lg-4 d-flex">
                    <div class="donation-card donation-card-featured">
                        <span class="donation-icon donation-icon-mpesa">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect width="14" height="20" x="5" y="2" rx="2"></rect>
                                <path d="M12 18h.01"></path>
                            </svg>
                        </span>
                        <h3>M-Pesa</h3>
                        <p class="donation-copy">Pay with M-Pesa using our Buy Goods and Services till number.</p>
                        <div class="donation-number">
                            <span class="donation-number-label">Till Number</span>
                            <strong id="mpesaTill">56476</strong>
                        </div>
                        <ol class="donation-steps">
                            <li>Open M-Pesa and choose <strong>Lipa na M-Pesa</strong>.</li>
                            <li>Select <strong>Buy Goods and Services</strong>.</li>
                            <li>Enter till <strong>56476</strong> and the amount.</li>
                        </ol>
                        <div class="donation-actions">
                            <button type="button" class="btn-outline-afcic w-100" id="copyTillButton"
                                data-copy="56476">Copy till number</button>
                        </div>
                    </div>
                </div>

                <!-- Bank / Card -->
                <div class="col-lg-4 d-flex">
                    <div class="donation-card">
                        <span class="donation-icon donation-icon-bank">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m3 10 9-6 9 6"></path>
                                <path d="M5 10v9M9 10v9M15 10v9M19 10v9"></path>
                                <path d="M3 21h18"></path>
                            </svg>
                        </span>
                        <h3>Bank / Card</h3>
                        <p class="donation-copy">For a bank transfer or a direct card donation, contact our team and we will
                            share the account details and help you complete your gift.</p>
                        <div class="donation-actions donation-contact">
                            <a href="mailto:info@actionchildren.or.ke" class="btn-primary-afcic w-100">
                                Email for bank details
                            </a>
                            <a href="tel:+254714038285" class="btn-outline-afcic w-100">Call +254 714 038285</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="donation-note text-center">
                <p class="mb-0">Prefer to talk it through? Visit us at Section 9, Thika, or
                    <a href="{{ route('contact') }}">contact our team</a>. Thank you for standing with children and
                    families in Thika.</p>
            </div>
        </div>
    </section>

    <script>
        (function() {
            var copyButton = document.getElementById('copyTillButton');

            if (!copyButton || !navigator.clipboard) {
                return;
            }

            copyButton.addEventListener('click', function() {
                navigator.clipboard.writeText(copyButton.dataset.copy).then(function() {
                    copyButton.textContent = 'Till number copied';

                    window.setTimeout(function() {
                        copyButton.textContent = 'Copy till number';
                    }, 2000);
                });
            });
        })();
    </script>
@endsection
