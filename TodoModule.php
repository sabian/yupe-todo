<?php
/**
 * ToDo module
 *
 * @package  yupe.modules.todo
 * @author   Oleg Filimonov <olegsabian@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.1
 * @link     https://github.com/sabian/yupe-todo
 **/

use yupe\components\WebModule;

class TodoModule extends WebModule
{
    public function getDependencies()
    {
        return [];
    }

    public function getVersion()
    {
        return '0.1';
    }

    public function getCategory()
    {
        return 'Контент';
    }

    public function getName()
    {
        return 'ToDo';
    }

    public function getDescription()
    {
        return 'Простой модуль для управления задачами';
    }

    public function getAuthor()
    {
        return 'Команда Yupe';
    }

    public function getAuthorEmail()
    {
        return 'team@yupe.ru';
    }

    public function getUrl()
    {
        return 'http://yupe.ru';
    }

    public function getIcon()
    {
        return 'fa fa-fw fa-thumb-tack';
    }

    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'application.modules.todo.models.*',
                'application.modules.todo.components.widgets.*',
            ]
        );
    }

    public function getAdminPageLink()
    {
        return '/todo/todoBackend/index';
    }

    public function getNavigation()
    {
        return [
            [
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => 'Список задач',
                'url'   => ['/todo/todoBackend/index']
            ],
            [
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => 'Создать задачу',
                'url'   => ['/todo/todoBackend/create']
            ],
        ];
    }

    public function checkSelf()
    {
        $messages = [];
        $count = Todo::model()->countUnfinished();

        if(!$count) {
            return false;
        }

        $messages[WebModule::CHECK_NOTICE][] = [
            'type' => WebModule::CHECK_NOTICE,
            'message' => CHtml::link('Невыполненных задач - ' . $count, ['/todo/todoBackend/index']),
        ];

        return $messages;
    }
}