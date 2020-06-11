<?php

namespace orionmax\yii\videohosting\services;

abstract class VideoHosting
{
    /**
     * @var string
     */
    protected $videoId;

    /**
     * @var array
     */
    protected $hostingUrls;

    /**
     * @var string
     */
    protected $hostingName;

    /**
     * @var callable
     */
    protected $infoFunction;

    /**
     * @var array|null
     */
    protected $videoInfo = null;


    protected function __construct($hostingUrls, $hostingName)
    {
        $this->hostingName = $hostingName;
        $this->hostingUrls = $hostingUrls['urls'][$hostingName];
    }

    /**
     * @param string $url
     * @return self|null
     */
    public static function getHosting($url)
    {
        if (!empty($url)) {
            $hostingUrls = require(__DIR__ . '/common/hosting-urls.php');
            foreach ($hostingUrls['patterns'] as $hostingName => $patterns) {
                foreach ($patterns as $pattern) {
                    if (preg_match($pattern, $url)) {
                        $hostingClass = __NAMESPACE__ . '\\' . $hostingName;

                        return new $hostingClass($url, $hostingUrls, $hostingName);
                    }
                }
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getHostingName()
    {
        return $this->hostingName;
    }

    /**
     * @return string
     */
    public function getIframeContent()
    {
        return $this->hostingUrls['iframe'] . $this->videoId;
    }

    /**
     * @return string
     */
    abstract public function getTitle();

    /**
     * @return string
     */
    abstract public function getDescription();

    /**
     * @return string
     */
    abstract public function getAuthor();

    /**
     * @return string
     */
    abstract public function getImagePreview();

    /**
     * @return array
     */
    protected function getVideoInfo()
    {
        if ($this->videoInfo === null) {
            $infoFunction = $this->infoFunction;
            $this->videoInfo = $infoFunction();
        }
        return $this->videoInfo;
    }
}