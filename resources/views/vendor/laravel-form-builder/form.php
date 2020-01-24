<?php if ($showStart): ?>
    <?= Form::open($formOptions) ?>
<?php endif; ?>

<?php $buttonFields = array_filter($fields, function($field) { return $field instanceof \Kris\LaravelFormBuilder\Fields\ButtonType; }) ?>
<?php $fields = array_filter($fields, function($field) { return !$field instanceof \Kris\LaravelFormBuilder\Fields\ButtonType; }) ?>
<?php if ($showFields && count($fields)): ?>
<div class="row">
    <?php foreach (array_chunk($fields, ceil(count($fields) / 2)) as $chunk): ?>
    <div class="col-sm-6">
        <?php foreach ($chunk as $field): ?>
            <?php if (!in_array($field->getName(), $exclude)) { ?>
                <?= $field->render() ?>
            <?php } ?>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<?php if ($showFields && count($fields)): ?>
    <?php foreach ($buttonFields as $field): ?>
        <?php if (!in_array($field->getName(), $exclude)) { ?>
            <?= $field->render() ?>
        <?php } ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($showEnd): ?>
    <?= Form::close() ?>
<?php endif; ?>
