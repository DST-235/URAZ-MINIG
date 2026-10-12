@extends('layouts.admin')
@section('title','My Profile')
@section('page-title','My Profile')

@push('styles')
<style>
/* Profile page: handle Tailwind utility classes since Tailwind CSS is not loaded */
.profile-section .col-span-6,
.profile-section [class*="col-span"] { display:block; width:100%; margin-bottom:1rem; }
.profile-section [class*="col-span"]:last-child { margin-bottom:0; }
.profile-section input[class*="w-"] { width:100% !important; }
/* Spacing helpers */
.profile-section .mt-3 { margin-top:0.75rem !important; }
.profile-section .mt-4 { margin-top:1rem !important; }
.profile-section .mt-5 { margin-top:1.25rem !important; }
.profile-section .ms-3 { margin-left:0.75rem !important; }
.profile-section .me-3 { margin-right:0.75rem !important; }
/* Flex helpers */
.profile-section .flex { display:flex !important; }
.profile-section .items-center { align-items:center !important; }
.profile-section .space-y-6 > * + * { margin-top:1.5rem; }
/* Text overrides (Tailwind colors → dark theme) */
.profile-section .text-gray-600, .profile-section .text-gray-500 { color:var(--text-muted) !important; }
.profile-section .text-gray-900, .profile-section h3.font-medium { color:var(--text-primary) !important; font-size:1rem; font-weight:600; }
.profile-section .text-sm { font-size:0.875rem; }
.profile-section .text-xs { font-size:0.78rem; }
.profile-section .font-semibold { font-weight:600 !important; }
.profile-section .text-green-500 { color:#10b981 !important; }
/* Recovery codes block */
.profile-section .font-mono { font-family:monospace !important; background:var(--bg-primary) !important; border:1px solid var(--dark-600); border-radius:8px; padding:1rem; color:var(--text-secondary); }
/* 2FA QR code wrapper */
.profile-section .inline-block.bg-white { background:#fff !important; padding:0.5rem; border-radius:6px; display:inline-block; }
/* Photo - Tailwind size-20 */
.profile-section .size-20, .profile-section .rounded-full.size-20 { width:80px !important; height:80px !important; border-radius:50% !important; object-fit:cover !important; }
/* Session SVG icons */
.profile-section svg.size-8 { width:32px; height:32px; color:var(--text-muted); }
/* Max width helpers */
.profile-section .max-w-xl { max-width:100% !important; }
</style>
@endpush

@section('content')
{{-- Profile Hero --}}
<div class="card mb-4">
    <div class="card-body" style="padding:1.75rem;">
        <div class="d-flex align-items-center gap-4 flex-wrap">
            <div style="position:relative;flex-shrink:0;">
                @if(auth()->user()->profile_photo_path)
                    <img src="{{ asset('storage/'.auth()->user()->profile_photo_path) }}"
                         alt="{{ auth()->user()->name }}"
                         style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid var(--primary-600);">
                @else
                    <div style="width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,var(--primary-500),var(--primary-800));display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;color:#fff;">
                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                    </div>
                @endif
                <span style="position:absolute;bottom:4px;right:4px;width:14px;height:14px;background:#10b981;border-radius:50%;border:2px solid var(--bg-secondary);"></span>
            </div>
            <div>
                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                <p class="mb-1" style="color:var(--text-muted);font-size:0.875rem;">{{ auth()->user()->email }}</p>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge {{ auth()->user()->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                    @if(auth()->user()->position)
                    <span style="color:var(--text-muted);font-size:0.8rem;">— {{ auth()->user()->position }}</span>
                    @endif
                    @if(auth()->user()->phone)
                    <span dir="ltr" style="color:var(--text-muted);font-size:0.8rem;"><i class="fas fa-phone me-1" style="font-size:0.7rem;"></i>{{ auth()->user()->phone }}</span>
                    @endif
                </div>
            </div>
            <div class="ms-auto">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-users me-1"></i>Manage Users
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')
        @endif
    </div>

    <div class="col-lg-4">
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            @livewire('profile.two-factor-authentication-form')
        @endif

        @livewire('profile.logout-other-browser-sessions-form')

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            @livewire('profile.delete-user-form')
        @endif
    </div>
</div>
@endsection
