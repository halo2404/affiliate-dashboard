<?php

namespace AffiliateDashboardBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Blogpost
 *
 * @ORM\Table(name="blogpost")
 * @ORM\Entity(repositoryClass="AffiliateDashboardBundle\Repository\BlogpostRepository")
 */
class Blogpost
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime")
     */
    private $publishedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="affiliate_tag", type="string", length=255)
     */
    private $affiliateTag;

    /**
     * @ORM\OneToMany(targetEntity="BlogpostUser" , mappedBy="blogpost" , cascade={"all"})
     */
    private $blogpostUser;

    private $users;

    function __construct()
    {
        $this->blogpostUser = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    function __toString()
    {
        return $this->getTitle();
    }

    public function getUser()
    {
        $users = new ArrayCollection();

        foreach ($this->blogpostUser as $bu) {
            $users[] = $bu->getUser();
        }

        return $users;
    }

    public function setUser($users)
    {
        foreach ($users as $user) {
            $bu = new BlogpostUser();

            $bu->setBlogpost($this);
            $bu->setUser($user);

            $this->addBlogpostUser($bu);
        }
    }

    public function getBlogpost()
    {
        return $this;
    }

    public function addBlogpostUser($blogpostUser)
    {
        $this->blogpostUser[] = $blogpostUser;
    }

    public function removeBlogpostUser($blogpostUser)
    {
        return $this->blogpostUser->removeElement($blogpostUser);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Blogpost
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Blogpost
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Blogpost
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get affiliateTag
     *
     * @return string
     */
    public function getAffiliateTag()
    {
        return $this->affiliateTag;
    }

    /**
     * Set affiliateTag
     *
     * @param string $affiliateTag
     */
    public function setAffiliateTag($affiliateTag)
    {
        $this->affiliateTag = $affiliateTag;
    }

    /**
     * @return mixed
     */
    public function getBlogpostUser()
    {
        return $this->blogpostUser;
    }
}

