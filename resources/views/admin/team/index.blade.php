@extends('layouts.admin')
@section('title',__('admin.title_team')) @section('page-title',__('admin.title_team'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_team') }}</h4><a href="{{ route('admin.team.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_team') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.field_photo') }}</th><th>{{ __('admin.col_name') }}</th><th>{{ __('admin.col_position') }}</th><th>{{ __('admin.col_email') }}</th><th>{{ __('admin.col_order') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($members as $m)
<tr>
<td>@if($m->photo)<img src="{{ asset('storage/'.$m->photo) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">@else<div style="width:36px;height:36px;border-radius:50%;background:var(--primary-600);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;">{{ strtoupper(substr($m->getTranslation('name','en'),0,1)) }}</div>@endif</td>
<td style="font-weight:500;">{{ $m->getTranslation('name','en') }}</td>
<td>{{ $m->getTranslation('position','en') }}</td>
<td style="font-size:0.82rem;">{{ $m->email ?? '—' }}</td>
<td>{{ $m->order }}</td>
<td><span class="badge" style="background:{{ $m->is_active ? 'var(--success)':'var(--danger)' }}22;color:{{ $m->is_active ? 'var(--success)':'var(--danger)' }};">{{ $m->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.team.edit',$m) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.team.destroy',$m) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
