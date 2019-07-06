<?php


namespace App\Application;


class DownloadAdsAsJsonRequest
{
    private $sortedBy;
    private $direction;
    private $untilPage;

    public function __construct($sortedBy='id', $direction=1, $untilPage=0)
    {
        $this->sortedBy = $sortedBy;
        $this->direction = $direction;
        $this->untilPage = $untilPage;
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
     * @return mixed
     */
    public function getUntilPage()
    {
        return $this->untilPage;
    }

}