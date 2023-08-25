@if (auth()->check() && isset(auth()->user()->id))
    <style>
        .menu_icon_area {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--dark);
            display: inline-flex;
            align-content: center;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 11;
        }

        .menu_icon_area img {
            width: 50%;
            height: 50%;
            object-fit: contain;
            align-content: center;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 12;
        }

        .badge_count {
            position: absolute;
            top: 15px;
            left: 25%;
            font-size: 12px;
            font-weight: bold;
        }

        .modal_content_type {
            display: none;
        }
    </style>
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark d-lg-flex d-md-none d-sm-none">
            <a href="{{ route('welcome') }}" class="navbar-brand mx-4 mb-3">
                <h4 class="text-primary">
                    <img class="img-responsive img-fluid"
                        src="{{ isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null }}"
                        alt="{{ setting()->title[app()->getLocale() . '_title'] ?? null }}" width="90">
                    &nbsp;{{ setting()->title[app()->getLocale() . '_title'] ?? null }}
                </h4>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    @auth
                        @if (isset(auth()->user()->additionalinfo) &&
                                !empty(auth()->user()->additionalinfo) &&
                                isset(auth()->user()->additionalinfo->company_logo) &&
                                !empty(auth()->user()->additionalinfo->company_logo))
                            <img class="rounded-circle"
                                src="{{ isset(auth()->user()->additionalinfo->company_logo) && !empty(auth()->user()->additionalinfo->company_logo) ? App\Helpers\Helper::getImageUrl(auth()->user()->additionalinfo->company_logo, 'useradditionals') : null }}"
                                alt="{{ auth()->user()->additionalinfo->company_name ?? null }}"
                                style="width: 40px; height: 40px;">
                        @else
                            <img class="rounded-circle"
                                src="{{ isset(auth()->user()->profile_picture) && !empty(auth()->user()->profile_picture) ? App\Helpers\Helper::getImageUrl(auth()->user()->profile_picture, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                                alt="{{ auth()->user()->name_surname ?? null }}" style="width: 40px; height: 40px;">
                        @endif
                    @endauth
                    @guest
                        <img class="rounded-circle"
                            src="{{ isset(setting()->logo) && !empty(setting()->logo) ? App\Helpers\Helper::getImageUrl(setting()->logo, 'settings') : null }}"
                            alt="{{ setting()->title[app()->getLocale() . '_title'] ?? null }}"
                            style="width: 40px; height: 40px;">
                    @endguest
                    <div
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">
                        @auth
                            @if (isset(auth()->user()->additionalinfo) &&
                                    !empty(auth()->user()->additionalinfo) &&
                                    isset(auth()->user()->additionalinfo->company_name) &&
                                    !empty(auth()->user()->additionalinfo->company_name))
                                {{ auth()->user()->additionalinfo->company_name }}
                            @else
                                {{ auth()->user()->name_surname }}
                            @endif
                        @endauth
                        @guest
                            {{ setting()->title[app()->getLocale() . '_title'] ?? null }}
                        @endguest
                    </h6>
                </div>
            </div>
            <div class="navbar-nav w-100">
                @auth

                    @foreach ($services as $service)
                        @if (isset($service) && !empty($service))
                            <div class="nav-item dropdown">
                                <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    @if (isset($service->service->icon) && !empty($service->service->icon))
                                        <span class='menu_icon_area'>
                                            <img src="{{ App\Helpers\Helper::getImageUrl($service->service->icon, 'services') }}"
                                                class="img-fluid img-responsive"
                                                alt="{{ $service->service->name[app()->getLocale() . '_name'] }}">
                                        </span>
                                    @endif
                                    &nbsp;
                                    {{ $service->service->name[app()->getLocale() . '_name'] }}
                                </a>
                                @if (isset($service->service->alt_services) && !empty($service->service->alt_services))
                                    <div class="dropdown-menu bg-transparent border-0">
                                        @foreach ($service->service->alt_services as $alt_service)
                                            @if (App\Helpers\Helper::searchserviceon_menu(Auth::user()->id, $alt_service->id))
                                                <a href="{{ route('services.show', $alt_service->id) }}"
                                                    class="dropdown-item">{{ $alt_service->name[app()->getLocale() . '_name'] }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach

                    @if (auth()->check() &&
                            !empty(auth()->user()) &&
                            !auth()->user()->hasRole('moderator'))
                        <a href="{{ route('payments.index') }}" class="nav-item nav-link"><i
                                class="fa fa-money-bill me-2"></i>@lang('additional.pages.welcome.payments')</a>
                    @endif

                    @if (auth()->user()->hasRole('admin') ||
                            auth()->user()->hasRole('moderator'))
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fa fa-cog me-2"></i>@lang('additional.pages.login.settings')</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ route('services.index') }}" class="dropdown-item">@lang('additional.pages.services.services')</a>
                                @if (auth()->user()->hasRole('admin'))
                                    <a href="{{ route('attributes.index') }}" class="dropdown-item">Atributlar</a>
                                @endif
                                <a href="{{ route('users.index') }}" class="dropdown-item">@lang('additional.pages.users.users')</a>
                                @if (auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admins.index') }}" class="dropdown-item">@lang('additional.pages.users.admins')</a>
                                    <a href="{{ route('standartpages.index') }}"
                                        class="dropdown-item">@lang('additional.urls.standartpages')</a>
                                @endif
                            </div>
                        </div>
                    @endif
                @endauth

            </div>
        </nav>
    </div>
    <!-- Sidebar End -->
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 d-lg-flex d-md-none d-sm-none">
            <a href="{{ route('welcome') }}" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
            </a>
            <a href="javascript:void(0)" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                        style="position: relative;">
                        <i class="fa fa-language me-lg-2"></i>

                        <span class="d-none d-lg-inline-flex">{{ strtoupper(app()->getLocale()) }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">


                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ strtoupper($localeCode) }}
                            </a>
                            <hr class="dropdown-divider">
                        @endforeach

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                        style="position: relative;">
                        <i class="fa fa-bell me-lg-2"></i>
                        @if (isset(auth()->user()->notifications) && !empty(auth()->user()->notifications))
                            <span
                                class="text-right text-danger badge_count">{{ count(auth()->user()->notifications->where('status', false)) }}</span>
                        @endif
                        <span class="d-none d-lg-inline-flex">@lang('additional.pages.welcome.notifications')</span>
                    </a>
                    @if (isset(auth()->user()->notifications) && !empty(auth()->user()->notifications))
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            @foreach (auth()->user()->notifications->where('status', false) as $notification)
                                <a href="{{ route('notifications.show', ['id' => $notification->id]) }}"
                                    class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle"
                                            src="{{ isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null }}"
                                            alt="{{ setting()->title[app()->getLocale() . '_title'] ?? null }}"
                                            style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">{{ $notification->title }}</h6>
                                            @php
                                                \Carbon\Carbon::setLocale(app()->getLocale());
                                            @endphp
                                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                            @endforeach

                            <a href="{{ route('notifications.index') }}"
                                class="dropdown-item text-center">@lang('additional.pages.notifications.allnotifications')</a>
                        </div>
                    @endif
                </div>

                <div class="nav-item dropdown">
                    @auth
                        @if (isset(auth()->user()->additionalinfo) &&
                                !empty(auth()->user()->additionalinfo) &&
                                isset(auth()->user()->additionalinfo->company_logo) &&
                                !empty(auth()->user()->additionalinfo->company_logo))
                            <a href="{{ route('auth.profile') }}" class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2"
                                    src="{{ isset(auth()->user()->additionalinfo->company_logo) && !empty(auth()->user()->additionalinfo->company_logo) ? App\Helpers\Helper::getImageUrl(auth()->user()->additionalinfo->company_logo, 'useradditionals') : null }}"
                                    alt="{{ auth()->user()->additionalinfo->company_name ?? null }}"
                                    style="width: 40px; height: 40px;">
                                <span
                                    class="d-none d-lg-inline-flex">{{ auth()->user()->additionalinfo->company_name ?? null }}</span>
                            </a>
                        @else
                            <a href="{{ route('auth.profile') }}" class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2"
                                    src="{{ isset(auth()->user()->profile_picture) && !empty(auth()->user()->profile_picture) ? App\Helpers\Helper::getImageUrl(auth()->user()->profile_picture, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                                    alt="{{ auth()->user()->name_surname ?? null }}" style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex">{{ auth()->user()->name_surname ?? null }}</span>
                            </a>
                        @endif
                    @endauth
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="{{ route('auth.profile') }}" class="dropdown-item">@lang('additional.pages.login.myprofile')</a>
                        @if (isset(auth()->user()->additionalinfo) &&
                                !empty(auth()->user()->additionalinfo) &&
                                isset(auth()->user()->additionalinfo->company_voen) &&
                                !empty(auth()->user()->additionalinfo->company_voen))
                            <a href="{{ route('voen.show', auth()->user()->additionalinfo->company_voen) }}"
                                class="dropdown-item">VOEN: {{ auth()->user()->additionalinfo->company_voen }}</a>
                        @endif
                        <a href="{{ route('settings') }}" class="dropdown-item">@lang('additional.pages.login.settings')</a>
                        <a href="{{ route('auth.logout') }}" class="dropdown-item">@lang('additional.pages.login.logout')</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
        @if (auth()->check() &&
                !empty(auth()->user()) &&
                !auth()->user()->hasRole('admin') &&
                !auth()->user()->hasRole('moderator'))
            @if (App\Helpers\Helper::getpaidornot(auth()->user()->id))
                <div class="row">
                    <button type="button" class="btn w-100" data-toggle="modal" data-target="#paymentmodal"
                        onclick="paymentmodal('bank')" data-type="bank">
                        <div class="alert alert-warning text-center">@lang('additional.pages.welcome.notpaid')</div>
                    </button>
                </div>
            @endif
        @endif
        <div class="modal" id="paymentmodal" tabindex="-1" role="dialog" aria-labelledby="paymentmodalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-black" style="color:#000;" id="exampleModalLabel">
                            @lang('additional.pages.payment.paynow')</h5>
                        <button onclick="closepaymentmodal()" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-0 m-0 my-2 modal_content_type" id="bank_type_selected">
                            @if (isset(auth()->user()->service_prices['monthly']) && !empty(auth()->user()->service_prices['monthly']))
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <h3 class="text-center" style="color:#000">@lang('additional.forms.monthly')</h3>
                                    <p class="text-muted text-center">
                                        {{ auth()->user()->service_prices['monthly'] ?? null }}₼
                                    </p>
                                    <a href="{{ route('pay.now', ['type' => 'monthly', 'user_id' => auth()->user()->id, 'via' => 'bank']) }}"
                                        class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                            class="fa fa-money-bill"></i> @lang('additional.pages.payment.paynow')</a>
                                </div>
                            @endif
                            @if (isset(auth()->user()->service_prices['yearly']) && !empty(auth()->user()->service_prices['yearly']))
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <h3 class="text-center" style="color:#000">@lang('additional.forms.yearly')</h3>
                                    <p class="text-muted text-center">
                                        {{ auth()->user()->service_prices['yearly'] ?? null }}₼
                                    </p>
                                    <a href="{{ route('pay.now', ['type' => 'yearly', 'user_id' => auth()->user()->id, 'via' => 'bank']) }}"
                                        class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                            class="fa fa-money-bill"></i> @lang('additional.pages.payment.paynow')</a>
                                </div>
                            @endif
                        </div>
                        <div class="row p-0 m-0 my-2 modal_content_type" id="share_type_selected">
                            @if (isset($data) && !empty($data) && isset($data->service_prices) && !empty($data->service_prices))
                                @if (isset($data->service_prices['monthly']) && !empty($data->service_prices['monthly']))
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <h3 class="text-center" style="color:#000">@lang('additional.forms.monthly')</h3>
                                        <p class="text-muted text-center">
                                            {{ $data->service_prices['monthly'] ?? null }}₼
                                        </p>
                                        <a href="{{ route('pay.now', ['type' => 'monthly', 'user_id' => $data->id, 'via' => 'share']) }}"
                                            class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                                class="fa fa-money-bill"></i> @lang('additional.pages.payment.paynow')</a>
                                    </div>
                                @endif
                                @if (isset($data->service_prices['yearly']) && !empty($data->service_prices['yearly']))
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <h3 class="text-center" style="color:#000">@lang('additional.forms.yearly')</h3>
                                        <p class="text-muted text-center">
                                            {{ $data->service_prices['yearly'] ?? null }}₼
                                        </p>
                                        <a href="{{ route('pay.now', ['type' => 'yearly', 'user_id' => $data->id, 'via' => 'share']) }}"
                                            class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                                class="fa fa-money-bill"></i> @lang('additional.pages.payment.paynow')</a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="closepaymentmodal()" type="button" class="btn btn-secondary"
                            data-dismiss="modal">@lang('additional.buttons.close')</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-4 px-4 d-lg-none d-md-block">
            <div class="row g-4">
                @if (str_contains(url()->current(), 'services/'))
                    <div class="col-sm-6 col-xl-3">
                        <a href="{{ route('welcome') }}">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-home fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">@lang('additional.pages.fallback.gohome')</p>
                                    <h6 class="mb-0"> </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @if (isset($service->service->alt_services) && !empty($service->service->alt_services))
                        @foreach ($service->service->alt_services as $alt_service)
                            @if (App\Helpers\Helper::searchserviceon_menu(Auth::user()->id, $alt_service->id))
                                <div class="col-sm-6 col-xl-3">

                                    <a href="{{ route('services.show', $alt_service->id) }}">
                                        <div
                                            class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                            @if (isset($alt_service->icon) && !empty($alt_service->icon))
                                                <span class='menu_icon_area'>
                                                    <img src="{{ App\Helpers\Helper::getImageUrl($alt_service->icon, 'services') }}"
                                                        class="img-fluid img-responsive"
                                                        alt="{{ $alt_service->name[app()->getLocale() . '_name'] }}">
                                                </span>
                                            @endif
                                            <div class="ms-3">
                                                <p class="mb-2">
                                                    {{ $alt_service->name[app()->getLocale() . '_name'] }}
                                                </p>
                                                <h6 class="mb-0"> </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @elseif(str_contains(url()->current(), 'servicenotifications/'))
                    <div class="col-sm-6 col-xl-3">
                        <a href="{{ route('welcome') }}">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-home fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">@lang('additional.pages.fallback.gohome')</p>
                                    <h6 class="mb-0"> </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @else
                    @auth
                        @foreach ($services as $service)
                            @if (isset($service) && !empty($service))
                                <div class="col-sm-6 col-xl-3">
                                    <a href="{{ route('services.show', $service->service_id) }}">
                                        <div
                                            class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                            @if (isset($service->service->icon) && !empty($service->service->icon))
                                                <span class='menu_icon_area'>
                                                    <img src="{{ App\Helpers\Helper::getImageUrl($service->service->icon, 'services') }}"
                                                        class="img-fluid img-responsive"
                                                        alt="{{ $service->service->name[app()->getLocale() . '_name'] }}">
                                                </span>
                                            @endif
                                            <div class="ms-3">
                                                <p class="mb-2">
                                                    {{ $service->service->name[app()->getLocale() . '_name'] }}
                                                </p>
                                                <h6 class="mb-0"> </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    @endauth
                @endif

            </div>
        </div>
@endif
