<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\TourArea;
/**
 * 旅游景区控制器
 */
class TourAreaController extends Controller
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
    //旅游景区列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加旅游景区
	public function actionAdd(){
		return $this->render('add');
	}
	//修改旅游景区
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除旅游景区
	public function actionDel(){
		//处理逻辑
	}
}
