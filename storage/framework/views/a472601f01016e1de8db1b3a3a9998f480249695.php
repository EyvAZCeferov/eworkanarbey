<style>
    .table_buttons {
        display: flex;
        width: 100%;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        align-content: center;
        margin: 0;
        padding: 0;
    }

    .table_buttons>* {
        margin-right: 5px;
        min-width: 27%;
        max-width: 100%;
        display: inline-block;
        font-size: 0.8em;
    }
</style>
<div class="row table_buttons">
    <?php if($edit == true): ?>
        <a href="<?php echo e(route($url . '.edit', $id)); ?>" class="btn btn-warning d-inline-block"><i class="fa fa-edit"></i></a>
    <?php endif; ?>
    <?php if($delete == true): ?>
        <form action="<?php echo e(route($url . '.destroy', $id)); ?>" method="post" style="display:inline-block">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger w-100"><i class="fa fa-trash"></i></button>
        </form>
    <?php endif; ?>
    <?php if($view): ?>
        <a href="<?php echo e(route($url . '.show', $id)); ?>" class="btn btn-info d-inline-block">
            <?php if(auth()->check() && auth()->user()->is_admin == true): ?>
                <i class="fa fa-eye"></i>
            <?php else: ?>
                <?php echo app('translator')->get('additional.buttons.more'); ?>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</div>
<?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/layouts/partials/table_buttons.blade.php ENDPATH**/ ?>