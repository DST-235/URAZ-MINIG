@extends('layouts.admin')
@section('title',__('admin.title_faqs')) @section('page-title',__('admin.title_faqs'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_faqs') }}</h4><a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_faq') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_page') }}</th><th>Question (EN)</th><th>{{ __('admin.col_order') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($faqs as $f)
<tr><td><span class="badge bg-secondary">{{ $f->page_key }}</span></td><td>{{ Str::limit($f->getTranslation('question','en'),70) }}</td><td>{{ $f->order }}</td>
<td><span class="badge" style="background:{{ $f->is_active ? 'var(--success)':'var(--danger)' }}22;color:{{ $f->is_active ? 'var(--success)':'var(--danger)' }};">{{ $f->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.faqs.edit',$f) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.faqs.destroy',$f) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
