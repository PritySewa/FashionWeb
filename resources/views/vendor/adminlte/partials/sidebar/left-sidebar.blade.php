<style>
    /* Sidebar menu text consistently black */
    .main-sidebar .nav-sidebar .nav-link {
        color: #000 !important;
    }

    .main-sidebar .nav-sidebar .nav-link.active {
        background-color: #EFDECD !important; /* your #654321 shade */
        color: #000 !important;
    }

    .main-sidebar .nav-sidebar .nav-link:hover {
        background-color: #EFDECD !important;
        color: #000 !important;
    }

    /* Remove underline from the brand logo */
    .brand-link {
        border-bottom: none !important;
    }

    .brand-link:hover {
        border-bottom: none !important;
    }
</style>

<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}" style="background-color: #654321;">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar" style="background-color: #9F8170;">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
