<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\PayType;

/**
 * 支付类型控制器
 */
class PayTypeController extends Controller
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
    //支付类型列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加支付类型
	public function actionAdd(){
		return $this->render('add');
	}
	//修改支付类型
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除支付类型
	public function actionDel(){
		//处理逻辑
	}
}
