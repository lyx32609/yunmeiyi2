<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Airticket;
/**
 * 机票控制器
 */
class AirticketController extends Controller
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
    //机票列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加机票
	public function actionAdd(){
		return $this->render('add');
	}
	//修改机票
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除机票
	public function actionDel(){
		//处理逻辑
	}

}
