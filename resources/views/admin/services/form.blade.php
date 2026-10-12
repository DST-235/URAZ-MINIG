@extends('layouts.admin')
@section('title', $service ? __('admin.form_edit_service') : __('admin.form_new_service')) @section('page-title', $service ? __('admin.form_edit_service') : __('admin.form_new_service'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ $service ? __('admin.form_edit_service') : __('admin.form_new_service') }}</h6></div><div class="card-body">
<form method="POST" action="{{ $service ? route('admin.services.update',$service) : route('admin.services.store') }}" enctype="multipart/form-data">
@csrf @if($service) @method('PUT') @endif
<div class="row g-3 mb-3">
<div class="col-md-4"><label class="form-label">{{ __('admin.field_parent') }}</label><select name="parent_id" class="form-select"><option value="">— {{ __('admin.none_root') }} —</option>@foreach($parents as $p)<option value="{{ $p->id }}" {{ $service?->parent_id==$p->id ? 'selected':'' }}>{{ $p->getTranslation('name','en') }}</option>@endforeach</select></div>
<div class="col-md-4"><label class="form-label">{{ __('admin.field_icon') }} <small style="color:var(--text-muted);">({{ __('admin.field_icon_hint') }})</small></label><input type="text" name="icon" class="form-control" value="{{ $service?->icon ?? 'fas fa-cogs' }}"></div>
<div class="col-md-2"><label class="form-label">{{ __('admin.field_order') }}</label><input type="number" name="order" class="form-control" value="{{ $service?->order ?? 0 }}"></div>
<div class="col-md-1 d-flex flex-column gap-2 justify-content-end"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" {{ $service?->is_active ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.active') }}</label></div><div class="form-check"><input class="form-check-input" type="checkbox" name="show_in_nav" {{ $service?->show_in_nav ?? true ? 'checked':'' }}><label class="form-check-label">{{ __('admin.show_in_nav') }}</label></div></div>
</div>
@include('components.lang-tabs')
@foreach(['en'=>'English','fr'=>'Français','ar'=>'العربية'] as $lang => $lbl)
<div class="lang-content" data-lang="{{ $lang }}">
<div class="row g-3 mb-3">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_name') }} ({{ $lbl }}) *</label><input type="text" name="name_{{ $lang }}" class="form-control" value="{{ $service?->getTranslation('name',$lang) }}" {{ $lang=='en'?'required':'' }}></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_short_desc') }} ({{ $lbl }})</label><textarea name="short_description_{{ $lang }}" class="form-control" rows="2">{{ $service?->getTranslation('short_description',$lang) }}</textarea></div>
<div class="col-12"><label class="form-label">{{ __('admin.field_full_desc') }} ({{ $lbl }}) *</label><textarea name="description_{{ $lang }}" class="form-control" rows="5" {{ $lang=='en'?'required':'' }}>{{ $service?->getTranslation('description',$lang) }}</textarea></div>
</div></div>
@endforeach
<div class="mb-4"><label class="form-label">{{ __('admin.field_image') }}</label>@if($service?->image)<img src="{{ asset('storage/'.$service->image) }}" style="height:80px;border-radius:8px;display:block;margin-bottom:0.5rem;">@endif<input type="file" name="image" class="form-control" accept="image/*"></div>
<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">{{ $service ? __('admin.update') : __('admin.create') }}</button><a href="{{ route('admin.services.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a></div>
</form></div></div>
@endsection
