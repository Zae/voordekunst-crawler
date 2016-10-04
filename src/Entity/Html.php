<?php

namespace Vpl\VdkCrawler\Entity;

class Html
{
    /**
     * @var int
     */
    private $projectId;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $html;

    /**
     * @param int $projectId
     * @param string $url
     * @param string $html
     */
    public function __construct($projectId, $url, $html)
    {
        $this->projectId = $projectId;
        $this->url = $url;
        $this->html = $html;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }
    }
