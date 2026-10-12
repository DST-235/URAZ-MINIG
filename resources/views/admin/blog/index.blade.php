@extends('layouts.admin')
@section('title',__('admin.title_blog')) @section('page-title',__('admin.title_blog'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_blog') }}</h4><a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_blog') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_title') }}</th><th>{{ __('admin.col_category') }}</th><th>{{ __('admin.col_author') }}</th><th>{{ __('admin.col_published') }}</th><th>{{ __('admin.col_featured') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($posts as $p)
<tr>
<td style="font-weight:500;">{{ Str::limit($p->getTranslation('title','en'),50) }}</td>
<td>{{ $p->getTranslation('category','en') }}</td>
<td>{{ $p->author?->name ?? '—' }}</td>
<td style="font-size:0.82rem;">{{ $p->published_at?->format('d M Y') ?? '—' }}</td>
<td>{{ $p->is_featured ? '⭐' : '—' }}</td>
<td><span class="badge" style="background:{{ $p->is_published ? 'var(--success)':'var(--warning)' }}22;color:{{ $p->is_published ? 'var(--success)':'var(--warning)' }};">{{ $p->is_published ? __('admin.published') : __('admin.draft') }}</span></td>
<td><a href="{{ route('admin.blog.edit',$p) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.blog.destroy',$p) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
