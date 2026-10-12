@extends('layouts.admin')
@section('title',__('admin.title_testimonials')) @section('page-title',__('admin.title_testimonials'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_testimonials') }}</h4><a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.new') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_author') }}</th><th>{{ __('admin.field_company') }}</th><th>{{ __('admin.field_quote') }}</th><th>{{ __('admin.col_rating') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($testimonials as $t)
<tr>
<td style="font-weight:500;">{{ $t->getTranslation('author_name','en') }}</td>
<td>{{ $t->author_company ?? '—' }}</td>
<td>{{ Str::limit($t->getTranslation('quote','en'),60) }}</td>
<td>{{ str_repeat('⭐',$t->rating) }}</td>
<td><span class="badge" style="background:{{ $t->is_active ? 'var(--success)':'var(--danger)' }}22;color:{{ $t->is_active ? 'var(--success)':'var(--danger)' }};">{{ $t->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.testimonials.edit',$t) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.testimonials.destroy',$t) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
