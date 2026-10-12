@extends('layouts.admin')
@section('title', $faq ? __('admin.form_edit_faq') : __('admin.form_new_faq')) @section('page-title', $faq ? __('admin.form_edit_faq') : __('admin.form_new_faq'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $faq ? __('admin.form_edit_faq') : __('admin.form_new_faq') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $faq ? route('admin.faqs.update',$faq) : route('admin.faqs.store') }}">
@csrf @if($faq) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_page_key') }} * <small style="color:var(--text-muted);">({{ __('admin.field_page_key_hint') }})</small></label><input type="text" name="page_key" class="form-control" value="{{ $faq?->page_key ?? 'home' }}" required></div>
<div class="col-md-2"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $faq?->order ?? 0 }}"></div>
<div class="col-md-2 d-flex align-items-end"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $faq?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div></div>
</div>
@include('components.lang-tabs')
@foreach(['en'=>'English','fr'=>'Français','ar'=>'العربية'] as $lang => $lbl)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-12"><label class="form-label">Question ({{ $lbl }}) *</label><input type="text" name="question_{{ $lang }}" class="form-control" value="{{ $faq?->getTranslation('question',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-12"><label class="form-label">Answer ({{ $lbl }}) *</label><textarea name="answer_{{ $lang }}" class="form-control" rows="4" {{ $lang=='en'?'required':'' }}>{{ $faq?->getTranslation('answer',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="d-flex gap-2 mt-3"><button type="submit" class="btn btn-primary">{{ $faq ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
