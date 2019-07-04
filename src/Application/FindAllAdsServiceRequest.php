<?php


namespace App\Application;


class FindAllAdsServiceRequest
{
    private $sortedBy;
    private $direction;
    private $page;

    public function __construct($sortedBy='id', $direction='ASC', $page=0)
    {
        $this->sortedBy = $sortedBy;
        $this->direction = $direction;
        $this->page = $page;
    }

    /**
     * @return null
     */
    public function getSortedBy()
    {
        return $this->sortedBy;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

}