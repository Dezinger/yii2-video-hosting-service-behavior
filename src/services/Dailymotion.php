<?php

namespace orionmax\yii\videohosting\services;


class Dailymotion extends VideoHosting
{
    protected function __construct($url, $hostingUrls, $hostingName)
    {
        parent::__construct($hostingUrls, $hostingName);

        $this->videoId = pathinfo(parse_url($url, PHP_URL_PATH))['basename'];
        $this->infoFunction = function () {
            return json_decode(file_get_contents($this->hostingUrls['info'] . $this->videoId .
                '?fields=title,description,thumbnail_medium_url,owner.username'), true);
        };
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getVideoInfo()['title'];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getVideoInfo()['description'];
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->getVideoInfo()['owner.username'];
    }

    /**
     * @return string
     */
    public function getImagePreview()
    {
        return $this->getVideoInfo()['thumbnail_medium_url'];
    }
}