<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\FlightStatic;
/**
 * 航班静态控制器
 */
class FlightStaticController extends Controller
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
    //航班静态列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加航班静态
	public function actionAdd(){
		return $this->render('add');
	}
	//修改航班静态
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除航班静态
	public function actionDel(){
		//处理逻辑
	}
}
