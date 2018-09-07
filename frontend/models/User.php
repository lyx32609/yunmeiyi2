<?php
namespace frontend\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
	const DISPLAY_YES = 1;
	const DISPLAY_NO = 0;
//     const STATUS_DELETED = 0;
//     const STATUS_ACTIVE = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_user';
    }
	public function getId()
    {
        return $this->getPrimaryKey();
    }
	
}