<?php
use yupe\widgets\YFlashMessages;
use yupe\components\controllers\BackController;

/**
 * Class TodoBackendController
 */
class TodoBackendController extends BackController
{
    public function filters()
    {
        return CMap::mergeArray(
            parent::filters(),
            [
                'postOnly + delete',
            ]
        );
    }

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

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if ($data = Yii::app()->getRequest()->getPost('Todo')) {

            $model->setAttributes($data);

            if ($model->update()) {
                Yii::app()->user->setFlash(YFlashMessages::SUCCESS_MESSAGE, 'Задача успешно обновлена');

                $submitType = Yii::app()->getRequest()->getPost('submit-type');

                if (isset($submitType)) {
                    $this->redirect([$submitType]);
                } else {
                    $this->redirect(['update', 'id' => $model->id]);
                }
            }
        }

        $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        if ($this->loadModel($id)->delete()) {
            Yii::app()->user->setFlash(YFlashMessages::SUCCESS_MESSAGE, 'Задача успешно удалена');

            if (!Yii::app()->getRequest()->getParam('ajax')) {
                $this->redirect((array)Yii::app()->getRequest()->getPost('returnUrl', 'index'));
            }
        }
    }

    /**
     * @param $id
     * @return Todo
     * @throws CHttpException
     */
    private function loadModel($id)
    {
        $model = Todo::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Запрошенная страница не найдена.');
        }

        return $model;
    }
}