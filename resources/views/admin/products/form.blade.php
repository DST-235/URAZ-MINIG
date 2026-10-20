@extends('layouts.admin')
@section('title', $product ? __('admin.form_edit_product') : __('admin.form_new_product')) @section('page-title', $product ? __('admin.form_edit_product') : __('admin.form_new_product'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $product ? __('admin.form_edit_product') : __('admin.form_new_product') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $product ? route('admin.products.update',$product) : route('admin.products.store') }}" enctype="multipart/form-data">
@csrf @if($product) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_category') }}</label><input type="text" name="category" class="form-control" value="{{ $product?->category ?? 'Metals' }}" placeholder="Metals, Energy..."></div>
<div class="col-md-4"><label class="form-label">{{ __('admin.field_icon') }} <small style="color:var(--text-muted);">({{ __('admin.field_icon_hint') }})</small></label><input type="text" name="icon" class="form-control" value="{{ $product?->icon ?? 'fas fa-gem' }}"></div>
<div class="col-md-2"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $product?->order ?? 0 }}"></div>
<div class="col-md-2 d-flex flex-column gap-2 justify-content-end"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $product?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div><div class="form-check"><input class="form-check-input" type="checkbox" name="show_in_nav" {{ $product?->show_in_nav ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.show_in_nav') }}</label></div></div>
</div>
@include('components.lang-tabs')
@foreach(config('locales') as $lang => $l)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_name') }} ({{ $l['native'] }}) *</label><input type="text" name="name_{{ $lang }}" class="form-control" value="{{ $product?->getTranslation('name',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_short_desc') }} ({{ $l['native'] }})</label><textarea name="short_description_{{ $lang }}" class="form-control" rows="2">{{ $product?->getTranslation('short_description',$lang) }}</textarea></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_full_desc') }} ({{ $l['native'] }}) *</label><textarea name="description_{{ $lang }}" class="form-control" rows="5" {{ $lang=='en'?'required':'' }}>{{ $product?->getTranslation('description',$lang) }}</textarea></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_features') }} ({{ $l['native'] }}) <small style="color:var(--text-muted);">({{ __('admin.field_features_hint') }})</small></label><input type="text" name="features_{{ $lang }}" class="form-control" value="{{ $product?->getTranslation('features',$lang) }}"></div>
</div></div>
@endforeach
<div class="mb-4"><label class="form-label">{{ __('admin.field_image') }}</label>@if($product?->image)<img src="{{ asset('storage/'.$product->image) }}" style="height:80px;border-radius:8px;display:block;margin-bottom:0.5rem;">@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">{{ $product ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.products.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
