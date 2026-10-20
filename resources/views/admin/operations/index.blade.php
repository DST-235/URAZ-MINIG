@extends('layouts.admin')
@section('title',__('admin.title_operations')) @section('page-title',__('admin.title_operations'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_operations') }}</h4><a href="{{ route('admin.operations.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_operation') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_image') }}</th><th>{{ __('admin.col_title') }}</th><th>{{ __('admin.col_category') }}</th><th>{{ __('admin.col_location') }}</th><th>{{ __('admin.col_featured') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($operations as $p)
<tr>
<td>@if($p->image)<img src="{{ asset('storage/'.$p->image) }}" style="height:40px;width:60px;object-fit:cover;border-radius:6px;">@else<span style="color:var(--text-muted);font-size:0.8rem;">—</span>@endif</td>
<td style="font-weight:500;">{{ Str::limit($p->getTranslation('title','en'),40) }}</td>
<td>{{ __('admin.operation_category_'.$p->category) }}</td>
<td>{{ $p->getTranslation('location','en') }}</td>
<td>{{ $p->is_featured ? '⭐' : '—' }}</td>
<td><span class="badge" style="background:{{ $p->is_active ? 'var(--success)':'var(--danger)' }}22;color:{{ $p->is_active ? 'var(--success)':'var(--danger)' }};">{{ $p->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.operations.edit',$p) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.operations.destroy',$p) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
