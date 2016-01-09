<?php
/**
 * @var $this TodoBackendController
 * @var $model Todo
 */

$this->pageTitle = 'ToDo - Список';

$this->breadcrumbs = [ $this->pageTitle ];

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => 'Список задач', 'url' => ['/todo/todoBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => 'Создать задачу', 'url' => ['/todo/todoBackend/create']],
];
?>
<div class="page-header">
    <h1><?= $this->pageTitle ?></h1>
</div>

<?php $this->widget('yupe\widgets\CustomGridView', [
        'id' => 'todo-grid',
        'type' => 'condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => [
            'id',
            'description',
            'status',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]
); ?>
