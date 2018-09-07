<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\PlaneModel;
/**
 *航班机型控制器
 */
class PlaneModelController extends Controller
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
    //航班机型列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加航班机型
	public function actionAdd(){
		return $this->render('add');
	}
	//修改航班机型
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除航班机型
	public function actionDel(){
		//处理逻辑
	}
}
