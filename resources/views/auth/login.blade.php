<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Globalmart Group MMC">

    <title>@lang('additional.urls.login')</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;1,400&display=swap"
        rel="stylesheet">

    <link href="https://ework.az/system-2/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://ework.az/system-2/css/bootstrap-icons.css" rel="stylesheet">

    <link href="https://ework.az/system-2/css/tooplate-e-work.css" rel="stylesheet">
    {!! Biscolab\ReCaptcha\Facades\ReCaptcha::htmlScriptTagJsApi() !!}

    <script language=javascript>
        function clickIE() {
            if (document.all) {
                (message);
                return false;
            }
        }

        function clickNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    (message);
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = clickNS;
        } else {
            document.onmouseup = clickNS;
            document.oncontextmenu = clickIE;
        }
        document.oncontextmenu = new Function("return false")
    </script>


    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <header class="site-header">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i></i>
                        eWork Azerbaijan
                    </p>

                    <p class="d-flex me-4 mb-0">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item"
                                @if (app()->getLocale() == $localeCode) style="border-bottom:1px solid red;" @endif
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ strtoupper($localeCode) }}
                            </a>
                        @endforeach
                    </p>


                    <p class="d-flex d-lg-block d-md-block d-none me-4 mb-0">
                        <i></i>
                        <strong>Bazar ertəsi - Cümə</strong> 9:00 AM - 6:30 PM
                    </p>

                    <p class="site-header-icon-wrap text-white d-flex mb-0 ms-auto">
                        <i></i>

                        <a href="https://api.whatsapp.com/send?phone=994505002942" class="text-white" target="_blank">
                            050 500 29 42 </a>
                    </p>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="https://ework.az/index.php">
                <img src="https://ework.az/system-2/images/e-work.png" class="logo img-fluid" alt="">

                <span class="ms-2">eWork Azerbaijan</span> </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                    <li class="nav-item">
                        <a class="nav-link" href="https://ework.az/index.php">@lang('additional.urls.welcome')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://ework.az/contact.php">@lang('additional.urls.contactus')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://ework.az/e-translate.php">@lang('additional.urls.etranslate')</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">@lang('additional.urls.jobannouncements')<i
                                class="fas fa-sort-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                            <a class="dropdown-item"
                                href="https://ework.az/services/job-search/job-post.php">@lang('additional.urls.jobannouncements')</a>
                            <a class="dropdown-item"
                                href="https://ework.az/services/job-search/job-seekers.php">@lang('additional.urls.searchingjob')</a>
                            <a class="dropdown-item"
                                href="https://ework.az/services/job-search/job-cv.php">@lang('additional.urls.createyourcv')</a>
                        </div>
                    </li>


                    <li class="nav-item ms-3">
                        <a class="nav-link custom-btn custom-border-btn custom-btn-bg-white btn"
                            href="{{ url()->current() }}">@lang('additional.urls.logintheplatform')</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <section class="banner-section d-flex justify-content-center align-items-end">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-7 col-12">
                        <h1 class="text-white mb-lg-0">@lang('additional.urls.loginpersonalaccount')</h1>
                    </div>

                    <div class="col-lg-4 col-12 d-flex justify-content-lg-end align-items-center ms-auto">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a
                                        href="https://ework.az/index.php">@lang('additional.urls.welcome')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('additional.urls.loginpersonalaccount')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-5 col-12 me-auto mb-lg-0 mb-5">
                        <iframe src="https://ework.az/ework/access_text.php" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; min-height:460px;max-height:1000px" allowtransparency="true" class="banner"></iframe>
                    </div>

                    <div class="col-lg-6 col-12">
                        <form onsubmit="submitform()" id="loginform"
                            class="custom-form consulting-form bg-white shadow-lg mb-5 mb-lg-0" method="post"
                            role="form">
                            @csrf
                            <div class="consulting-form-header d-flex align-items-center">
                                <h3 class="mb-4">@lang('additional.urls.loginpersonalaccount'):</h3>
                            </div>

                            <div class="consulting-form-body">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <input type="text" name="fin_code" id="volunteer-shexsiyyet-2"
                                            class="form-control" placeholder="@lang('additional.forms.fincode')" required>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <input type="text" name="phone" id="volunteer-phone"
                                            class="form-control" placeholder="@lang('additional.forms.phone')" required>
                                    </div>
                                </div>

                                <select class="form-select form-control" name="Services" id="Services"
                                    aria-label="Default select example">
                                    <option selected>@lang('additional.urls.servicetype')</option>
                                    <option value="1-Sahibkarlara Xidmət">@lang('additional.urls.servicesahibkar')</option>
                                    <option value="2-Bizness və Ticarət Hazırlığı">@lang('additional.urls.biznesveticaret')
                                    </option>
                                    <option value="3-Peşə Hazırlığı">@lang('additional.urls.pesehazirliq')</option>
                                    <option value="4-Xaricdə Təhsil">@lang('additional.urls.xaricdetehsil')</option>
                                </select>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="password" name="password" id="volunteer-şifrə-2"
                                        class="form-control" placeholder="@lang('additional.forms.password')" required>
                                </div>

                                <div class="form-floating mb-4">
                                    {!! htmlFormSnippet([
                                        'theme' => 'light',
                                        'size' => 'normal',
                                        'tabindex' => '3',
                                        'callback' => 'callbackFunction',
                                        'expired-callback' => 'expiredCallbackFunction',
                                        'error-callback' => 'errorCallbackFunction',
                                    ]) !!}
                                </div>
                                <div class="container-login100-form-btn p-t-10">
                                    <div class="col-lg-6 col-md-10 col-8 mx-auto">
                                        <button type="submit" class="form-control">@lang('additional.urls.loginpersonalaccount')</button>
                                    </div>
                        </form>
                    </div>


                    <form class="custom-form consulting-form bg-white shadow-lg my-4 mb-2 mb-lg-0"
                        action="https://ework.az/ework/register.php" method="post" role="form">


                        <div class="consulting-form-body">
                            <div class="row">

                                <div class="container-login100-form-btn p-t-10">
                                    <div class="col-lg-6 col-md-10 col-8 mx-auto">
                                        <button type="submit" class="form-control">@lang('additional.urls.register')</button>
                                    </div>
                    </form>
                </div>

                <!--

