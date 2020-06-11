<?php

namespace orionmax\yii\videohosting\services;


class Facebook extends VideoHosting
{
    protected function __construct($url, $hostingUrls, $hostingName)
    {
        parent::__construct($hostingUrls, $hostingName);

        $this->videoId = pathinfo(parse_url($url, PHP_URL_PATH))['basename'];
        $this->infoFunction = function() {
            return json_decode(file_get_contents($this->hostingUrls['info'] . $this->videoId), true);
        };
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        if (array_key_exists('name', $this->getVideoInfo())) {
            return $this->getVideoInfo()['name'];
        } else {
            return 'Untitled';
        }
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
        return $this->getVideoInfo()['from']['name'];
    }

    /**
     * @return string
     */
    public function getImagePreview()
    {
        return $this->getVideoInfo()['picture'];
    }
}