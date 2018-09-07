<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Service;
/**
 * 服务信息控制器
 */
class ServiceController extends Controller
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
    //服务信息列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加服务信息
	public function actionAdd(){
		return $this->render('add');
	}
	//修改服务信息
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除服务信息
	public function actionDel(){
		//处理逻辑
	}
}
>