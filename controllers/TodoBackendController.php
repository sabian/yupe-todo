<?php
use yupe\widgets\YFlashMessages;
use yupe\components\controllers\BackController;

/**
 * Class TodoBackendController
 */
class TodoBackendController extends BackController
{
    public function actionIndex()
    {
        $model = new Todo('search');
        $query = Yii::app()->getRequest()->getQuery('Todo');

        $model->unsetAttributes();

        if ($query) {
            $model->setAttributes($query);
        }

        $this->render('index', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Todo();

        if ($data = Yii::app()->getRequest()->getPost('Todo')) {

            $model->setAttributes($data);

            if ($model->save()) {
                Yii::app()->user->setFlash(YFlashMessages::SUCCESS_MESSAGE, 'Задача успешно добавлена');

                $this->redirect((array)Yii::app()->getRequest()->getPost('submit-type', ['create']));
            }
        }

        $this->render('create', ['model' => $model]);
    }
}