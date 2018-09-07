<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\TourSpot;
/**
 * 旅游景点控制器
 */
class TourSpotController extends Controller
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
    //旅游景点列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加旅游景点
	public function actionAdd(){
		return $this->render('add');
	}
	//修改旅游景点
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除旅游景点
	public function actionDel(){
		//处理逻辑
	}
}
