<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Airport;
/**
 * 机场控制器
 */
class AirportController extends Controller
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
    //机场列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加机场
	public function actionAdd(){
		return $this->render('add');
	}
	//修改机场
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除机场
	public function actionDel(){
		//处理逻辑
	}

}
