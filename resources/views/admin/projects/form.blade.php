@extends('layouts.admin')
@section('title', $project ? __('admin.form_edit_project') : __('admin.form_new_project')) @section('page-title', $project ? __('admin.form_edit_project') : __('admin.form_new_project'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $project ? __('admin.form_edit_project') : __('admin.form_new_project') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $project ? route('admin.projects.update',$project) : route('admin.projects.store') }}" enctype="multipart/form-data">
@csrf @if($project) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_technologies') }}</label><input type="text" name="technologies" class="form-control" value="{{ $project?->technologies }}" placeholder="Laravel, Vue.js..."></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_completed_date') }}</label><input type="date" name="completed_at" class="form-control" value="{{ $project?->completed_at?->format('Y-m-d') }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_url') }}</label><input type="url" name="url" class="form-control" value="{{ $project?->url }}"></div>
<div class="col-md-1"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $project?->order ?? 0 }}"></div>
<div class="col-md-1 d-flex flex-column gap-2 justify-content-end">
<div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $project?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div>
<div class="form-check"><input class="form-check-input" type="checkbox" name="is_featured" {{ $project?->is_featured ? 'checked':'' }}><label class="form-check-label">{{ __('admin.featured') }}</label></div>
</div>
</div>
@include('components.lang-tabs')
@foreach(['en'=>'English','fr'=>'Français','ar'=>'العربية'] as $lang => $lbl)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_title') }} ({{ $lbl }}) *</label><input type="text" name="title_{{ $lang }}" class="form-control" value="{{ $project?->getTranslation('title',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_client') }} ({{ $lbl }})</label><input type="text" name="client_{{ $lang }}" class="form-control" value="{{ $project?->getTranslation('client',$lang) }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_category') }} ({{ $lbl }})</label><input type="text" name="category_{{ $lang }}" class="form-control" value="{{ $project?->getTranslation('category',$lang) }}"></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_description') }} ({{ $lbl }}) *</label><textarea name="description_{{ $lang }}" class="form-control" rows="4" {{ $lang=='en'?'required':'' }}>{{ $project?->getTranslation('description',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="mb-4"><label class="form-label">{{ __('admin.field_image') }}</label>@if($project?->image)<img src="{{ asset('storage/'.$project->image) }}" style="height:80px;border-radius:8px;display:block;margin-bottom:0.5rem;">@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">{{ $project ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
