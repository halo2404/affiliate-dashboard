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
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="blogposts")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id", nullable=false)
     */
    private $affiliateTag;

    /**
     * @ORM\OneToMany(targetEntity="BlogpostUser" , mappedBy="blogpost" , cascade={"all"})
     */
    private $blogpostUser;

    function __construct()
    {
        $this->blogpostUser = new ArrayCollection();
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getTitle();
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
     * @return Tag
     */
    public function getAffiliateTag()
    {
        return $this->affiliateTag;
    }

    /**
     * Set affiliateTag
     *
     * @param Tag $affiliateTag
     */
    public function setAffiliateTag($affiliateTag)
    {
        $this->affiliateTag = $affiliateTag;
    }

    /**
     * @return BlogpostUser[]
     */
    public function getBlogpostUser()
    {
        return $this->blogpostUser;
    }

    /**
     * @param mixed $blogpostUser
     */
    public function setBlogpostUser($blogpostUser)
    {
        $this->blogpostUser = $blogpostUser;
    }

    /**
     * @param BlogpostUser $bu
     * @return Blogpost
     */
    public function addBlogpostUser(BlogpostUser $bu)
    {
        if (!$this->blogpostUser->contains($bu)) {
            $bu->setBlogpost($this);
            $this->blogpostUser->add($bu);
        }

        return $this;
    }

    /**
     * @param BlogpostUser $bu
     * @return bool
     */
    public function removeBlogpostUser(BlogpostUser $bu)
    {
        return $this->blogpostUser->removeElement($bu);
    }
}