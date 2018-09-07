<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\AirticketMail;
/**
 * 机票订单邮寄控制器
 */
class AirticketMailController extends Controller
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
    //机票订单邮寄列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加机票订单邮寄
	public function actionAdd(){
		return $this->render('add');
	}
	//修改机票订单邮寄
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除机票订单邮寄
	public function actionDel(){
		//处理逻辑
	}
}
