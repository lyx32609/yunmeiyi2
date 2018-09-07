<?php
namespace frontend\models;
use Yii;

class TicketCabin extends \yii\db\ActiveRecord
{
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_airticket_cabin';
    }

}
