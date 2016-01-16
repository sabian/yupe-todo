<?php
/**
 * @var $model Todo
 * @var $form \yupe\widgets\ActiveForm
 */

$form = $this->beginWidget('\yupe\widgets\ActiveForm', [
    'id' => 'todo-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => ['class' => 'well'],
]);
?>
    <div class="alert alert-info">Поля отмеченные <span class="required">*</span> обязательны для заполнения</div>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-8">
            <?= $form->textFieldGroup($model, 'description'); ?>
        </div>
        <div class="col-sm-4">
            <?= $form->dropDownListGroup($model, 'status', [
                'widgetOptions' => [
                    'data' => TodoStatusHelper::getList(),
                ],
            ]); ?>
        </div>
    </div>

    <?php $this->widget('bootstrap.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Создать задачу и продолжить' : 'Сохранить задачу и продолжить',
    ]); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->isNewRecord ? 'Создать задачу и закрыть' : 'Сохранить задачу и закрыть',
    ]); ?>

<?php $this->endWidget(); ?>