@extends('layouts.admin')
@section('title', $member ? __('admin.form_edit_team') : __('admin.form_new_team')) @section('page-title', $member ? __('admin.form_edit_team') : __('admin.form_new_team'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $member ? __('admin.form_edit_team') : __('admin.form_new_team') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $member ? route('admin.team.update',$member) : route('admin.team.store') }}" enctype="multipart/form-data">
@csrf @if($member) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_email') }}</label><input type="email" name="email" class="form-control" value="{{ $member?->email }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_linkedin') }}</label><input type="text" name="linkedin" class="form-control" value="{{ $member?->linkedin }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_twitter') }}</label><input type="text" name="twitter" class="form-control" value="{{ $member?->twitter }}"></div>
<div class="col-md-1"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $member?->order ?? 0 }}"></div>
<div class="col-md-1 d-flex align-items-end"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $member?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div></div>
</div>
@include('components.lang-tabs')
@foreach(config('locales') as $lang => $l)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_name') }} ({{ $l['native'] }}) *</label><input type="text" name="name_{{ $lang }}" class="form-control" value="{{ $member?->getTranslation('name',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.field_position') }} ({{ $l['native'] }}) *</label><input type="text" name="position_{{ $lang }}" class="form-control" value="{{ $member?->getTranslation('position',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_bio') }} ({{ $l['native'] }})</label><textarea name="bio_{{ $lang }}" class="form-control" rows="3">{{ $member?->getTranslation('bio',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="mb-4"><label class="form-label">{{ __('admin.field_photo') }}</label>@if($member?->photo)<img src="{{ asset('storage/'.$member->photo) }}" style="height:80px;width:80px;border-radius:50%;object-fit:cover;display:block;margin-bottom:0.5rem;">@endif<input type="file" name="photo" class="form-control" accept="image/*"></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">{{ $member ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.team.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
