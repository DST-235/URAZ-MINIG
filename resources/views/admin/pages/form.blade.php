@extends('layouts.admin')
@section('title',__('admin.form_edit_page')) @section('page-title',__('admin.form_edit_page'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ __('admin.form_edit_page') }}: {{ $page->slug }}</h6></div><div class="card-body">
<form method="POST" action="{{ route('admin.pages.update',$page) }}">
@csrf @method('PUT')
<div class="d-flex align-items-center gap-3 mb-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $page->is_active ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div></div>
@include('components.lang-tabs')
@foreach(['en'=>'English','fr'=>'Français','ar'=>'العربية'] as $lang => $lbl)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_title') }} ({{ $lbl }}) *</label><input type="text" name="title_{{ $lang }}" class="form-control" value="{{ $page->getTranslation('title',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.field_meta_title') }} ({{ $lbl }})</label><input type="text" name="meta_title_{{ $lang }}" class="form-control" value="{{ $page->getTranslation('meta_title',$lang) }}"></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_meta_desc') }} ({{ $lbl }})</label><textarea name="meta_description_{{ $lang }}" class="form-control" rows="2">{{ $page->getTranslation('meta_description',$lang) }}</textarea></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_content') }} ({{ $lbl }})</label><textarea name="content_{{ $lang }}" class="form-control" rows="12">{{ $page->getTranslation('content',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="d-flex gap-2 mt-3"><button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button><a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
