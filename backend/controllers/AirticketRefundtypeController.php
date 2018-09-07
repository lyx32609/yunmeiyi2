<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\AirticketRefundtype;
/**
 * 机票退票类型控制器
 */
class AirticketRefundtypeController extends Controller
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
    //机票退票类型列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加机票退票类型
	public function actionAdd(){
		return $this->render('add');
	}
	//修改机票退票类型
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除机票退票类型
	public function actionDel(){
		//处理逻辑
	}

}
