@php
$configData = Helper::applClasses();
@endphp
<div
  class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu-accordion menu-shadow"
  data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto">
        <a class="navbar-brand" href="{{ url('/') }}">
            <svg class="tw-w-full" version="1.1" id="Lager_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 500 80" style="enable-background:new 0 0 500 80" xml:space="preserve"><style>.st0{fill:#1a171b}.st1{fill:#cf0b1c}</style><path id="XMLID_7_" class="st0" d="M35.1 28.2v-9.7H74c13 0 19.4 5.4 19.4 16.2v16.2c0 8.6-6.5 13-19.4 13H35.1v-26h13v16.2H74c4.3 0 6.5-2.2 6.5-6.5v-13c0-4.3-2.2-6.5-6.5-6.5H35.1z"/><path id="XMLID_11_" class="st0" d="m110.4 54.1-4.9 9.7H90.9L110.4 25c2.2-4.3 5.4-6.5 9.7-6.5h3.2c4.3 0 7.6 2.2 9.7 6.5l19.4 38.9h-14.6l-4.9-9.7h-22.5zm-3.3-48.5h13v9.7h-13V5.6zm21.1 38.8-6.5-13-6.5 13h13zm-4.9-38.8h13v9.7h-13V5.6z"/><path id="XMLID_2_" class="st0" d="M205.9 54.1v9.7h-32.4c-13 0-19.4-5.4-19.4-16.2v-13c0-10.8 6.5-16.2 19.4-16.2h32.4v9.7h-32.4c-4.3 0-6.5 2.2-6.5 6.5v13c0 4.3 2.2 6.5 6.5 6.5h32.4z"/><path id="XMLID_1_" class="st0" d="M254.5 18.5h16.2l-24 18.2 33.7 40.1h-14.6L237 44l-14.9 11.3v8.5h-13V18.5h13V43z"/><path id="XMLID_13_" class="st1" d="M288.2 48c0 4.4 2.2 6.5 6.5 6.5h32.7v9.8h-32.7c-13.1 0-19.6-5.5-19.6-16.4V18.5h13.1V48z"/><path id="XMLID_12_" class="st1" d="M330.8 18.5h13.1v45.8h-13.1z"/><path id="XMLID_10_" class="st1" d="M360.2 33.2v31.1h-13.1V33.2c0-9.8 5.5-14.7 16.4-14.7 4.8 0 8.6 2.2 11.5 6.5l16.4 24.5c1.1 1.1 2.1 1.6 3.1 1.6 1.2 0 1.8-.5 1.8-1.6v-31h13.1v31.1c0 9.8-5.5 14.7-16.4 14.7-4.8 0-8.6-2.2-11.5-6.5l-16.4-24.5c-1.1-1.1-2.1-1.6-3.1-1.6-1.2-.1-1.8.4-1.8 1.5"/><path id="XMLID_9_" class="st1" d="M425.6 46.3V48c0 4.4 2.2 6.5 6.5 6.5h32.7v9.8h-32.7c-13.1 0-19.6-5.5-19.6-16.4v-13c0-10.9 6.5-16.4 19.6-16.4h32.7v9.8H432c-4.4 0-6.5 2.2-6.5 6.5v1.6h39.3v9.8h-39.2z"/></svg>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
            data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
      @if (isset($menuData[0]))
        @foreach ($menuData[0]->menu as $menu)
          @if (isset($menu->navheader))
            <li class="navigation-header">
              <span>{{ __('sidebar.' . $menu->navheader) }}</span>
              <i data-feather="more-horizontal"></i>
            </li>
          @else
            {{-- Add Custom Class with nav-item --}}
            @php
              $custom_classes = '';
              if (isset($menu->classlist)) {
                  $custom_classes = $menu->classlist;
              }
            @endphp
            @php
            $submenuSlugs = [];
            $routeName = Route::currentRouteName();
            if(isset($menu->submenu)) {
                $submenuSlugs = array_map(function($submenu) {
                    return $submenu->slug;
                }, $menu->submenu);
                if(str_contains($routeName, '.')) {
                    $routeName = substr($routeName, 0, strpos($routeName, "."));
                }
            }
            @endphp
            <li
              class="nav-item {{ $custom_classes }} {{ in_array($routeName, $submenuSlugs) ? 'open' : '' }}">
              <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}" class="d-flex align-items-center"
                target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                <i data-feather="{{ $menu->icon }}"></i>
                <span class="menu-title text-truncate">{{ __('sidebar.' . $menu->name) }}</span>
                @if (isset($menu->badge))
                  <?php $badgeClasses = 'badge rounded-pill badge-light-primary ms-auto me-1'; ?>
                  <span
                    class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }}">{{ $menu->badge }}</span>
                @endif
              </a>
              @if (isset($menu->submenu))
                @include('panels/submenu', ['menu' => $menu->submenu])
              @endif
            </li>
          @endif
        @endforeach
      @endif
      {{-- Foreach menu item ends --}}
    </ul>
  </div>
</div>
<!-- END: Main Menu-->
