<?php

namespace orionmax\yii\videohosting\tests\models;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property string $video
 *
 * @property string $videoHostingName
 * @property string $videoPreview
 * @property string $videoIframe
 * @property string $videoTitle
 * @property string $videoAuthor
 * @property string $videoDescription
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['video', \orionmax\yii\videohosting\VideoHostingValidator::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \orionmax\yii\videohosting\VideoHostingBehavior::className(),
                'attribute' => 'video'
            ],
        ];
    }
}