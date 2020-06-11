<?php

namespace orionmax\yii\videohosting\services;

class Vimeo extends VideoHosting
{
    protected function __construct($url, $hostingUrls, $hostingName)
    {
        parent::__construct($hostingUrls, $hostingName);

        $this->videoId = substr(parse_url($url, PHP_URL_PATH), 1);
        $this->infoFunction = function() {
            return unserialize(file_get_contents($this->hostingUrls['info'] . $this->videoId . '.php'));
        };
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getVideoInfo()[0]['title'];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getVideoInfo()[0]['description'];
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->getVideoInfo()[0]['user_name'];
    }

    /**
     * @return string
     */
    public function getImagePreview()
    {
        return $this->getVideoInfo()[0]['thumbnail_medium'];
    }
}