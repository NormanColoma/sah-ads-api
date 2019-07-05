<?php


namespace App\Application;


class FindAllAdsServiceRequest
{
    private $sortedBy;
    private $direction;
    private $page;

    public function __construct($sortedBy='id', $direction=1, $page=0)
    {
        $this->sortedBy = $sortedBy;
        $this->direction = $direction;
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getSortedBy(): string
    {
        return $this->sortedBy;
    }

    /**
     * @return int
     */
    public function getDirection(): int
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