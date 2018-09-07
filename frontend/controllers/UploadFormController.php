<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;
/**
 * Site controller
 */
class TestController extends Controller
{
	
	
	
	
	public function actionUpload()
	{
		$model = new UploadForm();
	
		if (Yii::$app->request->isPost) {
			$model->file = UploadedFile::getInstance($model, 'file');
		
			if ($model->file && $model->validate()) {
				p($model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension));die;
			}
		}
	
		return $this->render(‘upload’, ['model' => $model]);
	}

	
	
	
}
