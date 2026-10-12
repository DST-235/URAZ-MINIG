@extends('layouts.admin')
@section('title',__('admin.title_services')) @section('page-title',__('admin.title_services'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_services') }}</h4><a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_service') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_icon') }}</th><th>{{ __('admin.col_name') }}</th><th>{{ __('admin.col_slug') }}</th><th>{{ __('admin.col_parent') }}</th><th>{{ __('admin.col_order') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($services as $s)
<tr>
<td><i class="{{ $s->icon }}"></i></td>
<td>{{ $s->getTranslation('name','en') }}</td>
<td><code style="color:var(--info);font-size:0.78rem;">{{ $s->slug }}</code></td>
<td>{{ $s->parent?->getTranslation('name','en') ?? '—' }}</td>
<td>{{ $s->order }}</td>
<td><span class="badge" style="background:{{ $s->is_active ? 'var(--success)' : 'var(--danger)' }}22;color:{{ $s->is_active ? 'var(--success)' : 'var(--danger)' }};">{{ $s->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.services.edit',$s) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.services.destroy',$s) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@foreach($s->children as $child)
<tr style="background:rgba(255,255,255,0.02);">
<td style="padding-left:2rem;"><i class="{{ $child->icon }}"></i></td>
<td style="padding-left:2rem;">↳ {{ $child->getTranslation('name','en') }}</td>
<td><code style="color:var(--info);font-size:0.78rem;">{{ $child->slug }}</code></td>
<td>{{ $s->getTranslation('name','en') }}</td>
<td>{{ $child->order }}</td>
<td><span class="badge" style="background:{{ $child->is_active ? 'var(--success)' : 'var(--danger)' }}22;color:{{ $child->is_active ? 'var(--success)' : 'var(--danger)' }};">{{ $child->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.services.edit',$child) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.services.destroy',$child) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
@endforeach
</tbody></table></div></div></div>
@endsection
