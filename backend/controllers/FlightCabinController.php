<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Cabin;
/**
 * 航班舱位控制器
 */
class FlightCabinController extends Controller
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
    //航班舱位列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加航班舱位
	public function actionAdd(){
		return $this->render('add');
	}
	//修改航班舱位
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除航班舱位
	public function actionDel(){
		//处理逻辑
	}

}
