<?php $__env->startSection('title'); ?>
    <?php if(isset($data) && !empty($data)): ?>
        <?php echo e($data->name_surname); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
    <?php else: ?>
        <?php echo app('translator')->get('additional.pages.users.users'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        function deletedevice(id) {
            event.preventDefault();
            var posting = $.ajax({
                url: '<?php echo e(route('auth.deletedevice')); ?>',
                dataType: 'json',
                data: {
                    device_id: id,
                },
                type: 'delete',
                success: function(data) {
                    showalertmessage(data.message, data.status);
                },
                error: function(data) {
                    showalertmessage(data.message, data.status);
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        <?php if(isset($data) && !empty($data)): ?>
                            <?php echo e($data->name_surname); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->get('additional.pages.users.users'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
                        <?php endif; ?> &nbsp;
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            <?php if(isset($data) && !empty($data)): ?> action="<?php echo e(route('users.update', $data->id)); ?>" <?php else: ?> action="<?php echo e(route('users.store')); ?>" <?php endif; ?>
                            method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($data) && !empty($data)): ?>
                                <?php echo method_field('PATCH'); ?>
                            <?php endif; ?>
                            <div class="row">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true">Şəxsi məlumatlar</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">Şirkət Məlumatlar</button>
                                        <?php if(isset($data) &&
                                                !empty($data) &&
                                                auth()->user()->hasRole('admin')): ?>
                                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-contact" type="button" role="tab"
                                                aria-controls="nav-contact" aria-selected="false">Xidmətlər</button>

                                            <button class="nav-link" id="nav-devices-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-devices" type="button" role="tab"
                                                aria-controls="nav-devices" aria-selected="false">Cihazlar</button>
                                            <button class="nav-link" id="nav-payments-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-payments" type="button" role="tab"
                                                aria-controls="nav-payments" aria-selected="false">Ödənişlər</button>
                                        <?php endif; ?>
                                    </div>
                                </nav>
                                <div class="tab-content pt-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label for="exampleInputAZNAME"
                                                        class="form-label"><?php echo app('translator')->get('additional.forms.username'); ?></label>
                                                    <input type="text" class="form-control" id="exampleInputAZNAME"
                                                        name="name_surname"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->name_surname) && !empty(trim($data->name_surname)) ? $data->name_surname : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.fincode'); ?></label>
                                                    <input type="text" class="form-control" name="fin_code"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->fin_code) && !empty(trim($data->fin_code)) ? $data->fin_code : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.email'); ?></label>
                                                    <input type="text" class="form-control" name="email"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->email) && !empty(trim($data->email)) ? $data->email : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.phone'); ?></label>
                                                    <input type="text" class="form-control" name="phone"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->phone) && !empty(trim($data->phone)) ? $data->phone : null); ?>">
                                                    <span class="w-100 text-center text-muted">0501112233</span>
                                                </div>
                                            </div>
                                            <?php if(auth()->check() &&
                                                    auth()->user()->hasRole('admin')): ?>
                                                <div class="col-sm-6 col-md-4 col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label"><?php echo app('translator')->get('additional.forms.monthly'); ?>
                                                            <?php echo app('translator')->get('additional.forms.amount'); ?></label>
                                                        <input type="text" class="form-control"
                                                            name="service_price_monthly"
                                                            value="<?php echo e(isset($data) && !empty($data) && !empty($data->service_prices) && isset($data->service_prices['monthly']) ? $data->service_prices['monthly'] : 0); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-4 col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label"><?php echo app('translator')->get('additional.forms.yearly'); ?>
                                                            <?php echo app('translator')->get('additional.forms.amount'); ?></label>
                                                        <input type="text" class="form-control"
                                                            name="service_price_yearly"
                                                            value="<?php echo e(isset($data) && !empty($data) && !empty($data->service_prices) && isset($data->service_prices['yearly']) ? $data->service_prices['yearly'] : 0); ?>">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.status'); ?></label>
                                                    <select name="status" class="form-control">
                                                        <option value="1"
                                                            <?php if(isset($data) && !empty($data) && $data->status == 1): ?> selected <?php endif; ?>>
                                                            <?php echo app('translator')->get('additional.pages.login.status_1'); ?></option>
                                                        <option value="0"
                                                            <?php if(isset($data) && !empty($data) && $data->status == 0): ?> selected <?php endif; ?>>
                                                            <?php echo app('translator')->get('additional.pages.login.status_0'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.profile_picture'); ?></label>
                                                    <?php if(isset($data) && !empty($data) && isset($data->profile_picture) && !empty($data->profile_picture)): ?>
                                                        <img src="<?php echo e(App\Helpers\Helper::getImageUrl($data->profile_picture, 'useradditionals')); ?>"
                                                            alt="<?php echo e($data->name_surname ?? null); ?>"
                                                            class="img-fluid img-responsive">
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control" name="profile_picture">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.pages.users.company_name'); ?></label>
                                                    <input type="text" class="form-control" name="company_name"
                                                        value="<?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_name) && !empty(trim($data->additionalinfo->company_name)) ? $data->additionalinfo->company_name : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">VOEN</label>
                                                    <input type="text" class="form-control" name="company_voen"
                                                        value="<?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_voen) && !empty(trim($data->additionalinfo->company_voen)) ? $data->additionalinfo->company_voen : null); ?>">
                                                </div>
                                            </div>
                                            <?php if(auth()->user()->hasRole('admin')): ?>
                                                <div class="col-sm-6 col-md-4 col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label"><?php echo app('translator')->get('additional.forms.password'); ?></label>
                                                        <input type="text" class="form-control"
                                                            name="original_password"
                                                            value="<?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->original_password) && !empty(trim($data->additionalinfo->original_password)) ? $data->additionalinfo->original_password : null); ?>">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.content'); ?></label>
                                                    <textarea rows="5" class="form-control" name="company_description"><?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_description) && !empty(trim($data->additionalinfo->company_description)) ? $data->additionalinfo->company_description : null); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.company_owner_name'); ?></label>
                                                    <input type="text" class="form-control" name="company_owner_name"
                                                        value="<?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_owner_name) && !empty(trim($data->additionalinfo->company_owner_name)) ? $data->additionalinfo->company_owner_name : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.company_legal_owner'); ?></label>
                                                    <input type="text" class="form-control" name="company_legal_owner"
                                                        value="<?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_legal_owner) && !empty(trim($data->additionalinfo->company_legal_owner)) ? $data->additionalinfo->company_legal_owner : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.company_version'); ?></label>
                                                    <select name="company_version" class="form-control">
                                                        <option <?php if(isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                !isset($data->additionalinfo->company_version) &&
                                                                empty($data->additionalinfo->company_version)): ?> selected <?php endif; ?>
                                                            value=""><?php echo app('translator')->get('additional.forms.company_version'); ?></option>
                                                        <option <?php if(isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'fzk'): ?> selected <?php endif; ?>
                                                            value="fzk">Fiziki şəxs (Fərdi Sahibkar)</option>
                                                        <option <?php if(isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'mmc'): ?> selected <?php endif; ?>
                                                            value="mmc">MMC (Məhdud Məsuliyyətli Cəmiyyət)</option>
                                                        <option <?php if(isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'asc'): ?> selected <?php endif; ?>
                                                            value="asc">ASC (Açıq Səhmdar Cəmiyyət)</option>
                                                        <option <?php if(isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'qsc'): ?> selected <?php endif; ?>
                                                            value="qsc">QSC (Qapalı Səhmdar Cəmiyyət)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.registry_date'); ?>:</label>
                                                    <input type="date" class="form-control" name="registry_date"
                                                        value="<?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo['registry_date']) && !empty(trim($data->additionalinfo['registry_date'])) ? date('Y-m-d', strtotime($data->additionalinfo['registry_date'])) : null); ?>">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.company_logo'); ?></label>
                                                    <?php if(isset($data) &&
                                                            !empty($data) &&
                                                            !empty($data->additionalinfo) &&
                                                            isset($data->additionalinfo->company_logo) &&
                                                            !empty($data->additionalinfo->company_logo)): ?>
                                                        <img src="<?php echo e(App\Helpers\Helper::getImageUrl($data->additionalinfo->company_logo, 'useradditionals')); ?>"
                                                            alt="<?php echo e($data->company_name ?? null); ?>"
                                                            class="img-fluid img-responsive">
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control" name="company_logo">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.activity_area'); ?></label>
                                                    <textarea rows="5" class="form-control" name="activity_area"><?php echo e(isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->activity_area) && !empty(trim($data->additionalinfo->activity_area)) ? $data->additionalinfo->activity_area : null); ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="row">
                                            <?php $__currentLoopData = $services_a; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-sm-4 col-md-3 col-lg-3">
                                                    <?php if(isset($service->showondashboard) && $service->showondashboard == true): ?>
                                                        <h4><?php echo app('translator')->get('additional.forms.showondashboard'); ?></h4>
                                                    <?php endif; ?>
                                                    <div class="form-check">
                                                        <label class="form-check-label"
                                                            for="services-<?php echo e($service->id); ?>"><?php echo e($service->name['az_name']); ?></label>
                                                        <input type="checkbox" name="services[]"
                                                            <?php if(isset($data) && !empty($data) && $data->services->where('service_id', $service->id)->first() != null): ?> checked <?php endif; ?>
                                                            class="form-check-input" value="<?php echo e($service->id); ?>"
                                                            id="services-<?php echo e($service->id); ?>">

                                                    </div>
                                                    <?php if(!empty($service->alt_services) && count($service->alt_services) > 0): ?>
                                                        <ul>
                                                            <?php $__currentLoopData = $service->alt_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alt_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="form-check">
                                                                    <label class="form-check-label"
                                                                        for="services-<?php echo e($alt_service->id); ?>"><?php echo e($alt_service->name['az_name']); ?></label>
                                                                    <input type="checkbox" name="services[]"
                                                                        <?php if(isset($data) && !empty($data) && $data->services->where('service_id', $alt_service->id)->first() != null): ?> checked <?php endif; ?>
                                                                        class="form-check-input"
                                                                        value="<?php echo e($alt_service->id); ?>"
                                                                        id="services-<?php echo e($alt_service->id); ?>">

                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <?php if(isset($data) &&
                                            !empty($data) &&
                                            auth()->user()->hasRole('admin')): ?>
                                        <div class="tab-pane fade" id="nav-devices" role="tabpanel"
                                            aria-labelledby="nav-devices-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="devices">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">IpAddress</th>
                                                            <th scope="col">Device</th>
                                                            <th scope="col">Adres</th>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $data->devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo e($dat->ipaddress); ?>

                                                                </td>
                                                                <td>
                                                                    <?php if(!empty($dat->device_data)): ?>
                                                                        Device: <?php echo e($dat->device_data['device']); ?> --OS:
                                                                        <?php echo e($dat->device_data['platform']); ?> --Browser
                                                                        <?php echo e($dat->device_data['browser']); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if(!empty($dat->address_data)): ?>
                                                                        City:<?php echo e($dat->address_data['geoplugin_city']); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td
                                                                    <?php if($dat->status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                                                    <?php echo app('translator')->get('additional.pages.login.status_' . intval($dat->status)); ?>
                                                                </td>

                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-block"
                                                                        onclick="deletedevice('<?php echo e($dat->id); ?>')"><i
                                                                            class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-payments" role="tabpanel"
                                            aria-labelledby="nav-devices-tab">
                                            <?php if(App\Helpers\Helper::getpaidornot($data->id)): ?>
                                                <button type="button" class="btn w-100" data-toggle="modal"
                                                    data-target="#paymentmodal" onclick="paymentmodal('share')"
                                                    data-type="share">
                                                    <div class="alert alert-warning text-center"><?php echo app('translator')->get('additional.pages.welcome.notpaid'); ?></div>
                                                </button>
                                            <?php endif; ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="payments">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.amount'); ?></th>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.payment_time'); ?></th>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.payment_end_time'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($dat->amount); ?>₼</td>
                                                                <td
                                                                    <?php if($dat->payment_status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                                                    <?php echo app('translator')->get('additional.pages.payments.status_' . intval($dat->payment_status)); ?>
                                                                </td>

                                                                <td><?php echo e($dat->created_at); ?>

                                                                </td>
                                                                <td><?php echo e($dat->end_time); ?>

                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row my-2">
                                <button class="btn btn-primary btn-block"><?php echo app('translator')->get('additional.buttons.confirmation'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/users/create_edit.blade.php ENDPATH**/ ?>