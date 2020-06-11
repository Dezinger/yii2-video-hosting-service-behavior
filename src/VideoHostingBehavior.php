<?php

namespace orionmax\yii\videohosting;

use orionmax\yii\videohosting\services\VideoHosting;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\BaseActiveRecord;

class VideoHostingBehavior extends Behavior
{
    public $attribute;

    /**
     * @var \orionmax\yii\videohosting\services\VideoHosting
     */
    private $videoHosting = null;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if ($this->attribute === null) {
            throw new InvalidConfigException('The "attribute" property must be set.');
        }
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    public function afterFind()
    {
        /** @var \yii\db\BaseActiveRecord $model */
        $model = $this->owner;
        $this->videoHosting = VideoHosting::getHosting($model->getAttribute($this->attribute));
    }

    /**
     * @return string
     */
    public function getVideoHostingName()
    {
        return $this->videoHosting->getHostingName();
    }

    /**
     * @return string
     */
    public function getVideoTitle()
    {
        return $this->videoHosting->getTitle();
    }

    /**
     * @return string
     */
    public function getVideoDescription()
    {
        return $this->videoHosting->getDescription();
    }

    /**
     * @return string
     */
    public function getVideoAuthor()
    {
        return $this->videoHosting->getAuthor();
    }

    /**
     * @return string|null
     */
    public function getVideoIframe()
    {
        return $this->videoHosting->getIframeContent();
    }

    /**
     * @return string|null
     */
    public function getVideoPreview()
    {
        return $this->videoHosting->getImagePreview();
    }

}