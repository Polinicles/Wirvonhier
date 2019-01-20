<?php

namespace Wirvonhier\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Wirvonhier\Domain\Entity\Place")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     */
    private $place;

    /**
     * @ORM\OneToMany(targetEntity="Wirvonhier\Domain\Entity\Post", mappedBy="event")
     */
    private $posts;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type) : void
    {
        $this->type = $type;
    }

    /**
     * @return Place
     */
    public function getPlace() : ?Place
    {
        return $this->place;
    }

    /**
     * @param Place|null $place
     */
    public function setPlace(Place $place = null) : void
    {
        $this->place = $place;
    }

    /**
     * @param Post $post
     */
    public function addPost(Post $post) : void
    {
        $this->posts[] = $post;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }
}