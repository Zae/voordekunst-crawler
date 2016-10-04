<?php

namespace Vpl\VdkCrawler\Entity;

class Project
{
    /**
     * @var Html
     */
    private $html;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $donatedAmount;

    /**
     * @var string
     */
    private $goalAmount;

    /**
     * @var string
     */
    private $numDonors;

    /**
     * @var string
     */
    private $percentageDonated;

    /**
     * @var string
     */
    private $numDaysLeft;

    public function __construct(
        Html $html,
        $title,
        $donatedAmount,
        $goalAmount,
        $numDonors,
        $percentageDonated,
        $numDaysLeft)
    {
        $this->html = $html;
        $this->title = $title;
        $this->donatedAmount = $donatedAmount;
        $this->goalAmount = $goalAmount;
        $this->numDonors = $numDonors;
        $this->percentageDonated = $percentageDonated;
        $this->numDaysLeft = $numDaysLeft;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->html->getProjectId();
    }

    /**
     * @return string
     */
    public function getProjectUrl()
    {
        return $this->html->getUrl();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDonatedAmount()
    {
        return $this->donatedAmount;
    }

    /**
     * @return string
     */
    public function getGoalAmount()
    {
        return $this->goalAmount;
    }

    /**
     * @return string
     */
    public function getNumDonors()
    {
        return $this->numDonors;
    }

    /**
     * @return string
     */
    public function getPercentageDonated()
    {
        return $this->percentageDonated;
    }

    /**
     * @return string
     */
    public function getNumDaysLeft()
    {
        return $this->numDaysLeft;
    }
}
