<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Organization;
/**
 * 公司机构控制器
 */
class OrganizationController extends Controller
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
    //公司机构列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加公司机构
	public function actionAdd(){
		return $this->render('add');
	}
	//修改公司机构
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除公司机构
	public function actionDel(){
		//处理逻辑
	}
}
