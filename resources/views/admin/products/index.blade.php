@extends('layouts.admin')
@section('title',__('admin.title_products')) @section('page-title',__('admin.title_products'))
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h4 style="color:var(--text-primary);margin:0;">{{ __('admin.title_products') }}</h4><a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>{{ __('admin.form_new_product') }}</a></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive"><table class="table mb-0">
<thead><tr><th>{{ __('admin.col_icon') }}</th><th>{{ __('admin.col_name') }}</th><th>{{ __('admin.col_category') }}</th><th>{{ __('admin.col_slug') }}</th><th>{{ __('admin.col_order') }}</th><th>{{ __('admin.col_status') }}</th><th>{{ __('admin.col_actions') }}</th></tr></thead>
<tbody>
@foreach($products as $p)
<tr>
<td><i class="{{ $p->icon }}"></i></td>
<td>{{ $p->getTranslation('name','en') }}</td>
<td>{{ $p->category }}</td>
<td><code style="color:var(--info);font-size:0.78rem;">{{ $p->slug }}</code></td>
<td>{{ $p->order }}</td>
<td><span class="badge" style="background:{{ $p->is_active ? 'var(--success)' : 'var(--danger)' }}22;color:{{ $p->is_active ? 'var(--success)' : 'var(--danger)' }};">{{ $p->is_active ? __('admin.active') : __('admin.inactive') }}</span></td>
<td><a href="{{ route('admin.products.edit',$p) }}" class="btn btn-sm" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">{{ __('admin.edit') }}</a> <form method="POST" action="{{ route('admin.products.destroy',$p) }}" class="d-inline" onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:var(--danger);">{{ __('admin.delete') }}</button></form></td>
</tr>
@endforeach
</tbody></table></div></div></div>
@endsection
