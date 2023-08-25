<?php if(auth()->check() &&
        auth()->user()->hasRole('admin')): ?>
    
    <?php $__env->startPush('js'); ?>
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
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <?php $__currentLoopData = $services_home; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-xl-3">
                    <a href="<?php echo e(route('services.show', $service->service->id)); ?>">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <?php if(isset($service->service->icon) && !empty($service->service->icon)): ?>
                                <img class='img-fluid img-responsive'
                                    src="<?php echo e(App\Helpers\Helper::getImageUrl($service->service->icon, 'services')); ?>" />
                            <?php endif; ?>
                            <div class="ms-3">
                                <p class="mb-2"><?php echo e($service->service->name[app()->getLocale() . '_name']); ?></p>
                            </div>
                        </div>
                    </a>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Sales Chart Start -->
    <?php if(auth()->check() &&
            auth()->user()->hasRole('admin')): ?>
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
                    <h6 class="mb-4"><a href="<?php echo e(route('users.create')); ?>" class="btn btn-success"><i
                                class="fa fa-plus"></i></a>
                    </h6>

                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.profile_picture'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.fincode'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.username'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.pages.login.company_information'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = users()->where('is_admin', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if(isset($dat->additionalinfo->company_logo) && !empty($dat->additionalinfo->company_logo)): ?>
                                                <img src="<?php echo e(App\Helpers\Helper::getImageUrl($dat->additionalinfo->company_logo, 'useradditionals')); ?>"
                                                    alt="<?php echo e($dat->name_surname); ?>" class="img-fluid img-responsive"
                                                    width="50">
                                            <?php elseif(isset($dat->profile_picture) && !empty($dat->profile_picture)): ?>
                                                <img src="<?php echo e(App\Helpers\Helper::getImageUrl($dat->profile_picture, 'useradditionals')); ?>"
                                                    alt="<?php echo e($dat->name_surname); ?>" class="img-fluid img-responsive"
                                                    width="50">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($dat->fin_code); ?></td>
                                        <td><?php echo e($dat->name_surname); ?></td>
                                        <td><?php echo e(!empty($dat->additionalinfo) && isset($dat->additionalinfo->company_name)
                                            ? $dat->additionalinfo->company_name
                                            : trans('additional.pages.login.notacompany')); ?>

                                            <?php echo !empty($dat->additionalinfo) && isset($dat->additionalinfo->company_voen)
                                                ? ' <br/>VOEN: ' . $dat->additionalinfo->company_voen
                                                : null; ?>

                                        </td>
                                        <td
                                            <?php if($dat->status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                            <?php echo app('translator')->get('additional.pages.login.status_' . intval($dat->status)); ?>
                                        </td>

                                        <td><?php echo $__env->make('layouts.partials.table_buttons', [
                                            'edit' => true,
                                            'view' => true,
                                            'url' => 'users',
                                            'delete' => false,
                                            'id' => $dat->id,
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Sales Chart End -->

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/welcome.blade.php ENDPATH**/ ?>