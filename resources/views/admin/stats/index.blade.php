@extends('layouts.admin')
@section('title',__('admin.title_stats')) @section('page-title',__('admin.title_stats'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_stats') }}</h4><a href="{{ route('admin.stats.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_stat') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_icon') }}</th><th>{{ __('admin.col_value') }}</th><th>{{ __('admin.col_label') }}</th><th>{{ __('admin.col_order') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($stats as $s)
<tr><td><i class="{{ $s->icon }}"></i></td><td style="font-weight:700;font-size:1.1rem;color:var(--primary-400);">{{ $s->value }}</td><td>{{ $s->getTranslation('label','en') }}</td><td>{{ $s->order }}</td>
<td><span class="badge" style="background:{{ $s->is_active ? 'var(--success)':'var(--danger)' }}22;color:{{ $s->is_active ? 'var(--success)':'var(--danger)' }};">{{ $s->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.stats.edit',$s) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.stats.destroy',$s) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
