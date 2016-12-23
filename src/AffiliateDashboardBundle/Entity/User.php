<?php

namespace AffiliateDashboardBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AffiliateDashboardBundle\Repository\UserRepository")
 */
class User
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="BlogpostUser", mappedBy="user", cascade={"all"})
     */
    private $blogpostUser;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Payment" , mappedBy="user" , cascade={"all"})
     */
    private $payments;

    function __construct()
    {
        $this->blogpostUser = new ArrayCollection();
        $this->payments = new ArrayCollection();
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
     * @return User
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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return BlogpostUser[]
     */
    public function getBlogpostUser()
    {
        return $this->blogpostUser;
    }

    /**
     * @param Payment $payment
     * @return $this
     */
    public function addPayment(Payment $payment)
    {
        $this->payments->add($payment);

        return $this;
    }

    /**
     * @return Payment[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param Payment[] $payments
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
    }

    /**
     * @return float
     */
    public function getEarnings()
    {
        $sum = 0;

        foreach ($this->getBlogpostUser() as $bu) {
            $tag = $bu->getBlogpost()->getAffiliateTag();
            $sum += $tag->getEarnings() / count($tag->getBlogposts()) / 100 * $bu->getPercentage();
        }

        return $sum;
    }

    public function getPaid()
    {
        $sum = 0;

        foreach ($this->getBlogpostUser() as $bu) {
            $tag = $bu->getBlogpost()->getAffiliateTag();
            $sum += $tag->getPaid() / count($tag->getBlogposts()) / 100 * $bu->getPercentage();
        }

        return $sum;
    }
}

