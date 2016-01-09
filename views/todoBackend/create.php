<?php
/**
 * @var $model Todo
 */

$this->pageTitle = 'ToDo - Создание задачи';

$this->breadcrumbs = [
    'Список задач' => ['/todo/todoBackend/index'],
    $this->pageTitle
];

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => 'Список задач', 'url' => ['/todo/todoBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => 'Создать задачу', 'url' => ['/todo/todoBackend/create']],
];
?>
<div class="page-header">
    <h1>Задача <small>создание</small></h1>
</div>

<?= $this->renderPartial('_form', ['model' => $model]); ?>

