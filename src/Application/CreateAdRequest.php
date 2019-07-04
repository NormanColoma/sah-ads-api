<?php


namespace App\Application;


class CreateAdRequest
{
    private $id;
    private $title;
    private $link;
    private $city;
    private $image;

    public function __construct($id, $title, $link, $city, $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->link = $link;
        $this->city = $city;
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }
}