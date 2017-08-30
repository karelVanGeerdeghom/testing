<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scenario
 *
 * @ORM\Table(name="scenario", indexes={@ORM\Index(name="api", columns={"site_id"})})
 * @ORM\Entity
 */
class Scenario
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Site
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Site")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     * })
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity="ScenarioInquest", mappedBy="scenario", cascade={"persist"}, fetch="EAGER")
     */
    private $scenarioInquests;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->scenarioInquests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * toString
     */
    public function __toString()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Scenario
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set site
     *
     * @param \AppBundle\Entity\Site $site
     *
     * @return Scenario
     */
    public function setSite(\AppBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \AppBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Add scenarioInquest
     *
     * @param \AppBundle\Entity\ScenarioInquest $scenarioInquest
     *
     * @return Scenario
     */
    public function addScenarioInquest(\AppBundle\Entity\ScenarioInquest $scenarioInquest)
    {
        $scenarioInquest->setScenario($this);
        $this->scenarioInquests[] = $scenarioInquest;

        return $this;
    }

    /**
     * Remove scenarioInquest
     *
     * @param \AppBundle\Entity\ScenarioInquest $scenarioInquest
     */
    public function removeScenarioInquest(\AppBundle\Entity\ScenarioInquest $scenarioInquest)
    {
        $scenarioInquest->setScenario();
        $this->scenarioInquests->removeElement($scenarioInquest);
    }

    /**
     * Get scenarioInquests
     *
     * @return ArrayCollection
     */
    public function getScenarioInquests()
    {
        return $this->scenarioInquests;
    }
}
