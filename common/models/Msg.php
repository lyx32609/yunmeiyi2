<?php
namespace common\models;
use Yii;
class Msg extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_msg';
    }
	
	
	
}