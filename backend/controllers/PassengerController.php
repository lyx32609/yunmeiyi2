<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Passenger;
/**
 * 乘客控制器
 */
class PassengerController extends Controller
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
    //乘客列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加乘客
	public function actionAdd(){
		return $this->render('add');
	}
	//修改乘客
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除乘客
	public function actionDel(){
		//处理逻辑
	}
}
