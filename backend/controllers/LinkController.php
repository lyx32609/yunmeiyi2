<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Link;
/**
 * 友情链接控制器
 */
class LinkController extends Controller
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
    //友情链接列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加友情链接
	public function actionAdd(){
		return $this->render('add');
	}
	//修改友情链接
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除友情链接
	public function actionDel(){
		//处理逻辑
	}
}
