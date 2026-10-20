@extends('layouts.admin')
@section('title', $operation ? __('admin.form_edit_operation') : __('admin.form_new_operation')) @section('page-title', $operation ? __('admin.form_edit_operation') : __('admin.form_new_operation'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $operation ? __('admin.form_edit_operation') : __('admin.form_new_operation') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $operation ? route('admin.operations.update',$operation) : route('admin.operations.store') }}" enctype="multipart/form-data">
@csrf @if($operation) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-3">
    <label class="form-label">{{ __('admin.field_category') }}</label>
    <select name="category" class="form-select">
        @foreach(['sourcing','logistics','export','warehousing'] as $cat)
        <option value="{{ $cat }}" {{ $operation?->category == $cat ? 'selected':'' }}>{{ __('admin.operation_category_'.$cat) }}</option>
        @endforeach
    </select>
</div>
<div class="col-md-4"><label class="form-label">{{ __('admin.field_tags') }}</label><input type="text" name="tags" class="form-control" value="{{ $operation?->tags }}" placeholder="Rail, Port of Douala, Bonded Warehouse"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_active_since') }}</label><input type="date" name="active_since" class="form-control" value="{{ $operation?->active_since?->format('Y-m-d') }}"></div>
<div class="col-md-1"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $operation?->order ?? 0 }}"></div>
<div class="col-md-1 d-flex flex-column gap-2 justify-content-end">
<div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $operation?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div>
<div class="form-check"><input class="form-check-input" type="checkbox" name="is_featured" {{ $operation?->is_featured ? 'checked':'' }}><label class="form-check-label">{{ __('admin.featured') }}</label></div>
</div>
</div>
@include('components.lang-tabs')
@foreach(config('locales') as $lang => $l)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_title') }} ({{ $l['native'] }}) *</label><input type="text" name="title_{{ $lang }}" class="form-control" value="{{ $operation?->getTranslation('title',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.field_location') }} ({{ $l['native'] }})</label><input type="text" name="location_{{ $lang }}" class="form-control" value="{{ $operation?->getTranslation('location',$lang) }}"></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_description') }} ({{ $l['native'] }}) *</label><textarea name="description_{{ $lang }}" class="form-control" rows="4" {{ $lang=='en'?'required':'' }}>{{ $operation?->getTranslation('description',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="mb-4"><label class="form-label">{{ __('admin.field_image') }}</label>@if($operation?->image)<img src="{{ asset('storage/'.$operation->image) }}" style="height:80px;border-radius:8px;display:block;margin-bottom:0.5rem;">@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">{{ $operation ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.operations.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
