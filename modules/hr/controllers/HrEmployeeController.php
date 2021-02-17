<?php /** @noinspection ALL */

namespace app\modules\hr\controllers;

use app\controllers\BaseController;
use app\modules\hr\models\HrPosition;
use app\modules\hr\models\HrPositionCon;
use app\modules\hr\models\HrUser;
use app\modules\hr\models\Works;
use Yii;
use app\modules\hr\models\HrEmployee;
use app\modules\hr\models\HrEmployeeSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HrEmployeeController implements the CRUD actions for HrEmployee model.
 */
class HrEmployeeController extends BaseController
{
    /**
     * Lists all HrEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HrEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HrEmployee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HrEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model      = new HrEmployee();
        $position   = new HrPosition();
        $hruser     = new HrUser();
        $works      = [new Works()];
        $hrposition = new HrPositionCon();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model'      => $model,
            'position'   => $position,
            'hruser'     => $hruser,
            'works'      => $works,
            'hrposition' => $hrposition
        ]);
    }

    /**
     * Updates an existing HrEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HrEmployee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HrEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HrEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HrEmployee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
