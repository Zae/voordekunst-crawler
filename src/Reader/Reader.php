<?php

namespace Vpl\VdkCrawler\Reader;

use Vpl\VdkCrawler\Entity\Html;
use Vpl\VdkCrawler\Exception\VdkReadException;

class Reader
{
    const BASE_URL = 'https://www.voordekunst.nl/projecten';

    /**
     * @var string
     */
    private $projectSlug;

    /**
     * @param string $projectSlug
     */
    public function __construct($projectSlug)
    {
        $this->projectSlug = $projectSlug;
    }

    /**
     * @return Html
     * @throws VdkReadException
     */
    public function getPageHtml()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_URL => $this->getProjectUrl()
        ]);

        $response = curl_exec($curl);
        if ($response === false) {
            throw new VdkReadException(curl_error($curl), curl_errno($curl));

        }
        curl_close($curl);

        return new Html($this->getProjectId(), $this->getProjectUrl(), $response);
    }

    /**
     * parse first part of projectSlug
     * @return int
     * @throws VdkReadException
     */
    private function getProjectId()
    {
        $slugParts = explode('-', $this->projectSlug);
        if (!count($slugParts)) {
            throw new VdkReadException('Cannot parse projectId from projectSlug');
        }

        return $slugParts[0];
    }

    /**
     * @return string
     */
    private function getProjectUrl()
    {
        return sprintf('%s/%s', self::BASE_URL, $this->projectSlug);
    }
}
