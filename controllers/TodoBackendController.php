<?php
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
}