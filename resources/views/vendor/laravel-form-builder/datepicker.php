<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?= Form::input($type, $name, $options['value'], $options['attr']) ?>

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
        $('.{$options['id']}').datepicker({
            format: 'yyyy-mm-dd',
            keyboardNavigation: false,
            autoclose: true,
            keepEmptyValues: true,
        });
    });
</script>
") ?>
