<?php

namespace orionmax\yii\videohosting;

use orionmax\yii\videohosting\services\VideoHosting;
use Yii;
use yii\validators\Validator;

class VideoHostingValidator extends Validator
{
    public function init()
    {
        parent::init();
        $this->message = Yii::t('app', 'Media hosting is not supported');
    }

    public function validateAttribute($model, $attribute)
    {
        if (!empty($model->$attribute) && VideoHosting::getHosting($model->$attribute) === null) {
            $this->addError($model, $attribute, $this->message);
        }
    }
}