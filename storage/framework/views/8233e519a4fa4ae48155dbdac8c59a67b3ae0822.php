<?php $__env->startSection('title'); ?>
    <?php if(isset($data) && !empty($data)): ?>
        <?php echo app('translator')->get('additional.pages.services.service'); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
    <?php else: ?>
        <?php echo app('translator')->get('additional.pages.services.service'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    
    <script>
        function makeid(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                counter += 1;
            }
            return result;
        }

        // <div class="col-sm-6 col-md-6 col-lg-3" id="attributetype_${idofelement}">
        // </div>

        function addareaoftab(type) {
            var idofelement = makeid(11);
            var element =
                `<div class="row my-2 px-3" id="${idofelement}">
                    <input type="hidden" name="area[${idofelement}][type_of_action]" value="2" />
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <label>Qrup</label>
                        <select onchange="changedgroupid('attributetype_${idofelement}','attributegroup_${idofelement}','${idofelement}')" id="attributegroup_${idofelement}" class="form-control" name="area[${idofelement}][group_id]"><option></option><?php $__currentLoopData = attributes()->whereNull('group_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option data-type="<?php echo e($attribute->type); ?>" value="<?php echo e($attribute->id); ?>" ><?php echo e($attribute->name[app()->getLocale() . '_name']); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
                    </div>
                    
                    <div class="col-sm-6 col-md-6 col-lg-2">
                        <label>Tabloda göstər</label>
                        <input type="checkbox" name="area[${idofelement}][showontable]"/>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2">
                        <label>Sıra nömrəsi</label>
                        <input class="form-control" name="area[${idofelement}][order_a]" />
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2 align-center align-items-center justify-content-center justify-center">
                        <button type="button" class='btn btn-danger' onclick="delete_area('${idofelement}')">
                            <i class='fa fa-trash'></i>
                        </button>
                    </div>
                </div>`;

            $(`div#${type}`).append(element);
        }

        // function changedgroupid(id_area, id_select,idofelement) {
        //     var selectvalur = $(`select#${id_select}`).val();
        //     var selectedtype = $('select#' + id_select + ' option:selected').data('type');
        //     $(`div#${id_area}`).empty();
        //     if(selectedtype=="integer"){
        //         $(`div#${id_area}`).append(`<label>Rəqəm</label><input type="integer" class='form-control' name="area[${idofelement}][value]" > `);
        //     }else if(selectedtype=="string"){
        //         $(`div#${id_area}`).append(`<label>Yazı</label><input class='form-control' name="area[${idofelement}][value]" > `);
        //     }else if(selectedtype=="description"){
        //         $(`div#${id_area}`).append(`<label>Açıqlama</label><input class='form-control' name="area[${idofelement}][value]" > `);
        //     }else{
        //         $(`div#${id_area}`).append(`<label>Yazı</label><input class='form-control' name="area[${idofelement}][value]" > `);
        //     }
        // }

        function delete_area(id, type = null) {
            if (type != null && type.length > 0) {
                $.ajax({
                    url: "<?php echo e(route('api.deleteserviceattribute')); ?>",
                    dataType: 'json',
                    data: {
                        element_id: id,
                    },
                    type: 'delete',
                    success: function(data) {
                        if (data.status == "success") {
                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        if (data.status == "success") {
                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            }
            $(`div#${id}`).remove();
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
                            <?php echo app('translator')->get('additional.pages.services.service'); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->get('additional.pages.services.service'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
                        <?php endif; ?> &nbsp;
                        <a href="<?php echo e(route('services.index')); ?>" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            <?php if(isset($data) && !empty($data)): ?> action="<?php echo e(route('services.update', $data->id)); ?>" <?php else: ?> action="<?php echo e(route('services.store')); ?>" <?php endif; ?>
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
                            <div class="w-100 my-2">
                                <div class="w-100 d">Atributlar &nbsp;<button type="button" class='btn btn-info'
                                        onclick="addareaoftab('attributes_area')"> <i class="fa fa-plus"></i>
                                    </button></div>
                                <div id="attributes_area" class="w-100">
                                    <?php if(isset($data) && !empty($data) && isset($data->attributes) && !empty($data->attributes)): ?>
                                        <?php $__currentLoopData = $data->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="row my-2 px-3" id="<?php echo e($tab->id); ?>">
                                                <input type="hidden"
                                                    name="area[<?php echo e($tab->id); ?>][type_of_action]"
                                                    value="2" />
                                                <div class="col-sm-6 col-md-6 col-lg-4">
                                                    <label>Qrup</label>
                                                    <select
                                                        onchange="changedgroupid('attributetype_<?php echo e($tab->id); ?>','attributegroup_<?php echo e($tab->id); ?>','<?php echo e($tab->id); ?>')"
                                                        id="attributegroup_<?php echo e($tab->id); ?>" class="form-control"
                                                        name="area[<?php echo e($tab->id); ?>][group_id]">
                                                        <option></option>
                                                        <?php $__currentLoopData = attributes()->whereNull('group_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option data-type="<?php echo e($attribute->type); ?>"
                                                                value="<?php echo e($attribute->id); ?>"
                                                                <?php if($attribute->id == $tab->attribute_group_id): ?> selected <?php endif; ?>
                                                                >
                                                                <?php echo e($attribute->name[app()->getLocale() . '_name']); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-2">
                                                    <label>Tabloda göstər</label>
                                                    <input type="checkbox"

                                                    <?php if($tab->showontable==true): ?> checked <?php endif; ?>
                                                        name="area[<?php echo e($tab->id); ?>][showontable]" />
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-2">
                                                    <label>Sıra nömrəsi</label>
                                                    <input class="form-control"
                                                    <?php if(!empty($tab->order_a)): ?> value="<?php echo e($tab->order_a); ?>" <?php endif; ?>
                                                        name="area[<?php echo e($tab->id); ?>][order_a]" />
                                                </div>
                                                <div
                                                    class="col-sm-6 col-md-6 col-lg-2 align-center align-items-center justify-content-center justify-center">
                                                    <button type="button" class='btn btn-danger'
                                                        onclick="delete_area('<?php echo e($tab->id); ?>','database')">
                                                        <i class='fa fa-trash'></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputIcon" class="form-label"><?php echo app('translator')->get('additional.forms.icon'); ?></label>
                                        <?php if(isset($data) && !empty($data) && isset($data->icon) && !empty($data->icon)): ?>
                                            <img src="<?php echo e(App\Helpers\Helper::getImageUrl($data->icon, 'services')); ?>"
                                                alt="<?php echo e($data->name[app()->getLocale() . '_name'] ?? null); ?>"
                                                class="img-fluid img-responsive">
                                        <?php endif; ?>
                                        <input type="file" id="exampleInputIcon" class="form-control" name="icon">
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
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label"><?php echo app('translator')->get('additional.forms.showondashboard'); ?></label>
                                        <select name="showondashboard" class="form-control">
                                            <option value="1" <?php if(isset($data) && !empty($data) && $data->showondashboard == true): ?> selected <?php endif; ?>>
                                                <?php echo app('translator')->get('additional.pages.login.status_1'); ?></option>
                                            <option value="0" <?php if(isset($data) && !empty($data) && $data->showondashboard == false): ?> selected <?php endif; ?>>
                                                <?php echo app('translator')->get('additional.pages.login.status_0'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputTopId" class="form-label"><?php echo app('translator')->get('additional.forms.top_service'); ?></label>
                                        <select name="top_id" class="form-control" id="exampleInputTopId">
                                            <option value=""></option>
                                            <?php $__currentLoopData = $services_top; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($service->id); ?>"
                                                    <?php if(isset($data) && !empty($data) && $data->top_id == $service->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($service->name[app()->getLocale() . '_name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputOrder" class="form-label"><?php echo app('translator')->get('additional.forms.order'); ?></label>
                                        <input type="number" class="form-control" name="order_a" id="exampleInputOrder"
                                            <?php if(isset($data) && !empty($data) && !empty($data->order_a)): ?> value="<?php echo e($data->order_a); ?>" <?php else: ?> value="1" <?php endif; ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputSendInfo" class="form-label"><?php echo app('translator')->get('additional.forms.send_info'); ?></label>
                                        <select name="send_info" class="form-control" id="exampleInputSendInfo">
                                            <option value="1" <?php if(isset($data) && !empty($data) && $data->send_info == true): ?> selected <?php endif; ?>>
                                                <?php echo app('translator')->get('additional.pages.login.status_1'); ?></option>
                                            <option value="0" <?php if(isset($data) && !empty($data) && $data->send_info == false): ?> selected <?php endif; ?>>
                                                <?php echo app('translator')->get('additional.pages.login.status_0'); ?></option>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/services/create_edit.blade.php ENDPATH**/ ?>