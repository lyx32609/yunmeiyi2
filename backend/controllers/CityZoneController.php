<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\City;
/**
 * 城市控制器
 */
class CityZoneController extends Controller
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
    //城市列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//修改城市
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除城市
	public function actionDel(){
		//处理逻辑
	}

}
