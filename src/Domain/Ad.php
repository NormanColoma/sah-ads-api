<?php


namespace App\Domain;


class Ad
{
    private $id;
    private $title;
    private $link;
    private $city;
    private $image;

    public function __construct(string $id, string $title, string $link, string $city, string $image)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setLink($link);
        $this->setCity($city);
        $this->setImage($image);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @throws AdNotValidException
     */
    public function setId($id): void
    {
        if (!is_string($id)) {
            throw new AdNotValidException('Ad has not valid id');
        }
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @throws AdNotValidException
     */
    public function setCity($city): void
    {
        if (!is_string($city)) {
            throw new AdNotValidException('Ad has no valid city');
        }
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @throws AdNotValidException
     */
    public function setImage($image): void
    {
        if (!preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $image)) {
            throw new AdNotValidException('Ad has no valid image link');
        }
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     * @throws AdNotValidException
     */
    public function setLink($link): void
    {
        if (!preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $link)) {
            throw new AdNotValidException('Ad has no valid link');
        }
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @throws AdNotValidException
     */
    public function setTitle($title): void
    {
        if (!is_string($title)) {
            throw new AdNotValidException('Ad has no valid title');
        }
        $this->title = $title;
    }
}