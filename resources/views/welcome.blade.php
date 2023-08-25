@extends('layouts.app')

@if (auth()->check() &&
        auth()->user()->hasRole('admin'))

    @push('js')
        <script>
            // Arama kutusu
            var input = document.getElementById("searchInput");

            // Tablo
            var table = document.getElementById("example");

            // Tablodaki tüm satırları al
            var rows = table.getElementsByTagName("tr");

            // Arama işlemi gerçekleştirilirken döngüde kullanılacak olan değişken
            var i, j;

            // Her bir karakter girildiğinde arama işlemi gerçekleştirilir
            input.addEventListener("keyup", function() {
                // Arama kutusundaki değeri al
                var filter = input.value.toUpperCase();

                // Tablodaki her satırın içeriğini kontrol et
                for (i = 0; i < rows.length; i++) {
                    // Her satırdaki sütunları al
                    var cells = rows[i].getElementsByTagName("td");

                    // Satırda aranan kelimeye uyan sütun var mı kontrol et
                    var found = false;
                    for (j = 0; j < cells.length; j++) {
                        // Sütun içeriğini al ve büyük/küçük harf duyarlılığını kaldır
                        var cellContent = cells[j].textContent || cells[j].innerText;
                        cellContent = cellContent.toUpperCase();

                        // Aranan kelimeye uyan sütun varsa satırı göster, yoksa gizle
                        if (cellContent.indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }

                    // Satırın görünürlüğünü ayarla
                    rows[i].style.display = found ? "" : "none";
                }
            });
        </script>
    @endpush
@endif

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            @foreach ($services_home as $service)
                <div class="col-sm-6 col-xl-3">
                    <a href="{{ route('services.show', $service->service->id) }}">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            @if (isset($service->service->icon) && !empty($service->service->icon))
                                <img class='img-fluid img-responsive'
                                    src="{{ App\Helpers\Helper::getImageUrl($service->service->icon, 'services') }}" />
                            @endif
                            <div class="ms-3">
                                <p class="mb-2">{{ $service->service->name[app()->getLocale() . '_name'] }}</p>
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Sales Chart Start -->
    @if (auth()->check() &&
            auth()->user()->hasRole('admin'))
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg 6 mx-auto">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="searchInput" placeholder="Arama yap...">
                        </div>
                    </div>
                </div>
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4"><a href="{{ route('users.create') }}" class="btn btn-success"><i
                                class="fa fa-plus"></i></a>
                    </h6>

                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('additional.forms.profile_picture')</th>
                                    <th scope="col">@lang('additional.forms.fincode')</th>
                                    <th scope="col">@lang('additional.forms.username')</th>
                                    <th scope="col">@lang('additional.pages.login.company_information')</th>
                                    <th scope="col">@lang('additional.forms.status')</th>
                                    <th scope="col">@lang('additional.forms.buttons')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (users()->where('is_admin', false) as $dat)
                                    <tr>
                                        <td>
                                            @if (isset($dat->additionalinfo->company_logo) && !empty($dat->additionalinfo->company_logo))
                                                <img src="{{ App\Helpers\Helper::getImageUrl($dat->additionalinfo->company_logo, 'useradditionals') }}"
                                                    alt="{{ $dat->name_surname }}" class="img-fluid img-responsive"
                                                    width="50">
                                            @elseif(isset($dat->profile_picture) && !empty($dat->profile_picture))
                                                <img src="{{ App\Helpers\Helper::getImageUrl($dat->profile_picture, 'useradditionals') }}"
                                                    alt="{{ $dat->name_surname }}" class="img-fluid img-responsive"
                                                    width="50">
                                            @endif
                                        </td>
                                        <td>{{ $dat->fin_code }}</td>
                                        <td>{{ $dat->name_surname }}</td>
                                        <td>{{ !empty($dat->additionalinfo) && isset($dat->additionalinfo->company_name)
                                            ? $dat->additionalinfo->company_name
                                            : trans('additional.pages.login.notacompany') }}
                                            {!! !empty($dat->additionalinfo) && isset($dat->additionalinfo->company_voen)
                                                ? ' <br/>VOEN: ' . $dat->additionalinfo->company_voen
                                                : null !!}
                                        </td>
                                        <td
                                            @if ($dat->status == true) class="text-success" @else class="text-danger" @endif>
                                            @lang('additional.pages.login.status_' . intval($dat->status))
                                        </td>

                                        <td>@include('layouts.partials.table_buttons', [
                                            'edit' => true,
                                            'view' => true,
                                            'url' => 'users',
                                            'delete' => false,
                                            'id' => $dat->id,
                                        ])</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Sales Chart End -->

    {{-- <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Salse</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">
                                <input class="form-check-input" type="checkbox" />
                            </th>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="checkbox" /></td>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Messages</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Calender</h6>
                        <a href="">Show All</a>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">To Do List</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="d-flex mb-2">
                        <input class="form-control bg-dark border-0" type="text" placeholder="Enter task" />
                        <button type="button" class="btn btn-primary ms-2">
                            Add
                        </button>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox" checked />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span><del>Short task goes here...</del></span>
                                <button class="btn btn-sm text-primary">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-2">
                        <input class="form-check-input m-0" type="checkbox" />
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Widgets End --> --}}
    <div class="container-fluid pt-4 px-0 d-lg-block" style="margin-left:-10px">
        <iframe src="https://e-work.icu/ework_login_app/A.html" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; min-height:460px;max-height:1000px" allowtransparency="true" class="banner"></iframe>
           <!-- Widgets End -->


            <!-- Widgets Start -->
                   <iframe src="https://e-work.icu/ework_login_app/B.html" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; min-height:460px;max-height:1000px" allowtransparency="true" class="banner"></iframe>
   </div>
@endsection
