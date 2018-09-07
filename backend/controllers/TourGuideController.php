<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\TourGuide;
/**
 * 导游信息控制器
 */
class TourGuideController extends Controller
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
    //导游信息列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加导游信息
	public function actionAdd(){
		return $this->render('add');
	}
	//修改导游信息
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除导游信息
	public function actionDel(){
		//处理逻辑
	}
}	
