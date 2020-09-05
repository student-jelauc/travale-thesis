<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?php $emptyVal = $options['empty_value'] ? ['' => $options['empty_value']] : null; ?>
    <?= Form::select($name, (array)$emptyVal + $options['choices'], $options['selected'], $options['attr']) ?>

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
        $('#{$options['id']}').select2({
            theme: 'bootstrap', placeholder: '- {$options['label']} -',
            allowClear: true,
            tags: '{$options['label']}',
            createTag: function (params) {
                var term = $.trim(params.term);
            
                if (term === '') {
                  return null;
                }
            
                return {
                  id: term,
                  text: term,
                  newTag: true // add additional parameters
                }
              }
        });
    });
</script>
") ?>
