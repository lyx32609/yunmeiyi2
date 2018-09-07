<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\AirticketOrder;
/**
 * 机票订单控制器
 */
class AirticketOrderController extends Controller
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
    //机票订单列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//修改机票订单
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除机票订单
	public function actionDel(){
		//处理逻辑
	}

}
