<?php

namespace Vpl\VdkCrawler\Crawler;

use Vpl\VdkCrawler\Entity\Html;
use Vpl\VdkCrawler\Entity\Project;
use Vpl\VdkCrawler\Exception\VdkCrawlException;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class Crawler
{
    public function getProjectData(Html $html)
    {
        try {
            $crawler = new DomCrawler();
            $crawler->addHtmlContent($html->getHtml());

            $title = trim($crawler->filter('h1')->first()->text());
            $donatedAmount = trim($crawler->filter('strong.donated__amount')->first()->text());
            $goalAmount = trim($crawler->filter('span.donated__goal')->first()->text());
            $nodeCrawler = $crawler->filter('div.funding__donors')->first();
            $numDonors = trim($nodeCrawler->filter('strong')->first()->text());
            $percentageDonated = trim($crawler->filter('div.progress-bar')->first()->attr('aria-valuenow'));
            $numDaysLeft = trim($crawler->filter('strong.daysleft__days')->first()->text());
            $numDaysLeftText = trim($crawler->filter('span.daysleft__text')->first()->text());
        } catch (\Exception $e) {
            throw new VdkCrawlException($e->getMessage());
        }

        return new Project(
            $html,
            $title,
            trim(ltrim($donatedAmount, '€')),
            trim(ltrim($goalAmount, '€')),
            $numDonors,
            $percentageDonated,
            sprintf('%d %s', $numDaysLeft, $numDaysLeftText)
        );
    }
}
