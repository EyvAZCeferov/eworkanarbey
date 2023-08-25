<?php $__env->startSection('title'); ?>
    <?php echo e($data->name_surname); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        function uploadnewphoto(input) {
            event.preventDefault();
            var formData = new FormData();
            formData.append('profile_photo', input.files[0]);

            $.ajax({
                url: '<?php echo e(route('auth.updateprofile')); ?>',
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function(data) {
                    showalertmessage(data.message, data.status);
                    window.location.href = "<?php echo e(url()->current()); ?>"

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
        <div class="bg-secondary rounded p-4">

            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <img class="rounded-circle" id="profile_photo"
                        src="<?php echo e(isset($data->profile_picture) && !empty($data->profile_picture) ? App\Helpers\Helper::getImageUrl($data->profile_picture, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'); ?>"
                        alt="<?php echo e($data->name_surname ?? null); ?>" style="width: 200px; height: 200px;">
                    <div class="my-2" style="position:relative;width:100%;
                            height:30px">
                        <label style="z-index: 11" class="btn btn-warning text-center" for="selectnewimage"><i
                                class="fa fa-edit"></i> <?php echo app('translator')->get('additional.pages.login.chagephoto'); ?></label>
                        <input type="file"
                            style="position: absolute;z-index:2;
                                top:0;left:0;
                                right:0;
                                bottom:0;
                                width:100%;
                                height:100%;opacity:0"
                            id="selectnewimage" name="profile_picture" onchange="uploadnewphoto(this)">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-">
                    <h3><?php echo e($data->name_surname); ?></h3>
                    <p><?php echo app('translator')->get('additional.forms.fincode'); ?>: <?php echo e($data->fin_code); ?></p>
                    <p><?php echo app('translator')->get('additional.forms.phone'); ?>: <?php echo e($data->phone); ?></p>
                    <p><?php echo app('translator')->get('additional.forms.email'); ?>: <?php echo e($data->email); ?></p>
                    <p><?php echo app('translator')->get('additional.forms.status'); ?>: <span
                            class="<?php if($data->status == 1): ?> text-success <?php else: ?> text-danger <?php endif; ?> "><?php echo app('translator')->get('additional.pages.login.status_' . intval($data->status)); ?></span>
                    </p>
                </div>
            </div>

            <br>
            <div class="row my-3 mt-4">
                <h6 class="mb-4"><?php echo app('translator')->get('additional.pages.login.company_information'); ?></h6>
            </div>

            
            <?php if(isset($data->additionalinfo) && !empty($data->additionalinfo)): ?>
                <div class="row my-3">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <img class="rounded-circle" id="profile_photo"
                            src="<?php echo e(isset($data->additionalinfo->company_logo) && !empty($data->additionalinfo->company_logo) ? App\Helpers\Helper::getImageUrl($data->additionalinfo->company_logo, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'); ?>"
                            alt="<?php echo e($data->additionalinfo->company_name ?? null); ?>" style="width: 200px; height: 200px;">

                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-">
                        <h3><?php echo e($data->additionalinfo->company_name ?? null); ?></h3>
                        <p><b><?php echo app('translator')->get('additional.forms.description'); ?></b>: <?php echo e($data->additionalinfo->company_description ?? null); ?></p>
                        <p>VOEN: <?php echo e($data->additionalinfo->company_voen ?? null); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            
            <br>
            <div class="row my-3 mt-4">
                <h6 class="mb-4"><?php echo app('translator')->get('additional.pages.welcome.notifications'); ?></h6>
                <div class="table-responsive">
                    <table class="table table-hover" id="notifications">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('additional.forms.title'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('additional.forms.content'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('additional.forms.via'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($data->notifications) && !empty($data->notifications)): ?>
                                <?php $__currentLoopData = $data->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($notification->title); ?></td>
                                        <td><?php echo $notification->body; ?></td>
                                        <td
                                            <?php if($notification->status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                            <?php echo app('translator')->get('additional.pages.notifications.readed_' . intval($notification->status)); ?>
                                        </td>
                                        <td>
                                            <?php if($notification->via == 1): ?>
                                                E-mail
                                            <?php else: ?>
                                                Sms
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $__env->make('layouts.partials.table_buttons', [
                                            'edit' => false,
                                            'view' => true,
                                            'url' => 'notifications',
                                            'delete' => false,
                                            'id' => $notification->id,
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row my-3 mt-4">
                <h6 class="mb-4"><?php echo app('translator')->get('additional.pages.services.services'); ?></h6>
                <div class="table-responsive">
                    <table class="table table-hover" id="services">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('additional.forms.title'); ?></th>
                                <th><?php echo app('translator')->get('additional.forms.content'); ?></th>
                                <th><?php echo app('translator')->get('additional.forms.time'); ?></th>
                                <th><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data->servicenotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($dat->name[app()->getLocale() . '_name']); ?></td>
                                    <td><?php echo e(mb_substr($dat->description[app()->getLocale() . '_description'], 0, 200)); ?>

                                    </td>
                                    <td>
                                        <?php echo e(App\Helpers\Helper::getDateTimeViaTimeStamp($dat->time, false, 'a')); ?>

                                    </td>

                                    <td><?php echo $__env->make('layouts.partials.table_buttons', [
                                        'edit' => true,
                                        'view' => true,
                                        'url' => 'servicenotifications',
                                        'delete' => false,
                                        'id' => $dat->id,
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row my-3 mt-4">
                <h6 class="mb-4">Cihazlar</h6>
                <div class="table-responsive">
                    <table class="table table-hover" id="devices">
                        <thead>
                            <tr>
                                <th scope="col">IpAddress</th>
                                <th scope="col">Device</th>
                                <th scope="col">Adres</th>
                                <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                <?php if(auth()->check() &&
                                        !empty(auth()->user()) &&
                                        !auth()->user()->hasRole('moderator')): ?>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                                <?php endif; ?>
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
                                    <?php if(auth()->check() &&
                                        !empty(auth()->user()) &&
                                        !auth()->user()->hasRole('moderator')): ?>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-block"
                                                onclick="deletedevice('<?php echo e($dat->id); ?>')"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/users/show.blade.php ENDPATH**/ ?>