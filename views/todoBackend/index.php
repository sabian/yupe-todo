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
        'sortableRows' => true,
        'sortableAjaxSave' => true,
        'sortableAttribute' => 'sort',
        'sortableAction' => '/todo/todoBackend/sortable',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => [
            'id',
            'description',
            [
                'name' => 'status',
                'class' => 'yupe\widgets\EditableStatusColumn',
                'url' => $this->createUrl('/todo/todoBackend/inline'),
                'source' => TodoStatusHelper::getList(),
                'options' => TodoStatusHelper::getStylesList(),
                'filter' => CHtml::activeDropDownList($model, 'status', TodoStatusHelper::getList(), [
                    'encode' => false,
                    'empty' => '',
                    'class' => 'form-control',
                ]),
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]
); ?>
