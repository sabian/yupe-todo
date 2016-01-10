<?php
/**
 * @var $model Todo
 */

$this->pageTitle = 'ToDo - Изменение задачи';

$this->breadcrumbs = [
    'Список задач' => ['/todo/todoBackend/index'],
    $this->pageTitle
];

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => 'Список задач', 'url' => ['/todo/todoBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => 'Создать задачу', 'url' => ['/todo/todoBackend/create']],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => 'Изменить задачу', 'url' => ['/todo/todoBackend/update', 'id' => $model->id]],
];
?>
<div class="page-header">
    <h1>Изменение задачи <small>№<?= $model->id ?></small></h1>
</div>

<?= $this->renderPartial('_form', ['model' => $model]); ?>

