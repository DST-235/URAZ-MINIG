@extends('layouts.admin')
@section('title', $slider ? __('admin.form_edit_slider') : __('admin.form_new_slider'))
@section('page-title', $slider ? __('admin.form_edit_slider') : __('admin.form_new_slider'))
@section('content')
<div class="card" style="max-width:900px;">
    <div class="card-header"><h6 class="card-title">{{ $slider ? __('admin.form_edit_slider') : __('admin.form_new_slider') }}</h6></div>
    <div class="card-body">
        <form method="POST" action="{{ $slider ? route('admin.sliders.update',$slider) : route('admin.sliders.store') }}" enctype="multipart/form-data">
            @csrf @if($slider) @method('PUT') @endif
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('admin.field_page_key') }} *</label>
                    <select name="page_key" class="form-select" required>
                        @foreach($pages as $k => $v)<option value="{{ $k }}" {{ ($slider?->page_key==$k ? 'selected' : (old('page_key')==$k ? 'selected' : '')) }}>{{ $v }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('admin.field_text_align') }}</label>
                    <select name="text_align" class="form-select">
                        @foreach(['left','center','right'] as $a)<option value="{{ $a }}" {{ ($slider?->text_align==$a || old('text_align')==$a) ? 'selected' : '' }}>{{ ucfirst($a) }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('admin.field_order') }}</label>
                    <input type="number" name="order" class="form-control" value="{{ $slider?->order ?? old('order',0) }}">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ ($slider?->is_active ?? true) ? 'checked' : '' }}><label class="form-check-label" for="is_active">{{ __('admin.active') }}</label></div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('admin.field_overlay_color') }} <small style="color:var(--text-muted);">({{ __('admin.field_overlay_hint') }})</small></label>
                <input type="text" name="overlay_color" class="form-control" value="{{ $slider?->overlay_color ?? 'rgba(10,22,40,0.65)' }}">
            </div>

            @include('components.lang-tabs')
            @foreach(config('locales') as $lang => $l)
            <div class="lang-content" data-lang="{{ $lang }}">
                <div class="row g-3 mb-3">
                    <div class="col-md-6"><label class="form-label">{{ __('admin.field_title') }} ({{ $l['native'] }})</label><input type="text" name="title_{{ $lang }}" class="form-control" value="{{ $slider?->getTranslation('title',$lang) ?? old('title_'.$lang) }}"></div>
                    <div class="col-md-6"><label class="form-label">{{ __('admin.field_btn_text') }} ({{ $l['native'] }})</label><input type="text" name="button_text_{{ $lang }}" class="form-control" value="{{ $slider?->getTranslation('button_text',$lang) ?? old('button_text_'.$lang) }}"></div>
                    <div class="col-12"><label class="form-label">Subtitle ({{ $l['native'] }})</label><textarea name="subtitle_{{ $lang }}" class="form-control" rows="2">{{ $slider?->getTranslation('subtitle',$lang) ?? old('subtitle_'.$lang) }}</textarea></div>
                </div>
            </div>
            @endforeach

            <div class="mb-3">
                <label class="form-label">{{ __('admin.field_btn_link') }}</label>
                <input type="text" name="button_link" class="form-control" value="{{ $slider?->button_link ?? old('button_link') }}" placeholder="/services">
            </div>
            <div class="mb-4">
                <label class="form-label">{{ __('admin.col_image') }} <small style="color:var(--text-muted);">({{ __('admin.slider_img_hint') }})</small></label>
                @if($slider?->image)<img src="{{ asset('storage/'.$slider->image) }}" style="height:100px;border-radius:8px;display:block;margin-bottom:0.5rem;">@endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small style="color:var(--text-muted);">{{ __('admin.slider_img_keep') }}</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $slider ? __('admin.update') : __('admin.create') }}</button>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
