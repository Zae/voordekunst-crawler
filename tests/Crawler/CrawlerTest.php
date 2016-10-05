<?php

namespace Vpl\VdkCrawler\Crawler;

use Vpl\VdkCrawler\Crawler\Crawler;
use Vpl\VdkCrawler\Entity\Html;
use Vpl\VdkCrawler\Reader\Reader;

class CrawlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Crawler
     */
    private $crawler;

    public function setUp()
    {
        $this->crawler = new Crawler();
    }

    /**
     * @param int $projectId
     * @param string $htmlString
     * @dataProvider validHtmlDataProvider
     */
    public function testValidHtml($projectId, $htmlString) {
        $html = new Html($projectId, $this->getProjectUrl($projectId), $htmlString);
        $project = $this->getCrawler()->getProjectData($html);

        $this->assertInstanceOf('Vpl\VdkCrawler\Entity\Project', $project);
    }

    /**
     * @param int $projectId
     * @param string $htmlString
     * @dataProvider invalidHtmlDataProvider
     * @expectedException Vpl\VdkCrawler\Exception\VdkCrawlException
     */
    public function testInvalidHtml($projectId, $htmlString) {

        $html = new Html($projectId, $this->getProjectUrl($projectId), $htmlString);
        $this->getCrawler()->getProjectData($html);
    }

    /**
     * @return array
     */
    public function validHtmlDataProvider()
    {
        return [
            [1, file_get_contents('tests/fixtures/project_active.html')],
            [2, file_get_contents('tests/fixtures/project_finished.html')]
        ];
    }

    /**
     * @return array
     */
    public function invalidHtmlDataProvider()
    {
        return [
            [1, file_get_contents('tests/fixtures/project_invalid.html')],
        ];
    }

    private function getCrawler()
    {
        return $this->crawler;
    }

    /**
     * @param int $projectId
     * @return string
     */
    private function getProjectUrl($projectId)
    {
        return sprintf(
            '%s/%d/%s',
            Reader::BASE_URL,
            $projectId,
            'slug-of-project'
        );
    }
}
