<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\FlightDynamic;
/**
 * 航班动态控制器
 */
class FlightDynamicController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    //航班动态列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加航班动态
	public function actionAdd(){
		return $this->render('add');
	}
	//修改航班动态
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除航班动态
	public function actionDel(){
		//处理逻辑
	}
}
