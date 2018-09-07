<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Airline;
/**
 * 航空公司控制器
 */
class AirlineController extends Controller
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
    //航空公司列表 
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加航空公司
	public function actionAdd(){
		return $this->render('add');
	}
	//修改航空公司
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除航空公司
	public function actionDel(){
		//处理逻辑
	}

}
