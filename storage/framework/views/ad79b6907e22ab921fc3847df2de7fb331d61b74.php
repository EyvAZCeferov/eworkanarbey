<?php $__env->startSection('title'); ?>
    <?php if(isset($data) && !empty($data)): ?>
        Atribut <?php echo app('translator')->get('additional.pages.services.edit'); ?>
    <?php else: ?>
        Atribut <?php echo app('translator')->get('additional.pages.services.add'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        <?php if(isset($data) && !empty($data)): ?>
                            Atribut <?php echo app('translator')->get('additional.pages.services.edit'); ?>
                        <?php else: ?>
                            Atribut <?php echo app('translator')->get('additional.pages.services.add'); ?>
                        <?php endif; ?> &nbsp;
                        <a href="<?php echo e(route('attributes.index')); ?>" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            <?php if(isset($data) && !empty($data)): ?> action="<?php echo e(route('attributes.update', $data->id)); ?>" <?php else: ?> action="<?php echo e(route('attributes.store')); ?>" <?php endif; ?>
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

                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label"><?php echo app('translator')->get('additional.forms.title'); ?></label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="ru_name"
                                                value="<?php echo e(!empty($data) && isset($data->name['ru_name']) && !empty(trim($data->name['ru_name'])) ? $data->name['ru_name'] : null); ?>">
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

                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">

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

                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputSendInfo" class="form-label">Tip</label>
                                        <select name="type" class="form-control" id="exampleInputSendInfo">
                                            <option value="string" <?php if(isset($data) && !empty($data) && $data->type == 'string'): ?> selected <?php endif; ?>>
                                                Yazı</option>
                                            <option value="integer" <?php if(isset($data) && !empty($data) && $data->type == 'integer'): ?> selected <?php endif; ?>>
                                                Rəqəm</option>
                                            <option value="time" <?php if(isset($data) && !empty($data) && $data->type == 'time'): ?> selected <?php endif; ?>>
                                                Tarix</option>
                                            <option value="text" <?php if(isset($data) && !empty($data) && $data->type == 'text'): ?> selected <?php endif; ?>>
                                                Məlumat (geniş yazı)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="">Aid olduğu qrup</label>
                                        <select name="group_id" class="form-control">
                                            <option value=""></option>
                                            <?php $__currentLoopData = attributes()->whereNull('group_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($attribute->id); ?>"
                                                    <?php if(isset($data) &&
                                                            !empty($data) &&
                                                            isset($data->group_id) &&
                                                            !empty($data->group_id) &&
                                                            $data->group_id == $attribute->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($attribute->name[app()->getLocale() . '_name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
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
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/attributes/create_edit.blade.php ENDPATH**/ ?>