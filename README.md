coldfox/yii2-dropzone
==============


Yii2 Dropzone Extention , Supports sorting

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist codefox/yii2-dropzone "*"
```

or add

```
"codefox/yii2-dropzone": "*"
```

to the require section of your `composer.json` file.


Use
-----

Once the extension is installed, simply use it in your code by  :

>Controller Example

```php
    <?php
    public function actions(){
            return [
                'upload' => [
                    'class' => 'coldfox\dropzone\DropZoneUploadAction',
                    'config' => [
                        "filePathFormat" => "/uploads/source_code/".date('Ymd').'/', //上传保存路径
                        "fileRoot" => Yii::getAlias("@uploadRoot"),//上传根目录
                    ],
                ],
                'remove' => [
                    'class' => 'coldfox\dropzone\RemoveAction',
                    'config' => [
                        "fileRoot" => Yii::getAlias("@uploadRoot"),//上传根目录
                    ],
                ],
            ];
        }
   
   ```
    
>view Example   详情`\你的项目\vendor\coldfox\yii2-dropzone\AbstractDropZone.php`的注释（我感觉已经很详细了）
    
   ```php
    <?php
    echo \coldfox\dropzone\DropZone::widget();
    //Or
    echo \coldfox\dropzone\DropZone::widget(
        [
            //开启拖拽排序        
            'sortable'=>true,
            /**
             * Sortable配置参数
             * 详情参阅 https://github.com/RubaXa/Sortable#options
             * @var array
             */
            'sortableOption' => [],
            //回显的数据 内容我格式大概就这样子
            'mockFiles'=>['/uploads/image/20180107152242/xxxxxx.jpg','/uploads/image/20180107152242/xxxxxxx.jpg'],
            /*
            * dropzone配置选项，
            * 详情参阅 http://www.dropzonejs.com/#configuration-options
            * @var array
            */
            'clientOptions' => [
                'maxFiles'=>5,
                'maxFilesize' => '7',
                'autoProcessQueue'=>false,
                'dictCancelUpload'=>'取消上传',
                'dictRemoveFile'=>'删除文件',
                'addRemoveLinks'=>true
            ],
           /**dropzone事件侦听
            * 详情参阅 http://www.dropzonejs.com/#event-list
            * @var array
            */
            'clientEvents'=>[
                'success'=>'function (file, response) {console.log(response)}',
            ]
        ]
    );

    //Or
    echo $form->field($model, 'file')->widget('coldfox\dropzone\DropZone', [
        'sortable'=>true,
        'clientOptions' => [
            'maxFilesize' => '7',
            'autoProcessQueue'=>true,
            'dictCancelUpload'=>'取消上传',
            'dictRemoveFile'=>'删除文件',
            'addRemoveLinks'=>true
        ]
    ]);

    
    //Or
    echo \coldfox\dropzone\DropZone::widget([
        'sortable'=>true,
        'model' => $model,
        'attribute' => 'file',
        'clientOptions' => [
            'maxFilesize' => '7',
            'autoProcessQueue'=>true,
            'dictCancelUpload'=>'取消上传',
            'dictRemoveFile'=>'删除文件',
            'addRemoveLinks'=>true
        ]
    ]);
    ?>

   ```
> 基于twitf/dropzone修改

    