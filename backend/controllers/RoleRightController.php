<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\RoleRight;
/**
 * 角色权限控制器
 */
class RoleRightController extends Controller
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
    //角色权限列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加角色权限
	public function actionAdd(){
		return $this->render('add');
	}
	//修改角色权限
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除角色权限
	public function actionDel(){
		//处理逻辑
	}
}
