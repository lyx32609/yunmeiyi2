<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Ad;
/**
 * 广告控制器
 */
class AdController extends Controller
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
    //广告列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加广告
	public function actionAdd(){
		return $this->render('add');
	}
	//修改广告
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除广告
	public function actionDel(){
		//处理逻辑
	}

}
