<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\AirticketSupplier;
/**
 * 机票供应商控制器
 */
class AirticketSupplierController extends Controller
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
    //机票供应商列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加机票供应商
	public function actionAdd(){
		return $this->render('add');
	}
	//修改机票供应商
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除机票供应商
	public function actionDel(){
		//处理逻辑
	}

}
