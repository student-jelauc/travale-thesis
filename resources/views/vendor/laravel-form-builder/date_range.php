<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <div class="input-daterange input-group" style="width: 100%" id="datepicker">
        <?= Form::input('text', "{$name}[start]", @$options['value']['start'], $options['attr']) ?>
        <span class="pt-1 pl-1 pr-1 border border-light text-muted">to</span>
        <?= Form::input('text', "{$name}[end]", @$options['value']['end'], $options['attr']) ?>
    </div>

    <?php include 'errors.php' ?>
    <?php include 'help_block.php' ?>
<?php endif; ?>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php $__env->startPush('scripts', "
<script>
    window.addEventListener('load', function () {
        $('.input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            keyboardNavigation: false,
            autoclose: true,
            keepEmptyValues: true,
        });
    });
</script>
") ?>
