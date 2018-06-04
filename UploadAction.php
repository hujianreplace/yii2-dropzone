<?php

namespace coldfox\dropzone;

use yii\helpers\Json;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\HttpException;
class UploadAction extends \yii\base\Action
{
    public $fileName = 'file';

    public $config = [];

    //保存地址
    public $savePath = '';

    public $saveName = '';

    public function init()
    {
        $_config['fileRoot'] = Yii::getAlias('@webroot');
        $_config['filePathFormat'] = '/uploads/image/' . date('Ymd') . '/';
        $this->config = ArrayHelper::merge($_config, $this->config);
        $this->savePath = $this->config['fileRoot'] . $this->config['filePathFormat'];
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        $uploadedFile = UploadedFile::getInstanceByName($this->fileName);

        if ($uploadedFile === null || $uploadedFile->hasError) {
            throw new HttpException(500, 'Upload Image Error');
        }

        if (!file_exists($this->savePath)) {
            mkdir($this->savePath, 0777, true);
        }

        $this->saveName = date('YmdHis') . '_' . rand(100000, 999999) . '.' . $uploadedFile->getExtension();

        if ($uploadedFile->saveAs($this->savePath . $this->saveName,false)){
            Yii::$app->getResponse()->format=Response::FORMAT_JSON;
            return [ 'status' => 'success','savePath' => $this->config['filePathFormat'] . $this->saveName];
        }
    }
}