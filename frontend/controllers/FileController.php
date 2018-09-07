<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\UploadForm;
class FileController extends Controller
{
	public $enableCsrfValidation = false;
	//
	public function actionImg($name='img',$maxsize=2097152,$dir='',$filename=''){
		//相对于入口文件来说frontend/web下$firstdir最前面加/例'/web/image/$uid'
		if (Yii::$app->request->isPost) {
			$data = \Yii::$app->request->post();
			$images = UploadedFile::getInstancesByName($name);//p($images);die;
			$filepath=array();
			foreach ($images as $k=>$image){
				//$file = UploadedFile::getInstances($model, 'file');p($file);die;
				//$model->file = UploadedFile::getInstance($model, "file");p($model->file);die;
				if ($image->size > $maxsize) {//2048*1024=2097152
					$res = ['error' => '图片文件最大不可超过2M'];
					return json_encode($res);
				}
				if (!in_array(strtolower($image->extension), array('gif', 'jpg', 'jpeg', 'png'))) {
					$res = ['error' => '请上传标准图片文件, 支持gif,jpg,png和jpeg.'];
					return json_encode($res);
				}
				//文件上传存放的目录
				//$dir='E:/workspace/yii2/frontend\web/aa';
				$enddir = Yii::$app->basePath.$dir;//echo  $enddir;die;
				//$enddir='E:\workspace\yii2\frontend/web\uploads/111/2222';
				//$dir='E:\workspace\yii2\frontend/web\uploads';
				if (!is_dir($enddir))mkdir(iconv("UTF-8", "GBK", $enddir),'0777',true);//echo $enddir;die;
				//文件名
				$fileName = $filename.$k.'.'.$image->getExtension();//echo $fileName;die;
				$savefile = $enddir."/". $fileName;//echo $savefile;die;
				if ($image->saveAs($savefile)) {
					$filepath[]= $dir.'/'.$fileName;
				}else{
					$res = ['code' => 10003,'msg' => '上传失败'];
					return json_encode($res);
				}
			}
			$end=['code'=>10001,'msg'=>'','data'=>$filepath];
			return json_encode($filepath);
		}
		return json_encode('接收数据为空');
	}
	
	public function actionYinpin($name='yinpin',$maxsize='默认值',$firstdir,$seconddir='',$filename){
		//相对于入口文件来说frontend/web下$firstdir最前面加/例'/web/image/$uid'
		if (Yii::$app->request->isPost) {
			$data = \Yii::$app->request->post();
			$images = UploadedFile::getInstancesByName($name);//p($images);die;
			$filepath=array();
			foreach ($images as $k=>$image){
				//$file = UploadedFile::getInstances($model, 'file');p($file);die;
				//$model->file = UploadedFile::getInstance($model, "file");p($model->file);die;
				if ($image->size > $maxsize) {
					$res = ['error' => '格式太大'];
					return json_encode($res);
				}
				if (!in_array(strtolower($image->extension), array('mp3', 'ogg','wmv','wma','aiff','midi','vqf','aac','flac','tak','tta','wv'))) {
					$res = ['error' => '格式不正确，请上传正确音频文件'];
					return json_encode($res);
				}
				//文件上传存放的目录
				$dir = Yii::$app->basePath.$firstdir;
				if (!is_dir($dir))mkdir($dir);
				if ($seconddir) {
					$dir = Yii::$app->basePath.$seconddir;
					if (!is_dir($dir))mkdir($dir);//p($v->getExtension());die;
				}
				//文件名
				$fileName = $filename.$image->getExtension();
				$savefile = $dir."/". $fileName;
				if ($image->saveAs($savefile)) {
					$filepath[]=$dir . $filename;
				}else{
					$res = ['error' => '上传失败'];
					return json_encode($res);
				}
			}
			return json_encode($filepath);
		}
		return json_encode('接收数据为空');
	}
    
	public function actionWenzhang($name='Wenzhang',$maxsize='默认值',$firstdir,$seconddir='',$filename){
		//相对于入口文件来说frontend/web下$firstdir最前面加/例'/web/image/$uid'
		if (Yii::$app->request->isPost) {
			$data = \Yii::$app->request->post();
			$images = UploadedFile::getInstancesByName($name);//p($images);die;
			$filepath=array();
			foreach ($images as $k=>$image){
				//$file = UploadedFile::getInstances($model, 'file');p($file);die;
				//$model->file = UploadedFile::getInstance($model, "file");p($model->file);die;
				if ($image->size > $maxsize) {
					$res = ['error' => '格式太大'];
					return json_encode($res);
				}
				if (!in_array(strtolower($image->extension), 
					array('doc','xls','xml','html','htm','xlt','csv','xlw','wk4','wk3','wk1','wd1','wks','wq1','slk','sla','ppt','pps','ppa','dot','rft'))) {
					$res = ['error' => '格式不正确，请上传正确文件'];
					return json_encode($res);
				}
				//文件上传存放的目录
				$dir = Yii::$app->basePath.$firstdir;
				if (!is_dir($dir))mkdir($dir);
				if ($seconddir) {
					$dir = Yii::$app->basePath.$seconddir;
					if (!is_dir($dir))mkdir($dir);//p($v->getExtension());die;
				}
				//文件名
				$fileName = $filename.$image->getExtension();
				$savefile = $dir."/". $fileName;
				if ($image->saveAs($savefile)) {
					$filepath[]=$dir . $filename;
				}else{
					$res = ['error' => '上传失败'];
					return json_encode($res);
				}
			}
			return json_encode($filepath);
		}
		return json_encode('接收数据为空');
	}
	
}
?>