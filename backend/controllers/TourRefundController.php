<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\TourRefund;
/**
 * 线路订单取消控制器
 */
class TourRefundController extends Controller
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
    //线路订单取消列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加线路订单取消
	public function actionAdd(){
		return $this->render('add');
	}
	//修改线路订单取消
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除线路订单取消
	public function actionDel(){
		//处理逻辑
	}
}
