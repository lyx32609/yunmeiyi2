<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 21:54
 */

namespace frontend\controllers;

use yii;
use frontend\models\AdminRolePermission;
use frontend\models\Menu;
use frontend\models\RoleRight;
use yii\data\ActiveDataProvider;
/* use frontend\actions\CreateAction;
use frontend\actions\UpdateAction;
use frontend\actions\DeleteAction; */

class RoleRightController extends \yii\web\Controller
{

    
    /**
     * 给角色赋予权限
     *
     * @param string $roleid
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionAssign($roleid = '')
    {
        $roleid = RoleRight::findOne(['id' => $roleid])['RoleID'];
        if( $roleid === null ) {
            //Yii::$app->getSession()->setFlash('error', yii::t('app', 'Role does not exists'));
            //return $this->redirect(['index']);
            /* $flightarrs['code']="10001";
			$flightarrs['msg']="请求成功";
			$flightarrs['data']=array(array());
			$flightarrs['code']="10003";
			$flightarrs['msg']="请求成功,数据为空";
			$flightarrs['data']=array(array()); */
        	$flightarrs['code']="10003";
        	$flightarrs['msg']="请登录…";
        	$flightarrs['data']=array(array());
			return \yii\helpers\Json::encode($flightarrs);
        }
        if (yii::$app->getRequest()->getIsPost()) {//post数据
            $role_id = yii::$app->getRequest()->get('RoleID');//角色id
            if( $role_id != 1 ) {//超级管理员无需写入权限信息
                $temp = yii::$app->getRequest()->post('ids', '');
                $roleids = [];
                if (! empty($temp)) {
                    $roleids = explode(',', $temp);
                }
                $model = new RoleRight();
                $model->assignPermission($role_id, $roleids);
            }
            Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
            return $this->redirect(['assign', 'id' => yii::$app->request->get('id', '')]);
        }
        $model = RoleRight::findAll(['role_id' => $roleid]);
        $treeJson = Menu::getfrontendMenuJson();
        if( $roleid == 1 ){//超级管理员拥有所有权限，且不能被修改
            $treeJson = json_decode($treeJson, true);
            foreach ($treeJson as &$v){
                $v['state'] = [
                    'selected' => true,
                    'disabled' => true,
                ];
                if( isset($v['children']) ){
                    $v['children'] = self::_defaultSuperAdministrator($v['children']);
                }
            }
            $treeJson = json_encode($treeJson);
        }
        return $this->render('assign', [
            'model' => $model,
            'treeJson' => $treeJson,
            'role_name' => $roleName,
        ]);
    }

    /**
     * 默认超管的所有权限选中
     *
     * @param $children
     * @return mixed
     */
    private static function _defaultSuperAdministrator($children)
    {
        foreach ($children as &$v) {
            $v['state'] = ['selected' => true, 'disabled' => true];
            if( isset($v['state']) ) $v['children'] = self::_defaultSuperAdministrator($v['children']);
        }
        return $children;
    }

}