eWork Azerbaijan

-->

            </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">


            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <p class="copyright-text mb-0">Bütün Hüquqlar Qorunur © 2023 eWork., Azerbaijan.</p>
                        </div>

                        <div class="col-lg-6 col-12 text-end">
                            <p class="copyright-text mb-0">
                                &copy; <a href="https://globalmart.az">Globalmart Group MMC</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="https://ework.az/system-2/js/jquery.min.js"></script>
    <script src="https://ework.az/system-2/js/bootstrap.min.js"></script>
    <script src="https://ework.az/system-2/js/jquery.backstretch.min.js"></script>
    <script src="https://ework.az/system-2/js/counter.js"></script>
    <script src="https://ework.az/system-2/js/countdown.js"></script>
    <script src="https://ework.az/system-2/js/init.js"></script>
    <script src="https://ework.az/system-2/js/modernizr.js"></script>
    <script src="https://ework.az/system-2/js/animated-headline.js"></script>
    <script src="https://ework.az/system-2/js/custom.js"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}" type="text/javascript"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        @if (Session::has('message'))
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>
    <script>
        function showalertmessage(message, type) {
            if (message != null && message.length > 0) {
                if (type == "success") {
                    toastr.success(message);
                } else if (type == "error") {
                    toastr.error(message);
                } else if (type == "info") {
                    toastr.info(message);
                } else if (type == "warning") {
                    toastr.warning(message);
                }
            }
        }
    </script>
    <script>
        function submitform() {
            event.preventDefault();
            $.ajax({
                url: "{{ route('auth.login') }}",
                dataType: 'json',
                data: $("form#loginform").serialize(),
                headers: {
                    "X-CSRFToken": $("input[name=_token]").val(),
                },
                type: 'post',
                success: function(data) {
                    showalertmessage(data.message, data.status);
                    // if (data.verification != null && data.verification == false) {
                    //     $("div#codePhone").modal("show");
                    // }

                    if (data.redirect != null && data.redirect.length > 0) {
                        window.location.href = data.redirect;
                    }
                },
                error: function(data) {
                    showalertmessage(data.message, data.status);
                }
            });
        }
    </script>
</body>

</html>
