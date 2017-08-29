<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScenarioInquest
 *
 * @ORM\Table(name="scenario_inquest", indexes={@ORM\Index(name="scenario_id", columns={"scenario_id"}), @ORM\Index(name="inquest_id", columns={"inquest_id"})})
 * @ORM\Entity
 */
class ScenarioInquest
{
    /**
     * @var string
     *
     * @ORM\Column(name="inquest_protocol", type="string", length=255, nullable=false)
     */
    private $inquestProtocol = '';

    /**
     * @var string
     *
     * @ORM\Column(name="inquest_parameter", type="string", length=255, nullable=true)
     */
    private $inquestParameter;

    /**
     * @var string
     *
     * @ORM\Column(name="inquest_comparison", type="string", length=255, nullable=true)
     */
    private $inquestComparison;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Inquest
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Inquest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inquest_id", referencedColumnName="id")
     * })
     */
    private $inquest;

    /**
     * @var \AppBundle\Entity\Scenario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Scenario", inversedBy="scenarioInquests")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="scenario_id", referencedColumnName="id")
     * })
     */
    private $scenario;

    /**
     * @ORM\OneToMany(targetEntity="ScenarioInquestValidator", mappedBy="scenarioInquest", cascade={"persist"})
     */
    private $scenarioInquestValidators;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->scenarioInquestValidators = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set inquestProtocol
     *
     * @param string $inquestProtocol
     *
     * @return ScenarioInquest
     */
    public function setInquestProtocol($inquestProtocol)
    {
        $this->inquestProtocol = $inquestProtocol;

        return $this;
    }

    /**
     * Get inquestProtocol
     *
     * @return string
     */
    public function getInquestProtocol()
    {
        return $this->inquestProtocol;
    }

    /**
     * Set inquestParameter
     *
     * @param string $inquestParameter
     *
     * @return ScenarioInquest
     */
    public function setInquestParameter($inquestParameter)
    {
        $this->inquestParameter = $inquestParameter;

        return $this;
    }

    /**
     * Get inquestParameter
     *
     * @return string
     */
    public function getInquestParameter()
    {
        return $this->inquestParameter;
    }

    /**
     * Set inquestComparison
     *
     * @param string $inquestComparison
     *
     * @return ScenarioInquest
     */
    public function setInquestComparison($inquestComparison)
    {
        $this->inquestComparison = $inquestComparison;

        return $this;
    }

    /**
     * Get inquestComparison
     *
     * @return string
     */
    public function getInquestComparison()
    {
        return $this->inquestComparison;
    }

    /**
     * Set inquest
     *
     * @param \AppBundle\Entity\Inquest $inquest
     *
     * @return ScenarioInquest
     */
    public function setInquest(\AppBundle\Entity\Inquest $inquest = null)
    {
        $this->inquest = $inquest;

        return $this;
    }

    /**
     * Get inquest
     *
     * @return \AppBundle\Entity\Inquest
     */
    public function getInquest()
    {
        return $this->inquest;
    }

    /**
     * Set scenario
     *
     * @param \AppBundle\Entity\Scenario $scenario
     *
     * @return ScenarioInquest
     */
    public function setScenario(\AppBundle\Entity\Scenario $scenario = null)
    {
        $this->scenario = $scenario;

        return $this;
    }

    /**
     * Get scenario
     *
     * @return \AppBundle\Entity\Scenario
     */
    public function getScenario()
    {
        return $this->scenario;
    }

    /**
     * Add scenarioInquestValidator
     *
     * @param \AppBundle\Entity\ScenarioInquestValidator $scenarioInquestValidator
     *
     * @return ScenarioInquest
     */
    public function addScenarioInquestValidator(\AppBundle\Entity\ScenarioInquestValidator $scenarioInquestValidator)
    {
        $scenarioInquestValidator->setScenarioInquest($this);
        $this->scenarioInquestValidators[] = $scenarioInquestValidator;

        return $this;
    }

    /**
     * Remove scenarioInquestValidator
     *
     * @param \AppBundle\Entity\ScenarioInquest $scenarioInquest
     */
    public function removeScenarioInquestValidator(\AppBundle\Entity\ScenarioInquestValidator $scenarioInquestValidator)
    {
        $scenarioInquestValidator->setScenarioInquest();
        $this->scenarioInquestValidators->removeElement($scenarioInquestValidator);
    }

    /**
     * Get scenarioInquestValidators
     *
     * @return ArrayCollection
     */
    public function getScenarioInquestValidators()
    {
        return $this->scenarioInquestValidators;
    }
}
