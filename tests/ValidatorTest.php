<?php

use orionmax\yii\videohosting\tests\models\Article;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $urls;

    public function setUp()
    {
        parent::setUp();
        Article::deleteAll();
        $this->urls = require(__DIR__ . '/data/urls.php');
    }

    public function testValidateCorrectValues()
    {
        $article = new Article();
        $urls = $this->urls['correct'];


        foreach ($urls as $hosting => $url) {
            $article->video = $url;
            $this->assertTrue($article->validate(), 'validate correct value ' . $hosting);
        }
    }

    public function testValidateWrongValues()
    {
        $article = new Article();
        $urls = $this->urls['wrong'];

        foreach ($urls as $num => $url) {
            $article->video = $url;
            $this->assertFalse($article->validate(), 'validate wrong value ' . $num);
            $this->assertArrayHasKey('video', $article->getErrors(), 'check existed video error ' . $num);
        }
    }
}