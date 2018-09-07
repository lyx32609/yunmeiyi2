<?php
namespace frontend\models;
use Yii;
  
class Sign{

	/**
     * ����Ϸ�����֤
     * @param \app\models\Api $model
     */
    protected function validate($model, &$params)
    {

        $sigStr = '';
        $s = '';
        $appid = '';

        if(isset($params['s']))
        {
            $s = $params['s'];
            unset($params['s']);
        }

        if(isset($params['x']))
        {
            $this->x = $params['x'];
            unset($params['x']);
        }

        if(isset($params['appid']))
        {
            $appid = $params['appid'];
        }

        ksort($params);

        $clientInfo = ApiClient::findOne($appid);

        if(!$clientInfo || $clientInfo['module_id'] != \Yii::$app->id)
        {
            return ApiCode::APPID_NOT_EXIST;
        }

        $appkey = $clientInfo['appkey'].'&';

        $notSignParams = explode(',', $model->not_sign_params);

        foreach($params as $key=>$item)
        {
            if(!in_array($key, $notSignParams))
            {
                $sigStr .= '&'.$key.'='.$item;
            }
        }

        $signature = base64_encode(hash_hmac('sha1', urlencode($sigStr), strtr($appkey, '-_', '+/'), true));
      
        if($s != $signature)
        {
            return ApiCode::SIGNATURE_ERROR;
        }

        $this->accessContext->appid = $$appid;
        $this->accessContext->appkey = $clientInfo['appkey'];

        return true;
    }
}