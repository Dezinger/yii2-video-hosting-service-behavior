<?php

namespace orionmax\yii\videohosting\services;

class YouTube extends VideoHosting
{
    protected function __construct($url, $hostingUrls, $hostingName)
    {
        parent::__construct($hostingUrls, $hostingName);

        parse_str(parse_url($url, PHP_URL_QUERY), $args);
        if (array_key_exists('v', $args)) {
            $this->videoId = $args['v'];
        } else {
            $this->videoId = substr(parse_url($url, PHP_URL_PATH), 1);
        }

        $this->infoFunction = function() {
            return json_decode(file_get_contents($this->hostingUrls['info'] . $this->videoId), true);
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
        return $this->getVideoInfo()['title'];
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->getVideoInfo()['author_name'];
    }

    /**
     * @return string
     */
    public function getImagePreview()
    {
        return $this->getVideoInfo()['thumbnail_url'];
    }
}