@extends('layouts.admin')
@section('title', $stat ? __('admin.form_edit_stat') : __('admin.form_new_stat')) @section('page-title', $stat ? __('admin.form_edit_stat') : __('admin.form_new_stat'))
@section('content')
<div class="card" style="max-width:800px;"><div class="card-header"><h6 class="card-title">{{ $stat ? __('admin.form_edit_stat') : __('admin.form_new_stat') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $stat ? route('admin.stats.update',$stat) : route('admin.stats.store') }}">
@csrf @if($stat) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_icon') }} * <small style="color:var(--text-muted);">({{ __('admin.field_icon_hint') }})</small></label><input type="text" name="icon" class="form-control" value="{{ $stat?->icon ?? 'fas fa-chart-bar' }}" required></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_value') }} * <small style="color:var(--text-muted);">({{ __('admin.field_value_hint') }})</small></label><input type="text" name="value" class="form-control" value="{{ $stat?->value }}" required></div>
<div class="col-md-2"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $stat?->order ?? 0 }}"></div>
<div class="col-md-2 d-flex align-items-end"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $stat?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div></div>
</div>
@include('components.lang-tabs')
@foreach(['en'=>'English','fr'=>'Français','ar'=>'العربية'] as $lang => $lbl)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_label') }} ({{ $lbl }}) *</label><input type="text" name="label_{{ $lang }}" class="form-control" value="{{ $stat?->getTranslation('label',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.field_description') }} ({{ $lbl }})</label><input type="text" name="description_{{ $lang }}" class="form-control" value="{{ $stat?->getTranslation('description',$lang) }}"></div>
</div></div>
@endforeach
<div class="d-flex gap-2 mt-3"><button type="submit" class="btn btn-primary">{{ $stat ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.stats.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
