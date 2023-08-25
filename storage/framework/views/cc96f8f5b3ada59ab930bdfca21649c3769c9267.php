<?php $__env->startSection('title'); ?>
    <?php if(isset($data) && !empty($data)): ?>
        <?php echo app('translator')->get('additional.urls.standartpages'); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
    <?php else: ?>
        <?php echo app('translator')->get('additional.urls.standartpages'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        <?php if(isset($data) && !empty($data)): ?>
                            <?php echo app('translator')->get('additional.urls.standartpages'); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->get('additional.urls.standartpages'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
                        <?php endif; ?> &nbsp;
                        <a href="<?php echo e(route('standartpages.index')); ?>" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            <?php if(isset($data) && !empty($data)): ?> action="<?php echo e(route('standartpages.update', $data->id)); ?>" <?php else: ?> action="<?php echo e(route('standartpages.store')); ?>" <?php endif; ?>
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

                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputStatus" class="form-label"><?php echo app('translator')->get('additional.forms.type'); ?></label>
                                        <select name="type" class="form-control" id="exampleInputStatus">
                                            <option value="about" <?php if(isset($data) && !empty($data) && $data->type == 'about'): ?> selected <?php endif; ?>>
                                                Haqqımızda</option>
                                            <option value="termsconditions"
                                                <?php if(isset($data) && !empty($data) && $data->type == 'termsconditions'): ?> selected <?php endif; ?>>
                                                İstifadqə şərtləri</option>
                                            <option value="privarcypolicy"
                                                <?php if(isset($data) && !empty($data) && $data->type == 'privarcypolicy'): ?> selected <?php endif; ?>>
                                                Gizlilik Siyasəti</option>
                                            <option value="muqavilemelumatqqq"
                                                <?php if(isset($data) && !empty($data) && $data->type == 'muqavilemelumat'): ?> selected <?php endif; ?>>
                                                Müqavilə Məlumat</option>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/standartpages/create.blade.php ENDPATH**/ ?>