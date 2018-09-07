<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\ChangeRule;
/**
 * 航班退改规定控制器
 */
class FlightChangeruleController extends Controller
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
    //航班退改规定列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加航班退改规定
	public function actionAdd(){
		return $this->render('add');
	}
	//修改航班退改规定
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除航班退改规定
	public function actionDel(){
		//处理逻辑
	}

}
