@extends('layouts.public')
@section('title',__('messages.nav_contact'))
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>__('messages.contact_us'),'subtitle'=>__('messages.contact_sub')])

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <span class="badge-pill badge-blue mb-3">{{ __('messages.get_in_touch') }}</span>
                <h2 class="section-title mb-4">{{ __('messages.contact_title') }}</h2>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div><strong style="color:var(--text-dark);display:block;">{{ __('messages.address') }}</strong><span style="color:var(--text-muted);font-size:0.9rem;">{{ implode(', ', array_filter([\App\Models\Setting::get('site_address'), \App\Models\Setting::get('site_city'), \App\Models\Setting::get('site_country')])) }}</span></div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div><strong style="color:var(--text-dark);display:block;">{{ __('messages.phone') }}</strong><span dir="ltr" style="color:var(--text-muted);font-size:0.9rem;">{{ \App\Models\Setting::get('site_phone') }}</span></div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div><strong style="color:var(--text-dark);display:block;">{{ __('messages.email') }}</strong><span style="color:var(--text-muted);font-size:0.9rem;">{{ \App\Models\Setting::get('site_email') }}</span></div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div><strong style="color:var(--text-dark);display:block;">{{ __('messages.working_hours_label') }}</strong><span style="color:var(--text-muted);font-size:0.9rem;">{{ __('messages.working_hours_val') }}</span></div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="contact-form-wrap">
                    @if(session('success'))<div class="alert" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:10px;padding:1rem;color:#059669;margin-bottom:1.5rem;"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>@endif
                    <h4 style="font-weight:700;margin-bottom:1.5rem;">{{ __('messages.send_message') }}</h4>
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label style="font-size:0.85rem;font-weight:600;color:var(--text-dark);display:block;margin-bottom:0.4rem;">{{ __('messages.name') }} *</label>
                                <input type="text" name="name" class="form-control-uraz" value="{{ old('name') }}" required>
                                @error('name')<span style="color:#dc2626;font-size:0.8rem;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-sm-6">
                                <label style="font-size:0.85rem;font-weight:600;color:var(--text-dark);display:block;margin-bottom:0.4rem;">{{ __('messages.email') }} *</label>
                                <input type="email" name="email" class="form-control-uraz" value="{{ old('email') }}" required>
                                @error('email')<span style="color:#dc2626;font-size:0.8rem;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-sm-6">
                                <label style="font-size:0.85rem;font-weight:600;color:var(--text-dark);display:block;margin-bottom:0.4rem;">{{ __('messages.phone') }}</label>
                                <input type="tel" name="phone" class="form-control-uraz" value="{{ old('phone') }}">
                            </div>
                            <div class="col-sm-6">
                                <label style="font-size:0.85rem;font-weight:600;color:var(--text-dark);display:block;margin-bottom:0.4rem;">{{ __('messages.company') }}</label>
                                <input type="text" name="company" class="form-control-uraz" value="{{ old('company') }}">
                            </div>
                            <div class="col-12">
                                <label style="font-size:0.85rem;font-weight:600;color:var(--text-dark);display:block;margin-bottom:0.4rem;">{{ __('messages.subject') }}</label>
                                <input type="text" name="subject" class="form-control-uraz" value="{{ old('subject') }}">
                            </div>
                            <div class="col-12">
                                <label style="font-size:0.85rem;font-weight:600;color:var(--text-dark);display:block;margin-bottom:0.4rem;">{{ __('messages.message') }} *</label>
                                <textarea name="message" class="form-control-uraz" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')<span style="color:#dc2626;font-size:0.8rem;">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-primary-uraz" style="width:100%;padding:0.9rem;">{{ __('messages.send_message') }} <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
