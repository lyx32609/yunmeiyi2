<?php
namespace frontend\models;

use Yii;

/**
 * tb_role_right角色权限表
 RoleID	int(11)		
RoleRights		可访问模块ID串，半角逗号隔开
OrganizationID	机构id
StateType	用户状态1正常2停用
CreateTime	NO		
 */
class RoleRight extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_role_right';
    }
    public function rules()
    {
    	return [
    	[['role_id', 'menu_id', 'created_at', 'updated_at'], 'integer'],
    	];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [
    	'id' => Yii::t('app', 'ID'),
    	'role_id' => Yii::t('app', 'Role Id'),
    	'menu_id' => Yii::t('app', 'Menu Id'),
    	'name' => Yii::t('app', 'Name'),
    	'url' => Yii::t('app', 'Url'),
    	'method' => yii::t('app', 'Method'),
    	'created_at' => Yii::t('app', 'Created At'),
    	'updated_at' => Yii::t('app', 'Updated At'),
    	];
    }
    
    /**
     * 为角色赋予权限
     *
     * @param integer $roleId 角色id
     * @param array $ids 需要授权的菜单id数组
     */
    public function assignPermission($roleId, $ids)
    {
    	$oldPermissionIds = self::find()->where(['role_id' => $roleId])->indexBy('menu_id')->column();
    	$needAddIds = array_diff($ids, $oldPermissionIds);
    	if (! empty($needAddIds)) {
    		foreach ($needAddIds as $menuId) {//新增
    			//$permissions = Menu::getAncectorsByMenuId($menuId);
    			//$permissions[] = ['id' => $menuId];
    			$permissions = array_column($permissions, 'id');
    			foreach ($permissions as $v) {
    				$result = self::findOne(['role_id' => $roleId, 'menu_id' => $v]);
    				if ($result != null) {
    					continue;
    				}
    				$model = new self();
    				$model->role_id = $roleId;
    				$model->menu_id = $v;
    				$model->save();
    			}
    		}
    	}
    	$ancestors = [];
    	foreach ($ids as $id){//jstree在子类没有全选时，没传祖先节点id，故此补上
    		$ancestors = array_merge($ancestors, Menu::getAncectorsByMenuId($id));
    	}
    	$ancestors = array_column($ancestors, 'id');
    	$needRemoveIds = array_diff(array_keys($oldPermissionIds), array_merge($ancestors, $ids));//删除
    	if (! empty($needRemoveIds)) {
    		$removeIdsStr = implode(",", $needRemoveIds);
    		self::deleteAll("menu_id in($removeIdsStr) && role_id=$roleId");
    	}
    }
    
    /**
     * 根据角色id获取所有权限路由
     *
     * @param $role_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getPermissionsByRoleId($role_id)
    {
    	return self::find()->leftJoin(Menu::tableName(), Menu::tableName() . '.id=' . self::tableName() . '.menu_id')->where(['role_id' => $role_id])->select('*')->asArray()->all();
    }
    
    /**
     * 检查管理员是否有权限访问此路由
     *
     * @param string $route 路由
     * @param string $uid 管理员id
     * @return bool
     */
    public function checkPermission($route, $uid = '')
    {
    	if ($uid == '') {
    		$uid = yii::$app->getUser()->getIdentity()->getId();
    	}
    	$role_id = AdminRoleUser::getRoleIdByUid($uid);
    	$permissions = self::getPermissionsByRoleId($role_id);//var_dump($permissions);die;
    	foreach ($permissions as $v) {
    		if (strtolower($v['url']) == strtolower($route)) {
    			return true;
    		}
    	}
    	return false;
    }
	
	
}
