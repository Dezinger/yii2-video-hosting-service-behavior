<?php

namespace orionmax\yii\videohosting\services;


class Rutube extends VideoHosting
{
    protected function __construct($url, $hostingUrls, $hostingName)
    {
        parent::__construct($hostingUrls, $hostingName);

        $this->videoId = pathinfo(parse_url($url, PHP_URL_PATH))['basename'];
        $this->infoFunction = function() {
            return json_decode(file_get_contents($this->hostingUrls['info'] . $this->videoId . '/?format=json'), true);
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
        return $this->getVideoInfo()['short_description'];
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->getVideoInfo()['author']['name'];
    }

    /**
     * @return string
     */
    public function getImagePreview()
    {
        return $this->getVideoInfo()['thumbnail_url'];
    }
}