<?php $__env->startSection('title'); ?>
    <?php if(isset($data) && !empty($data)): ?>
        <?php echo app('translator')->get('additional.pages.services.edit'); ?> <?php echo e($data->name[app()->getLocale() . '_name']); ?>

    <?php else: ?>
        <?php echo app('translator')->get('additional.pages.services.add'); ?> <?php echo e($service->name[app()->getLocale() . '_name']); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Optional: Style the select box to match your design */
        .select2-container {
            width: 100%;
            margin-bottom: 10px;
        }

        .select2-container .select2-selection--single {
            height: 40px;
            border: 2px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s ease-in-out;
        }

        .select2-container .select2-selection--single:focus {
            border-color: #2196f3;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 40px;
            border-left: 2px solid #ccc;
            transition: border-color 0.2s ease-in-out;
        }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            border-color: #666 transparent transparent transparent;
        }

        .select2-container .select2-selection--single .select2-selection__arrow:hover {
            border-color: #2196f3;
        }

        .select2-container .select2-results__option {
            padding: 8px;
            font-size: 16px;
            transition: background-color 0.2s ease-in-out;
        }

        .select2-container .select2-results__option:hover {
            background-color: #eee;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("select[name=user_id]").select2({
            width: 'resolve',
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        <?php if(isset($data) && !empty($data)): ?>
                            <?php echo app('translator')->get('additional.pages.services.edit'); ?> <?php echo e($data->name[app()->getLocale() . '_name']); ?>

                        <?php else: ?>
                            <?php echo app('translator')->get('additional.pages.services.add'); ?> <?php echo e($service->name[app()->getLocale() . '_name']); ?>

                        <?php endif; ?>
                        <a href="<?php echo e(route('services.show', isset($service) && !empty($service) ? $service->id : $data->service_id)); ?>"
                            class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            <?php if(isset($data) && !empty($data)): ?> action="<?php echo e(route('servicenotifications.update', $data->id)); ?>" <?php else: ?> action="<?php echo e(route('servicenotifications.store')); ?>" <?php endif; ?>
                            method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($data) && !empty($data)): ?>
                                <?php echo method_field('PATCH'); ?>
                            <?php endif; ?>
                            <?php if(!isset($data) && empty($data)): ?>
                                <input type="hidden" name='service_id' value="<?php echo e($service->id); ?>">
                            <?php endif; ?>
                            <div class="row">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true">AZ</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">RU</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">EN</button>
                                    </div>
                                </nav>
                                <div class="tab-content pt-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label"><?php echo app('translator')->get('additional.forms.title'); ?></label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="az_name"
                                                value="<?php echo e(isset($data) && !empty($data) && isset($data->name['az_name']) && !empty(trim($data->name['az_name'])) ? $data->name['az_name'] : null); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label"><?php echo app('translator')->get('additional.forms.description'); ?></label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="az_description"><?php echo e(!empty($data) && isset($data->description['az_description']) && !empty(trim($data->description['az_description'])) ? $data->description['az_description'] : null); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label"><?php echo app('translator')->get('additional.forms.title'); ?></label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="ru_name"
                                                value="<?php echo e(!empty($data) && isset($data->name['ru_name']) && !empty(trim($data->name['ru_name'])) ? $data->name['ru_name'] : null); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label"><?php echo app('translator')->get('additional.forms.description'); ?></label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="ru_description"><?php echo e(!empty($data) && isset($data->description['ru_description']) && !empty(trim($data->description['ru_description'])) ? $data->description['ru_description'] : null); ?></textarea>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label"><?php echo app('translator')->get('additional.forms.title'); ?></label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="en_name"
                                                value="<?php echo e(!empty($data) && isset($data->name['en_name']) && !empty(trim($data->name['en_name'])) ? $data->name['en_name'] : null); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label"><?php echo app('translator')->get('additional.forms.description'); ?></label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="en_description"><?php echo e(!empty($data) && isset($data->description['en_description']) && !empty(trim($data->description['en_description'])) ? $data->description['en_description'] : null); ?></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <?php $__currentLoopData = $service->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($attribute)): ?>
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"><?php echo e($attribute->attributegroup->name[app()->getLocale() . '_name']); ?></label>
                                                <?php if($attribute->attributegroup->type == 'string'): ?>
                                                    <input type="text" class="form-control"
                                                        name="area[<?php echo e($attribute->attribute_group_id); ?>][value]"
                                                        <?php if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))): ?> value="<?php echo e(servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null); ?>" <?php endif; ?>
                                                        >
                                                <?php elseif($attribute->attributegroup->type == 'integer'): ?>
                                                    <input type="number" class="form-control"
                                                        name="area[<?php echo e($attribute->attribute_group_id); ?>][value]"
                                                        <?php if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))): ?> value="<?php echo e(servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null); ?>" <?php endif; ?>
                                                        >
                                                <?php elseif($attribute->attributegroup->type == 'time'): ?>
                                                    <input type="date" class="form-control"
                                                        name="area[<?php echo e($attribute->attribute_group_id); ?>][value]"
                                                        <?php if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))): ?> value="<?php echo e(servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null); ?>" <?php endif; ?>
                                                        >
                                                <?php elseif($attribute->attributegroup->type == 'text'): ?>
                                                    <textarea class="form-control" name="area[<?php echo e($attribute->attribute_group_id); ?>][value]"><?php if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))): ?> <?php echo e(servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null); ?> <?php endif; ?></textarea>
                                                <?php else: ?>
                                                    <input type="text" class="form-control"
                                                        name="area[<?php echo e($attribute->attribute_group_id); ?>][value]"
                                                        <?php if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))): ?> value="<?php echo e(servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null); ?>" <?php endif; ?>
                                                        >
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputIcon" class="form-label"><?php echo app('translator')->get('additional.forms.pdf'); ?></label>
                                        <?php if(isset($data) && !empty($data) && isset($data->pdf) && !empty($data->pdf)): ?>
                                            <iframe
                                                src="<?php echo e(App\Helpers\Helper::getImageUrl($data->pdf, 'servicenotifications')); ?>"
                                                height="200" width="300"></iframe>
                                        <?php endif; ?>
                                        <input type="file" accept="pdf" id="exampleInputIcon" class="form-control"
                                            name="pdf">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputStatus" class="form-label"><?php echo app('translator')->get('additional.forms.status'); ?></label>
                                        <select name="status" class="form-control" id="exampleInputStatus">
                                            <option value="1" <?php if(isset($data) && !empty($data) && $data->status == true): ?> selected <?php endif; ?>>
                                                <?php echo app('translator')->get('additional.pages.login.status_1'); ?></option>
                                            <option value="0" <?php if(isset($data) && !empty($data) && $data->status == false): ?> selected <?php endif; ?>>
                                                <?php echo app('translator')->get('additional.pages.login.status_0'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <?php if(!isset($data) && empty($data)): ?>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="mb-3">
                                            <label for="exampleInputTopId" class="form-label"><?php echo app('translator')->get('additional.forms.user'); ?></label>
                                            <select name="user_id"
                                                class="js-example-basic-single js-states js-select2 form-control"
                                                id="exampleInputTopId">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user->id); ?>"
                                                        <?php if(isset($data) && !empty($data) && $data->user_id == $user->id): ?> selected <?php endif; ?>>
                                                        #<?php echo e($user->fin_code); ?> <?php echo e($user->name_surname); ?>

                                                        <?php echo e(isset($user->additionalinfo->company_name) && !empty($user->additionalinfo->comapny_name) ? '(' . $user->additional_info->company_name . ')' : null); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="mb-3">
                                            <label for="exampleInputTopId" class="form-label"><?php echo app('translator')->get('additional.forms.user'); ?></label>
                                            <p>#<?php echo e($data->user->fin_code); ?> --
                                                <?php echo e(isset($data->user->additionalinfo->company_name) && !empty($data->user->additionalinfo->comapny_name) ? '(' . $data->user->additional_info->company_name . ')' : $data->user->name_surname); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputOrder" class="form-label"><?php echo app('translator')->get('additional.forms.time'); ?></label>
                                        <?php if(isset($data) && !empty($data) && !empty($data->time) && isset($data->time) && !empty(trim($data->time))): ?>
                                            <?php
                                                $zaman = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '1970-01-16 00:00:00');
                                            ?>
                                            <input type="date" class="form-control" name="time"
                                                id="exampleInputOrder" value="<?php echo e($zaman->format('Y-m-d')); ?>">
                                        <?php else: ?>
                                            <input type="date" class="form-control" name="time"
                                                id="exampleInputOrder">
                                        <?php endif; ?>
                                    </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/servicenotifications/create_edit.blade.php ENDPATH**/ ?>