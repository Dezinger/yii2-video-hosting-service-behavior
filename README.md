Video hosting service behavior for Yii2 Framework
=================================================
Simple behavior which lets you embed the video from popular video sharing sites on your website. It also allows you to get a thumbnail and other information about the video.  
Currently the behavior supports following video sharing sites: YouTube, Vimeo, Dailymotion, Rutube, video from Facebook.

Installation
------------
Install with composer:
```bash
composer require orionmax/yii2-video-hosting-service-behavior
```
or add
```bash
"orionmax/yii2-video-hosting-service-behavior": "*"
```
to the require section of your composer.json file.

Usage
-----
Attach the behavior in your model:
```php
use orionmax\yii\videohosting\VideoHostingBehavior

class Article extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => VideoHostingBehavior::className(),
                'attribute' => 'video'
            ],
        ];
    }
}
```
You can also declare validation rule for the attribute:
```php
use orionmax\yii\videohosting\VideoHostingValidator

class ArticleForm extends Model
{
    public function rules()
    {
        return [
            ['video', VideoHostingValidator::className()],
        ];
    }
}
```
Example view file:
```php
<?php if($model->video): ?>
    <div>
      <h2><?= Html::encode($model->videoTitle) ?></h1>
      <p>Video Hosting Service: <?= $model->videoHostingName ?></p>
      <iframe class="embed-responsive-iframe" src="<?= $model->videoIframe ?>" frameborder="0" allowfullscreen></iframe>
      <img src="<?= $model->videoPreview ?>">
      <p>Author: <?= Html::encode($model->videoAuthor) ?></p>
      <h3>Description</h2>
      <p><?= HtmlPurifier::process($model->videoDescription) ?></p>
    </div>
<?php endif; ?>
```

Behavior Options
----------------
* attribute - The attribute which holds the attachment







