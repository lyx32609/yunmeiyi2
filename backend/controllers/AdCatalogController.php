<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\AdCatalog;

/**
 * 广告分类控制器
 */
class AdCatalogController extends Controller
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
     //广告分类列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加广告分类
	public function actionAdd(){
		return $this->render('add');
	}
	//修改广告分类
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除广告分类
	public function actionDel(){
		//逻辑处理
	}

}
