@extends('layouts.admin')
@section('title',__('admin.title_pages')) @section('page-title',__('admin.title_pages'))
@section('content')
<div class="mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.pages_static') }}</h4><p style="color:var(--text-muted);font-size:0.85rem;margin-top:0.25rem;">{{ __('admin.pages_description') }}</p></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_slug') }}</th><th>{{ __('admin.col_title') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($pages as $p)
<tr><td><code style="color:var(--info);font-size:0.82rem;">{{ $p->slug }}</code></td><td style="font-weight:500;">{{ $p->getTranslation('title','en') }}</td>
<td><span class="badge" style="background:{{ $p->is_active ? 'var(--success)':'var(--danger)' }}22;color:{{ $p->is_active ? 'var(--success)':'var(--danger)' }};">{{ $p->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.pages.edit',$p) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit_content') }}</a></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
