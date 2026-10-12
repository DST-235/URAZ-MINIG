@extends('layouts.admin')
@section('title', $post ? __('admin.form_edit_blog') : __('admin.form_new_blog')) @section('page-title', $post ? __('admin.form_edit_blog') : __('admin.form_new_blog'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $post ? __('admin.form_edit_blog') : __('admin.form_new_blog') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $post ? route('admin.blog.update',$post) : route('admin.blog.store') }}" enctype="multipart/form-data">
@csrf @if($post) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_published_date') }}</label><input type="date" name="published_at" class="form-control" value="{{ $post?->published_at?->format('Y-m-d') ?? date('Y-m-d') }}"></div>
<div class="col-md-4 d-flex align-items-end gap-3">
<div class="form-check"><input class="form-check-input" type="checkbox" name="is_published" id="pub" {{ $post?->is_published ? 'checked':'' }}><label class="form-check-label" for="pub">{{ __('admin.published') }}</label></div>
<div class="form-check"><input class="form-check-input" type="checkbox" name="is_featured" id="feat" {{ $post?->is_featured ? 'checked':'' }}><label class="form-check-label" for="feat">{{ __('admin.featured') }}</label></div>
</div>
</div>
@include('components.lang-tabs')
@foreach(['en'=>'English','fr'=>'Français','ar'=>'العربية'] as $lang => $lbl)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-8"><label class="form-label">{{ __('admin.field_title') }} ({{ $lbl }}) *</label><input type="text" name="title_{{ $lang }}" class="form-control" value="{{ $post?->getTranslation('title',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-md-4"><label class="form-label">{{ __('admin.field_category') }} ({{ $lbl }})</label><input type="text" name="category_{{ $lang }}" class="form-control" value="{{ $post?->getTranslation('category',$lang) }}"></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_excerpt') }} ({{ $lbl }})</label><textarea name="excerpt_{{ $lang }}" class="form-control" rows="2">{{ $post?->getTranslation('excerpt',$lang) }}</textarea></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_content') }} ({{ $lbl }}) *</label><textarea name="content_{{ $lang }}" class="form-control" rows="10" {{ $lang=='en'?'required':'' }}>{{ $post?->getTranslation('content',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="mb-4"><label class="form-label">{{ __('admin.field_image') }}</label>@if($post?->image)<img src="{{ asset('storage/'.$post->image) }}" style="height:80px;border-radius:8px;display:block;margin-bottom:0.5rem;">@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">{{ $post ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
