@extends('layouts.admin')
@section('title', $testimonial ? __('admin.form_edit_testimonial') : __('admin.form_new_testimonial')) @section('page-title', $testimonial ? __('admin.form_edit_testimonial') : __('admin.form_new_testimonial'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $testimonial ? __('admin.form_edit_testimonial') : __('admin.form_new_testimonial') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $testimonial ? route('admin.testimonials.update',$testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
@csrf @if($testimonial) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_company') }}</label><input type="text" name="author_company" class="form-control" value="{{ $testimonial?->author_company }}"></div>
<div class="col-md-2"><label class="form-label">{{ __('admin.field_rating') }}</label><input type="number" name="rating" class="form-control" min="1" max="5" value="{{ $testimonial?->rating ?? 5 }}"></div>
<div class="col-md-2"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $testimonial?->order ?? 0 }}"></div>
<div class="col-md-2 d-flex align-items-end"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $testimonial?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div></div>
</div>
@include('components.lang-tabs')
@foreach(['en'=>'English','fr'=>'Français','ar'=>'العربية'] as $lang => $lbl)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_author_name') }} ({{ $lbl }}) *</label><input type="text" name="author_name_{{ $lang }}" class="form-control" value="{{ $testimonial?->getTranslation('author_name',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.field_position') }} ({{ $lbl }})</label><input type="text" name="author_position_{{ $lang }}" class="form-control" value="{{ $testimonial?->getTranslation('author_position',$lang) }}"></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_quote') }} ({{ $lbl }}) *</label><textarea name="quote_{{ $lang }}" class="form-control" rows="3" {{ $lang=='en'?'required':'' }}>{{ $testimonial?->getTranslation('quote',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="mb-4"><label class="form-label">{{ __('admin.field_author_photo') }}</label>@if($testimonial?->author_photo)<img src="{{ asset('storage/'.$testimonial->author_photo) }}" style="height:60px;width:60px;border-radius:50%;object-fit:cover;display:block;margin-bottom:0.5rem;">@endif<input type="file" name="author_photo" class="form-control" accept="image/*"></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">{{ $testimonial ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
