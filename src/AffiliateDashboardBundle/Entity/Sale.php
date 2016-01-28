<?php

namespace AffiliateDashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sale
 *
 * @ORM\Table(name="sale")
 * @ORM\Entity(repositoryClass="AffiliateDashboardBundle\Repository\SaleRepository")
 */
class Sale
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
     * @ORM\Column(name="asin", type="string", length=10)
     */
    private $asin;

    /**
     * @var int
     *
     * @ORM\Column(name="category", type="integer", nullable=true)
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="earnings", type="float")
     */
    private $earnings;

    /**
     * @var string
     *
     * @ORM\Column(name="link_type", type="string", length=10)
     */
    private $linkType;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float")
     */
    private $rate;

    /**
     * @var int
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $qty;

    /**
     * @var float
     *
     * @ORM\Column(name="revenue", type="float")
     */
    private $revenue;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="seller", type="string", length=255, nullable=true)
     */
    private $seller;


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
     * Set asin
     *
     * @param string $asin
     *
     * @return Sale
     */
    public function setAsin($asin)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get asin
     *
     * @return string
     */
    public function getAsin()
    {
        return $this->asin;
    }

    /**
     * Set category
     *
     * @param integer $category
     *
     * @return Sale
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Sale
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set earnings
     *
     * @param float $earnings
     *
     * @return Sale
     */
    public function setEarnings($earnings)
    {
        $this->earnings = $earnings;

        return $this;
    }

    /**
     * Get earnings
     *
     * @return float
     */
    public function getEarnings()
    {
        return $this->earnings;
    }

    /**
     * Set linkType
     *
     * @param string $linkType
     *
     * @return Sale
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;

        return $this;
    }

    /**
     * Get linkType
     *
     * @return string
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * Set rate
     *
     * @param float $rate
     *
     * @return Sale
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set qty
     *
     * @param integer $qty
     *
     * @return Sale
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set revenue
     *
     * @param float $revenue
     *
     * @return Sale
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;

        return $this;
    }

    /**
     * Get revenue
     *
     * @return float
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Sale
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Sale
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
     * Set seller
     *
     * @param string $seller
     *
     * @return Sale
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return string
     */
    public function getSeller()
    {
        return $this->seller;
    }
}

