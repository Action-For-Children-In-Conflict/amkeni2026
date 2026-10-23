@if (session('success'))
    <div class="alert alert-success enquiry-alert" role="alert">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger enquiry-alert" role="alert">
        Please check the highlighted fields and try again.
    </div>
@endif

<form method="POST" action="{{ route('contact.submit') }}" class="enquiry-form">
    @csrf
    <input type="hidden" name="type" value="{{ $type->value }}">

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Full name *</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" required autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email address *</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" required autocomplete="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Phone number</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="form-control @error('phone') is-invalid @enderror" autocomplete="tel">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="organization" class="form-label">{{ $organizationLabel }}</label>
            <input type="text" name="organization" id="organization" value="{{ old('organization') }}"
                class="form-control @error('organization') is-invalid @enderror" autocomplete="organization">
            @error('organization')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                class="form-control @error('subject') is-invalid @enderror"
                placeholder="{{ $subjectPlaceholder }}">
            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="message" class="form-label">Message *</label>
            <textarea name="message" id="message" rows="5"
                class="form-control @error('message') is-invalid @enderror" required
                placeholder="{{ $messagePlaceholder }}">{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 pt-2">
            <button type="submit" class="btn-primary-afcic w-100">{{ $buttonLabel }}</button>
        </div>
    </div>
</form>
