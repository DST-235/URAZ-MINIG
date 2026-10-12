@extends('layouts.admin')
@section('title', $editing ? __('admin.form_edit_user') : __('admin.form_new_user'))
@section('page-title', $editing ? __('admin.form_edit_user') : __('admin.form_new_user'))

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> {{ __('admin.users_back') }}
    </a>
</div>

<form action="{{ $editing ? route('admin.users.update',$user) : route('admin.users.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($editing) @method('PUT') @endif

    <div class="row g-4">
        {{-- Left: Photo card --}}
        <div class="col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body text-center" style="padding:2rem 1.5rem;">
                    <div id="photoPreviewWrap" style="margin-bottom:1.25rem;">
                        @if($editing && $user->profile_photo_path)
                            <img id="photoPreview" src="{{ asset('storage/'.$user->profile_photo_path) }}"
                                 style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:3px solid var(--primary-600);display:block;margin:0 auto;">
                        @else
                            <div id="photoPlaceholder" style="width:120px;height:120px;border-radius:50%;background:linear-gradient(135deg,var(--primary-600),var(--primary-800));display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:700;color:#fff;margin:0 auto;" id="photoInitial">
                                <i class="fas fa-user"></i>
                            </div>
                            <img id="photoPreview" src="" style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:3px solid var(--primary-600);display:none;margin:0 auto;">
                        @endif
                    </div>
                    <label class="btn btn-sm btn-outline-secondary w-100 mb-2" style="cursor:pointer;">
                        <i class="fas fa-camera me-1"></i> {{ __('admin.upload_photo') }}
                        <input type="file" name="photo" id="photoInput" accept="image/*" style="display:none;">
                    </label>
                    <p style="font-size:0.75rem;color:var(--text-disabled);margin:0;">{{ __('admin.photo_hint') }}</p>
                    @error('photo') <p class="mt-1" style="color:#f87171;font-size:0.78rem;">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Status card --}}
            <div class="card mt-3">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="form-label mb-0">{{ __('admin.active') }}</span>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                   id="isActiveToggle"
                                   {{ old('is_active', $editing ? $user->is_active : true) ? 'checked' : '' }}
                                   {{ ($editing && $user->id === auth()->id()) ? 'disabled' : '' }}>
                        </div>
                    </div>
                    @if($editing && $user->id === auth()->id())
                        <p style="font-size:0.75rem;color:var(--text-disabled);margin-top:0.4rem;margin-bottom:0;">{{ __('admin.users_no_deactivate') }}</p>
                        <input type="hidden" name="is_active" value="1">
                    @endif
                </div>
            </div>
        </div>

        {{-- Right: Details --}}
        <div class="col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">{{ __('admin.users_account') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.field_full_name') }} <span style="color:#f87171;">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name',$user->name) }}" placeholder="John Doe">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.field_email') }} <span style="color:#f87171;">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email',$user->email) }}" placeholder="user@example.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.field_phone') }}</label>
                            <input type="tel" name="phone" dir="ltr" class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone',$user->phone) }}" placeholder="+235 …">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.field_position_title') }}</label>
                            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                                   value="{{ old('position',$user->position) }}" placeholder="Senior Developer">
                            @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.field_role') }} <span style="color:#f87171;">*</span></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="member" {{ old('role',$user->role) == 'member' ? 'selected':'' }}>{{ __('admin.users_role_member') }}</option>
                                <option value="admin"  {{ old('role',$user->role) == 'admin'  ? 'selected':'' }}>{{ __('admin.users_role_admin') }}</option>
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title">{{ $editing ? __('admin.users_change_pwd') : __('admin.users_set_pwd') }}
                        @if($editing) <small style="color:var(--text-muted);font-weight:400;font-size:0.78rem;"> — {{ __('admin.field_password_keep') }}</small> @endif
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.field_password') }} {{ $editing ? '' : '*' }}</label>
                            <div class="input-group">
                                <input type="password" name="password" id="passwordField"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="{{ $editing ? __('admin.field_password_keep') : __('admin.field_password_min') }}"
                                       {{ $editing ? '' : 'required' }}>
                                <button type="button" class="btn btn-outline-secondary" id="togglePwd" style="border-color:var(--dark-600);background:var(--bg-tertiary);color:var(--text-muted);">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.field_confirm_pwd') }} {{ $editing ? '' : '*' }}</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control"
                                   placeholder="{{ __('admin.field_repeat_pwd') }}"
                                   {{ $editing ? '' : 'required' }}>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> {{ $editing ? __('admin.users_update') : __('admin.users_create') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Photo preview
document.getElementById('photoInput')?.addEventListener('change', function() {
    if (!this.files || !this.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('photoPreview');
        const placeholder = document.getElementById('photoPlaceholder');
        img.src = e.target.result;
        img.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(this.files[0]);
});

// Password toggle
document.getElementById('togglePwd')?.addEventListener('click', function() {
    const field = document.getElementById('passwordField');
    const icon  = document.getElementById('eyeIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye','fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash','fa-eye');
    }
});
</script>
@endpush
