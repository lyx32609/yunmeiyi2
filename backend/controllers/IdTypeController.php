<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Idtype;
/**
 * 证件类型控制器
 */
class IdTypeController extends Controller
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
    //证件类型列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加证件类型
	public function actionAdd(){
		return $this->render('add');
	}
	//修改证件类型
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除证件类型
	public function actionDel(){
		//处理逻辑
	}
}
