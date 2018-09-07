<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use common\models\TourRouteevent;
/**
 * 旅游线路日程事件控制器
 */
class TourRouteeventController extends Controller
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
    //旅游线路日程事件列表
    public function actionIndex()
    {
        return $this->render('index');
    }
	//添加旅游线路日程事件
	public function actionAdd(){
		return $this->render('add');
	}
	//修改旅游线路日程事件
	public function actionEdit(){
		return $this->render('edit');
	}
	//删除旅游线路日程事件
	public function actionDel(){
		//处理逻辑
	}
}
