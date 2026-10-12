@extends('layouts.admin')
@section('title',__('admin.title_sliders'))
@section('page-title',__('admin.title_sliders_mgmt'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_sliders') }}</h4>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_slider') }}</a>
</div>
@foreach($pages as $key => $label)
    @if(isset($sliders[$key]) && $sliders[$key]->count() > 0)
    <div class="card mb-3">
        <div class="card-header"><h6 class="card-title mb-0">{{ $label }}</h6></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>#</th><th>{{ __('admin.col_image') }}</th><th>Title (EN)</th><th>{{ __('admin.field_text_align') }}</th><th>{{ __('admin.col_order') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
                    <tbody>
                        @foreach($sliders[$key] as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>@if($s->image)<img src="{{ asset('storage/'.$s->image) }}" style="height:40px;width:70px;object-fit:cover;border-radius:6px;">@else<span style="color:var(--text-muted);font-size:0.8rem;">{{ __('admin.no_image') }}</span>@endif</td>
                            <td>{{ Str::limit($s->getTranslation('title','en'),50) }}</td>
                            <td><span class="badge bg-secondary">{{ $s->text_align }}</span></td>
                            <td>{{ $s->order }}</td>
                            <td><span class="badge" style="background:{{ $s->is_active ? 'var(--success)' : 'var(--danger)' }}22;color:{{ $s->is_active ? 'var(--success)' : 'var(--danger)' }};">{{ $s->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
                            <td>
                                <a href="{{ route('admin.sliders.edit',$s) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a>
                                <form method="POST" action="{{ route('admin.sliders.destroy',$s) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@endforeach
@endsection
