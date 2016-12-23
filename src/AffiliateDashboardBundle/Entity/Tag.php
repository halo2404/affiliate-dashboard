<?php

namespace AffiliateDashboardBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="AffiliateDashboardBundle\Repository\TagRepository")
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Blogpost" , mappedBy="affiliateTag" , cascade={"all"})
     */
    private $blogposts;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Sale" , mappedBy="affiliateTag" , cascade={"all"})
     */
    private $sales;

    /**
     * @var float
     *
     * @ORM\Column(name="aggregated_earnings", type="float")
     */
    private $aggregatedEarnings = 0;

    function __construct()
    {
        $this->blogposts = new ArrayCollection();
        $this->sales = new ArrayCollection();
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Blogpost[]
     */
    public function getBlogposts()
    {
        return $this->blogposts;
    }

    /**
     * @param Blogpost[] $blogposts
     */
    public function setBlogposts($blogposts)
    {
        $this->blogposts = $blogposts;
    }

    /**
     * @param Sale $sale
     * @return Tag
     */
    public function addSale(Sale $sale)
    {
        $this->sales->add($sale);

        return $this;
    }

    /**
     * @return Sale[]
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * @param Sale[] $sales
     */
    public function setSales($sales)
    {
        $this->sales = $sales;
    }

    /**
     * @return float
     */
    public function getAggregatedEarnings()
    {
        return $this->aggregatedEarnings;
    }

    /**
     * @param float $aggregatedEarnings
     */
    public function setAggregatedEarnings($aggregatedEarnings)
    {
        $this->aggregatedEarnings = $aggregatedEarnings;
    }

    /**
     * @param bool $useOrm
     * @param bool $clearedFilter
     * @return float
     */
    public function getEarnings($useOrm = false, $clearedFilter = false)
    {
        if ($useOrm) {
            $sum = 0;

            foreach ($this->getSales() as $sale) {
                if (!$clearedFilter || !$sale->getCleared()) {
                    $sum += $sale->getEarnings();
                }
            }

            return $sum;
        }
        else {
            return $this->getAggregatedEarnings();
        }
    }
}