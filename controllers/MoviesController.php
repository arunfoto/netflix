<?php

namespace app\controllers;

use app\models\Movies;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * MoviesController implements the CRUD actions for Movies model.
 */

class MoviesController extends Controller {
	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'verbs'    => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Movies models.
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider([
				'query' => Movies::find(),
			]);

		return $this->render('index', [
				'dataProvider' => $dataProvider,
			]);
	}

	/**
	 * Displays a single Movies model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id) {
		return $this->render('view', [
				'model' => $this->findModel($id),
			]);
	}

	/**
	 * Creates a new Movies model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		//print_r($_FILES);
		$model = $m1 = new Movies();

		if ($model->load(Yii::$app->request->post())) {
			$m1->filename = UploadedFile::getInstance($model, 'filename');
			$m1->poster   = UploadedFile::getInstance($model, 'poster');

			if ($m1->filename) {
				$m1->filename->saveAs('uploads/'.$m1->filename->baseName.'.'.$m1->filename->extension);
				$model->filename = $m1->filename->baseName.'.'.$m1->filename->extension;

			}

			if ($m1->poster) {

				$m1->poster->saveAs('uploads/'.$m1->poster->baseName.'.'.$m1->poster->extension);
				$model->poster = $m1->poster->baseName.'.'.$m1->poster->extension;

			}
			$model->status = 1;
			//print_r($model);
			$model->save();

			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('create', [
				'model' => $model,
			]);
	}

	/**
	 * Updates an existing Movies model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		$m1    = new Movies;

		$filename = $model->filename;
		$poster   = $model->poster;

		if ($model->load(Yii::$app->request->post())) {
			$m1->filename = UploadedFile::getInstance($model, 'filename');
			$m1->poster   = UploadedFile::getInstance($model, 'poster');

			if ($m1->filename && isset($m1->filename->baseName)) {
				$m1->filename->saveAs('uploads/'.$m1->filename->baseName.'.'.$m1->filename->extension);
				$model->filename = $m1->filename->baseName.'.'.$m1->filename->extension;

			} else {

				$model->filename = $filename;
			}
			//print_r($m1);
			if ($m1->poster && isset($m1->poster->baseName)) {

				$m1->poster->saveAs('uploads/'.$m1->poster->baseName.'.'.$m1->poster->extension);
				$model->poster = $m1->poster->baseName.'.'.$m1->poster->extension;

			} else {

				$model->poster = $poster;
			}

			$model->status = 1;
			//print_r($model);
			$model->save();
			//exit;
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
				'model' => $model,
			]);
	}

	/**
	 * Deletes an existing Movies model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Movies model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Movies the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Movies::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
