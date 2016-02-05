<?php

namespace AffiliateDashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * BlogpostUser
 *
 * @ORM\Entity
 * @ORM\Table(name="blogpost_user", uniqueConstraints={@UniqueConstraint(name="bogpostuser_unique", columns={"blogpost_id", "user_id"})})
 * @ORM\HasLifecycleCallbacks()
 */
class BlogpostUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Blogpost", inversedBy="blogpostUser")
     * @ORM\JoinColumn(name="blogpost_id", referencedColumnName="id", nullable=false)
     * */
    private $blogpost;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="blogpostUser")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * */
    private $user;

    /**
     * @var float
     *
     * @ORM\Column(name="percentage", type="float")
     */
    private $percentage = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBlogpost()
    {
        return $this->blogpost;
    }

    /**
     * @param mixed $blogpost
     */
    public function setBlogpost($blogpost)
    {
        $this->blogpost = $blogpost;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return float
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param float $percentage
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }
}

