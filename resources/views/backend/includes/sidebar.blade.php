<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{route('backend.dashboard')}}">
            <span class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold" style="font-size: 16px; color:white;"><span
                        class="font-weight-bold border px-3 me-1 bg-warning" style="color: black; background:red;">Kestrel</span>Brothers Supply</h1>
                </span>
            <img class="sidebar-brand-narrow" src="{{asset('img/backend-logo-square.jpg')}}" height="46" alt="{{ app_name() }}">
        </a>
    </div>

    {!! $admin_sidebar->asUl( ['class' => 'sidebar-nav', 'data-coreui'=>'navigation', 'data-simplebar'], ['class' => 'nav-group-items'] ) !!}

    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>