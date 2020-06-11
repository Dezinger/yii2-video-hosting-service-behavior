<?php

use orionmax\yii\videohosting\tests\models\Article;

class BehaviorTest extends \PHPUnit_Framework_TestCase
{
    private $articles;

    private $urls;

    public function setUp()
    {
        parent::setUp();
        Article::deleteAll();

        $urls = require(__DIR__ . '/data/urls.php');
        $this->urls = $urls['correct'];
        foreach ($this->urls as $url) {
            Yii::$app->db->createCommand()->insert(Article::tableName(), ['video' => $url])->execute();
        }
        $this->articles = Article::find()->all();
    }

    public function testGetVideoHostingName()
    {
        foreach ($this->articles as $article) {
            $this->assertArrayHasKey($article->videoHostingName, $this->urls,
                'get videoHostingName ' . $article->videoHostingName);
        }
    }

    public function testGetVideoIframe()
    {
        foreach ($this->articles as $article) {
            $this->assertInternalType('string', filter_var($article->videoIframe, FILTER_VALIDATE_URL),
                'get videoIframe ' . $article->videoHostingName);
        }
    }

    public function testGetVideoTitle()
    {
        foreach ($this->articles as $article) {
            $this->assertInternalType('string', $article->videoTitle,
                'get videoTitle ' . $article->videoHostingName);
        }
    }

    public function testGetVideoDescription()
    {
        foreach ($this->articles as $article) {
            $this->assertInternalType('string', $article->videoDescription,
                'get videoDescription ' . $article->videoHostingName);
        }
    }

    public function testGetVideoAuthor()
    {
        foreach ($this->articles as $article) {
            $this->assertInternalType('string', $article->videoAuthor,
                'get videoAuthor ' . $article->videoHostingName);
        }
    }

    public function testGetVideoPreview()
    {
        foreach ($this->articles as $article) {
            $pr = $article->videoPreview;
            $this->assertInternalType('string', filter_var($article->videoPreview, FILTER_VALIDATE_URL),
                'get videoPreview ' . $article->videoHostingName);
        }
    }
}