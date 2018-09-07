<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\AirticketRefund;
/**
 * 机票退票控制器
 */
class AirticketRefundController extends Controller
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
    //机票退票列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//修改机票退票
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除机票退票
	public function actionDel(){
		//处理逻辑
	}
}
