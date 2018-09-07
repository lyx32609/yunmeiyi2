<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\TourOrder;
/**
 * 线路订单控制器
 */
class TourOrderController extends Controller
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
    //线路订单列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//修改线路订单
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除线路订单
	public function actionDel(){
		//处理逻辑
	}
}
