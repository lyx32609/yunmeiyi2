<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use app\models\imgcode;


/**
 * Site controller
 */
class CodeimgController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	
    	return \yii\helpers\Json::encode($res);
    }
    
   
    
    
    
    
    
    
    
    
    
}