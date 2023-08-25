<?php if(auth()->check() && isset(auth()->user()->id)): ?>
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
        <nav class="navbar bg-secondary navbar-dark">
            <a href="<?php echo e(route('welcome')); ?>" class="navbar-brand mx-4 mb-3">
                <h4 class="text-primary">
                    <img class="img-responsive img-fluid"
                        src="<?php echo e(isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null); ?>"
                        alt="<?php echo e(setting()->title[app()->getLocale() . '_title'] ?? null); ?>" width="90">
                    &nbsp;<?php echo e(setting()->title[app()->getLocale() . '_title'] ?? null); ?>

                </h4>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(isset(auth()->user()->additionalinfo) &&
                                !empty(auth()->user()->additionalinfo) &&
                                isset(auth()->user()->additionalinfo->company_logo) &&
                                !empty(auth()->user()->additionalinfo->company_logo)): ?>
                            <img class="rounded-circle"
                                src="<?php echo e(isset(auth()->user()->additionalinfo->company_logo) && !empty(auth()->user()->additionalinfo->company_logo) ? App\Helpers\Helper::getImageUrl(auth()->user()->additionalinfo->company_logo, 'useradditionals') : null); ?>"
                                alt="<?php echo e(auth()->user()->additionalinfo->company_name ?? null); ?>"
                                style="width: 40px; height: 40px;">
                        <?php else: ?>
                            <img class="rounded-circle"
                                src="<?php echo e(isset(auth()->user()->profile_picture) && !empty(auth()->user()->profile_picture) ? App\Helpers\Helper::getImageUrl(auth()->user()->profile_picture, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'); ?>"
                                alt="<?php echo e(auth()->user()->name_surname ?? null); ?>" style="width: 40px; height: 40px;">
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <img class="rounded-circle"
                            src="<?php echo e(isset(setting()->logo) && !empty(setting()->logo) ? App\Helpers\Helper::getImageUrl(setting()->logo, 'settings') : null); ?>"
                            alt="<?php echo e(setting()->title[app()->getLocale() . '_title'] ?? null); ?>"
                            style="width: 40px; height: 40px;">
                    <?php endif; ?>
                    <div
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(isset(auth()->user()->additionalinfo) &&
                                    !empty(auth()->user()->additionalinfo) &&
                                    isset(auth()->user()->additionalinfo->company_name) &&
                                    !empty(auth()->user()->additionalinfo->company_name)): ?>
                                <?php echo e(auth()->user()->additionalinfo->company_name); ?>

                            <?php else: ?>
                                <?php echo e(auth()->user()->name_surname); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(auth()->guard()->guest()): ?>
                            <?php echo e(setting()->title[app()->getLocale() . '_title'] ?? null); ?>

                        <?php endif; ?>
                    </h6>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <?php if(auth()->guard()->check()): ?>

                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($service) && !empty($service)): ?>
                            <div class="nav-item dropdown">
                                <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <?php if(isset($service->service->icon) && !empty($service->service->icon)): ?>
                                        <span class='menu_icon_area'>
                                            <img src="<?php echo e(App\Helpers\Helper::getImageUrl($service->service->icon, 'services')); ?>"
                                                class="img-fluid img-responsive"
                                                alt="<?php echo e($service->service->name[app()->getLocale() . '_name']); ?>">
                                        </span>
                                    <?php endif; ?>
                                    &nbsp;
                                    <?php echo e($service->service->name[app()->getLocale() . '_name']); ?>

                                </a>
                                <?php if(isset($service->service->alt_services) && !empty($service->service->alt_services)): ?>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <?php $__currentLoopData = $service->service->alt_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alt_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(App\Helpers\Helper::searchserviceon_menu(Auth::user()->id, $alt_service->id)): ?>
                                                <a href="<?php echo e(route('services.show', $alt_service->id)); ?>"
                                                    class="dropdown-item"><?php echo e($alt_service->name[app()->getLocale() . '_name']); ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(auth()->check() &&
                            !empty(auth()->user()) &&
                            !auth()->user()->hasRole('moderator')): ?>
                        <a href="<?php echo e(route('payments.index')); ?>" class="nav-item nav-link"><i
                                class="fa fa-money-bill me-2"></i><?php echo app('translator')->get('additional.pages.welcome.payments'); ?></a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasRole('admin') ||
                            auth()->user()->hasRole('moderator')): ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fa fa-cog me-2"></i><?php echo app('translator')->get('additional.pages.login.settings'); ?></a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="<?php echo e(route('services.index')); ?>" class="dropdown-item"><?php echo app('translator')->get('additional.pages.services.services'); ?></a>
                                <?php if(auth()->user()->hasRole('admin')): ?>
                                    <a href="<?php echo e(route('attributes.index')); ?>" class="dropdown-item">Atributlar</a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('users.index')); ?>" class="dropdown-item"><?php echo app('translator')->get('additional.pages.users.users'); ?></a>
                                <?php if(auth()->user()->hasRole('admin')): ?>
                                    <a href="<?php echo e(route('admins.index')); ?>" class="dropdown-item"><?php echo app('translator')->get('additional.pages.users.admins'); ?></a>
                                    <a href="<?php echo e(route('standartpages.index')); ?>"
                                        class="dropdown-item"><?php echo app('translator')->get('additional.urls.standartpages'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </nav>
    </div>
    <!-- Sidebar End -->
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 d-md-none d-lg-flex">
            <a href="<?php echo e(route('welcome')); ?>" class="navbar-brand d-flex d-lg-none me-4">
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

                        <span class="d-none d-lg-inline-flex"><?php echo e(strtoupper(app()->getLocale())); ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">


                        <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item"
                                href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
                                <?php echo e(strtoupper($localeCode)); ?>

                            </a>
                            <hr class="dropdown-divider">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                        style="position: relative;">
                        <i class="fa fa-bell me-lg-2"></i>
                        <?php if(isset(auth()->user()->notifications) && !empty(auth()->user()->notifications)): ?>
                            <span
                                class="text-right text-danger badge_count"><?php echo e(count(auth()->user()->notifications->where('status', false))); ?></span>
                        <?php endif; ?>
                        <span class="d-none d-lg-inline-flex"><?php echo app('translator')->get('additional.pages.welcome.notifications'); ?></span>
                    </a>
                    <?php if(isset(auth()->user()->notifications) && !empty(auth()->user()->notifications)): ?>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <?php $__currentLoopData = auth()->user()->notifications->where('status', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('notifications.show', ['id' => $notification->id])); ?>"
                                    class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle"
                                            src="<?php echo e(isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null); ?>"
                                            alt="<?php echo e(setting()->title[app()->getLocale() . '_title'] ?? null); ?>"
                                            style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0"><?php echo e($notification->title); ?></h6>
                                            <?php
                                                \Carbon\Carbon::setLocale(app()->getLocale());
                                            ?>
                                            <small><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <a href="<?php echo e(route('notifications.index')); ?>"
                                class="dropdown-item text-center"><?php echo app('translator')->get('additional.pages.notifications.allnotifications'); ?></a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="nav-item dropdown">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(isset(auth()->user()->additionalinfo) &&
                                !empty(auth()->user()->additionalinfo) &&
                                isset(auth()->user()->additionalinfo->company_logo) &&
                                !empty(auth()->user()->additionalinfo->company_logo)): ?>
                            <a href="<?php echo e(route('auth.profile')); ?>" class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2"
                                    src="<?php echo e(isset(auth()->user()->additionalinfo->company_logo) && !empty(auth()->user()->additionalinfo->company_logo) ? App\Helpers\Helper::getImageUrl(auth()->user()->additionalinfo->company_logo, 'useradditionals') : null); ?>"
                                    alt="<?php echo e(auth()->user()->additionalinfo->company_name ?? null); ?>"
                                    style="width: 40px; height: 40px;">
                                <span
                                    class="d-none d-lg-inline-flex"><?php echo e(auth()->user()->additionalinfo->company_name ?? null); ?></span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('auth.profile')); ?>" class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2"
                                    src="<?php echo e(isset(auth()->user()->profile_picture) && !empty(auth()->user()->profile_picture) ? App\Helpers\Helper::getImageUrl(auth()->user()->profile_picture, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'); ?>"
                                    alt="<?php echo e(auth()->user()->name_surname ?? null); ?>" style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex"><?php echo e(auth()->user()->name_surname ?? null); ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="<?php echo e(route('auth.profile')); ?>" class="dropdown-item"><?php echo app('translator')->get('additional.pages.login.myprofile'); ?></a>
                        <?php if(isset(auth()->user()->additionalinfo) &&
                                !empty(auth()->user()->additionalinfo) &&
                                isset(auth()->user()->additionalinfo->company_voen) &&
                                !empty(auth()->user()->additionalinfo->company_voen)): ?>
                            <a href="<?php echo e(route('voen.show', auth()->user()->additionalinfo->company_voen)); ?>"
                                class="dropdown-item">VOEN: <?php echo e(auth()->user()->additionalinfo->company_voen); ?></a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('settings')); ?>" class="dropdown-item"><?php echo app('translator')->get('additional.pages.login.settings'); ?></a>
                        <a href="<?php echo e(route('auth.logout')); ?>" class="dropdown-item"><?php echo app('translator')->get('additional.pages.login.logout'); ?></a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
        <?php if(auth()->check() &&
                !empty(auth()->user()) &&
                !auth()->user()->hasRole('admin') &&
                !auth()->user()->hasRole('moderator')): ?>
            <?php if(App\Helpers\Helper::getpaidornot(auth()->user()->id)): ?>
                <div class="row">
                    <button type="button" class="btn w-100" data-toggle="modal" data-target="#paymentmodal"
                        onclick="paymentmodal('bank')" data-type="bank">
                        <div class="alert alert-warning text-center"><?php echo app('translator')->get('additional.pages.welcome.notpaid'); ?></div>
                    </button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="modal" id="paymentmodal" tabindex="-1" role="dialog" aria-labelledby="paymentmodalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-black" style="color:#000;" id="exampleModalLabel">
                            <?php echo app('translator')->get('additional.pages.payment.paynow'); ?></h5>
                        <button onclick="closepaymentmodal()" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-0 m-0 my-2 modal_content_type" id="bank_type_selected">
                            <?php if(isset(auth()->user()->service_prices['monthly']) && !empty(auth()->user()->service_prices['monthly'])): ?>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <h3 class="text-center" style="color:#000"><?php echo app('translator')->get('additional.forms.monthly'); ?></h3>
                                    <p class="text-muted text-center">
                                        <?php echo e(auth()->user()->service_prices['monthly'] ?? null); ?>₼
                                    </p>
                                    <a href="<?php echo e(route('pay.now', ['type' => 'monthly', 'user_id' => auth()->user()->id, 'via' => 'bank'])); ?>"
                                        class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                            class="fa fa-money-bill"></i> <?php echo app('translator')->get('additional.pages.payment.paynow'); ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if(isset(auth()->user()->service_prices['yearly']) && !empty(auth()->user()->service_prices['yearly'])): ?>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <h3 class="text-center" style="color:#000"><?php echo app('translator')->get('additional.forms.yearly'); ?></h3>
                                    <p class="text-muted text-center">
                                        <?php echo e(auth()->user()->service_prices['yearly'] ?? null); ?>₼
                                    </p>
                                    <a href="<?php echo e(route('pay.now', ['type' => 'yearly', 'user_id' => auth()->user()->id, 'via' => 'bank'])); ?>"
                                        class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                            class="fa fa-money-bill"></i> <?php echo app('translator')->get('additional.pages.payment.paynow'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row p-0 m-0 my-2 modal_content_type" id="share_type_selected">
                            <?php if(isset($data) && !empty($data) && isset($data->service_prices) && !empty($data->service_prices)): ?>
                                <?php if(isset($data->service_prices['monthly']) && !empty($data->service_prices['monthly'])): ?>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <h3 class="text-center" style="color:#000"><?php echo app('translator')->get('additional.forms.monthly'); ?></h3>
                                        <p class="text-muted text-center">
                                            <?php echo e($data->service_prices['monthly'] ?? null); ?>₼
                                        </p>
                                        <a href="<?php echo e(route('pay.now', ['type' => 'monthly', 'user_id' => $data->id, 'via' => 'share'])); ?>"
                                            class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                                class="fa fa-money-bill"></i> <?php echo app('translator')->get('additional.pages.payment.paynow'); ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($data->service_prices['yearly']) && !empty($data->service_prices['yearly'])): ?>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <h3 class="text-center" style="color:#000"><?php echo app('translator')->get('additional.forms.yearly'); ?></h3>
                                        <p class="text-muted text-center">
                                            <?php echo e($data->service_prices['yearly'] ?? null); ?>₼
                                        </p>
                                        <a href="<?php echo e(route('pay.now', ['type' => 'yearly', 'user_id' => $data->id, 'via' => 'share'])); ?>"
                                            class="btn btn-primary w-100 btn-block text-center align-center mx-auto"><i
                                                class="fa fa-money-bill"></i> <?php echo app('translator')->get('additional.pages.payment.paynow'); ?></a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="closepaymentmodal()" type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo app('translator')->get('additional.buttons.close'); ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-4 px-4 d-lg-none d-md-block">
            <div class="row g-4">
                <?php if(str_contains(url()->current(), 'services/')): ?>
                    <div class="col-sm-6 col-xl-3">
                        <a href="<?php echo e(route('welcome')); ?>">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-home fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2"><?php echo app('translator')->get('additional.pages.fallback.gohome'); ?></p>
                                    <h6 class="mb-0"> </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php if(isset($service->service->alt_services) && !empty($service->service->alt_services)): ?>
                        <?php $__currentLoopData = $service->service->alt_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alt_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(App\Helpers\Helper::searchserviceon_menu(Auth::user()->id, $alt_service->id)): ?>
                                <div class="col-sm-6 col-xl-3">

                                    <a href="<?php echo e(route('services.show', $alt_service->id)); ?>">
                                        <div
                                            class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                            <?php if(isset($alt_service->icon) && !empty($alt_service->icon)): ?>
                                                <span class='menu_icon_area'>
                                                    <img src="<?php echo e(App\Helpers\Helper::getImageUrl($alt_service->icon, 'services')); ?>"
                                                        class="img-fluid img-responsive"
                                                        alt="<?php echo e($alt_service->name[app()->getLocale() . '_name']); ?>">
                                                </span>
                                            <?php endif; ?>
                                            <div class="ms-3">
                                                <p class="mb-2">
                                                    <?php echo e($alt_service->name[app()->getLocale() . '_name']); ?>

                                                </p>
                                                <h6 class="mb-0"> </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php elseif(str_contains(url()->current(), 'servicenotifications/')): ?>
                    <div class="col-sm-6 col-xl-3">
                        <a href="<?php echo e(route('welcome')); ?>">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-home fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2"><?php echo app('translator')->get('additional.pages.fallback.gohome'); ?></p>
                                    <h6 class="mb-0"> </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php else: ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($service) && !empty($service)): ?>
                                <div class="col-sm-6 col-xl-3">
                                    <a href="<?php echo e(route('services.show', $service->service_id)); ?>">
                                        <div
                                            class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                            <?php if(isset($service->service->icon) && !empty($service->service->icon)): ?>
                                                <span class='menu_icon_area'>
                                                    <img src="<?php echo e(App\Helpers\Helper::getImageUrl($service->service->icon, 'services')); ?>"
                                                        class="img-fluid img-responsive"
                                                        alt="<?php echo e($service->service->name[app()->getLocale() . '_name']); ?>">
                                                </span>
                                            <?php endif; ?>
                                            <div class="ms-3">
                                                <p class="mb-2">
                                                    <?php echo e($service->service->name[app()->getLocale() . '_name']); ?>

                                                </p>
                                                <h6 class="mb-0"> </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
<?php endif; ?>
<?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/layouts/partials/header.blade.php ENDPATH**/ ?>