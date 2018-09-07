<?php
namespace frontend\models;

use Yii;

/**
 * Cabin model
 *舱位类型编码表
 */
class Cabin extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_cabin';
    }
	
	
	
}
