@extends('layouts.admin')
@section('title',__('admin.title_dashboard'))
@section('page-title',__('admin.title_dashboard'))

@section('content')
<div class="row g-3 mb-4">
    @php $cards = [['label'=>__('admin.dash_products'),'icon'=>'fas fa-gem','count'=>$stats['products'],'color'=>'var(--primary-500)','link'=>route('admin.products.index')],['label'=>__('admin.dash_operations'),'icon'=>'fas fa-route','count'=>$stats['operations'],'color'=>'var(--success)','link'=>route('admin.operations.index')],['label'=>__('admin.dash_team'),'icon'=>'fas fa-users','count'=>$stats['team'],'color'=>'var(--info)','link'=>route('admin.team.index')],['label'=>__('admin.dash_blog'),'icon'=>'fas fa-newspaper','count'=>$stats['posts'],'color'=>'var(--warning)','link'=>route('admin.blog.index')],['label'=>__('admin.dash_messages'),'icon'=>'fas fa-envelope','count'=>$stats['messages'],'color'=>'var(--danger)','link'=>route('admin.contact.index')],['label'=>__('admin.dash_sliders'),'icon'=>'fas fa-images','count'=>$stats['sliders'],'color'=>'#8b5cf6','link'=>route('admin.sliders.index')]]; @endphp
    @foreach($cards as $card)
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ $card['link'] }}" style="text-decoration:none;">
            <div class="stat-card">
                <div class="stat-icon mb-2" style="background:{{ $card['color'] }}22;">
                    <i class="{{ $card['icon'] }}" style="color:{{ $card['color'] }};"></i>
                </div>
                <div style="font-size:1.75rem;font-weight:800;color:var(--text-primary);">{{ $card['count'] }}</div>
                <div style="font-size:0.78rem;color:var(--text-muted);">{{ $card['label'] }}</div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title">{{ __('admin.quick_actions') }}</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @php $actions = [['label'=>__('admin.dash_add_slider'),'icon'=>'fas fa-images','route'=>route('admin.sliders.create'),'color'=>'var(--primary-500)'],['label'=>__('admin.dash_add_product'),'icon'=>'fas fa-gem','route'=>route('admin.products.create'),'color'=>'var(--success)'],['label'=>__('admin.dash_add_operation'),'icon'=>'fas fa-route','route'=>route('admin.operations.create'),'color'=>'var(--info)'],['label'=>__('admin.dash_add_blog'),'icon'=>'fas fa-pen','route'=>route('admin.blog.create'),'color'=>'var(--warning)'],['label'=>__('admin.dash_add_team'),'icon'=>'fas fa-user-plus','route'=>route('admin.team.create'),'color'=>'#8b5cf6'],['label'=>__('admin.edit_settings'),'icon'=>'fas fa-sliders-h','route'=>route('admin.settings.index'),'color'=>'var(--danger)']]; @endphp
                    @foreach($actions as $action)
                    <div class="col-6 col-md-4">
                        <a href="{{ $action['route'] }}" style="display:flex;align-items:center;gap:0.75rem;padding:1rem;background:var(--bg-tertiary);border-radius:10px;border:1px solid var(--dark-600);text-decoration:none;transition:var(--transition);" onmouseover="this.style.borderColor='{{ $action['color'] }}'" onmouseout="this.style.borderColor='var(--dark-600)'">
                            <i class="{{ $action['icon'] }}" style="color:{{ $action['color'] }};font-size:1.1rem;"></i>
                            <span style="color:var(--text-secondary);font-size:0.85rem;font-weight:500;">{{ $action['label'] }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h6 class="card-title">{{ __('admin.site_info') }}</h6></div>
            <div class="card-body">
                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                    <div style="display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid var(--dark-700);"><span style="color:var(--text-muted);font-size:0.82rem;">{{ __('admin.settings_site_name') }}</span><span style="color:var(--text-primary);font-size:0.82rem;">{{ \App\Models\Setting::get('site_name','Uraz Mining &amp; Trading LTD') }}</span></div>
                    <div style="display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid var(--dark-700);"><span style="color:var(--text-muted);font-size:0.82rem;">{{ __('admin.settings_city') }}</span><span style="color:var(--text-primary);font-size:0.82rem;">{{ \App\Models\Setting::get('site_city','—') }}</span></div>
                    <div style="display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid var(--dark-700);"><span style="color:var(--text-muted);font-size:0.82rem;">{{ __('admin.field_email') }}</span><span style="color:var(--text-primary);font-size:0.82rem;">{{ \App\Models\Setting::get('site_email','—') }}</span></div>
                    <div style="display:flex;justify-content:space-between;padding:0.5rem 0;"><span style="color:var(--text-muted);font-size:0.82rem;">{{ __('admin.field_phone') }}</span><span dir="ltr" style="color:var(--text-primary);font-size:0.82rem;">{{ \App\Models\Setting::get('site_phone','—') }}</span></div>
                </div>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-outline-secondary mt-3 w-100" style="border-color:var(--dark-600);color:var(--text-muted);">{{ __('admin.edit_settings') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
