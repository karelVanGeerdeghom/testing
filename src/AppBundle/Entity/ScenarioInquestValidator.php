<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScenarioInquestValidator
 *
 * @ORM\Table(name="scenario_inquest_validator", indexes={@ORM\Index(name="scenario_inquest_id", columns={"scenario_inquest_id"}), @ORM\Index(name="validator_id", columns={"validator_id"})})
 * @ORM\Entity
 */
class ScenarioInquestValidator
{
    /**
     * @var string
     *
     * @ORM\Column(name="validator_parameter", type="string", length=255, nullable=true)
     */
    private $validatorParameter;

    /**
     * @var string
     *
     * @ORM\Column(name="validator_comparison", type="string", length=255, nullable=true)
     */
    private $validatorComparison;

    /**
     * @var integer
     *
     * @ORM\Column(name="validator_sortorder", type="integer", nullable=false)
     */
    private $validatorSortorder;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Validator
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Validator")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="validator_id", referencedColumnName="id")
     * })
     */
    private $validator;

    /**
     * @var \AppBundle\Entity\ScenarioInquest
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ScenarioInquest", inversedBy="scenarioInquestValidators")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="scenario_inquest_id", referencedColumnName="id")
     * })
     * @ORM\OrderBy({"validator_sortorder" = "ASC"})
     */
    private $scenarioInquest;

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
     * Set validatorParameter
     *
     * @param string $validatorParameter
     *
     * @return ScenarioInquestValidator
     */
    public function setValidatorParameter($validatorParameter)
    {
        $this->validatorParameter = $validatorParameter;

        return $this;
    }

    /**
     * Get validatorParameter
     *
     * @return string
     */
    public function getValidatorParameter()
    {
        return $this->validatorParameter;
    }

    /**
     * Set validatorComparison
     *
     * @param string $validatorComparison
     *
     * @return ScenarioInquestValidator
     */
    public function setValidatorComparison($validatorComparison)
    {
        $this->validatorComparison = $validatorComparison;

        return $this;
    }

    /**
     * Get validatorComparison
     *
     * @return string
     */
    public function getValidatorComparison()
    {
        return $this->validatorComparison;
    }

    /**
     * Set validatorSortorder
     *
     * @param integer $validatorSortorder
     *
     * @return ScenarioInquestValidator
     */
    public function setValidatorSortorder($validatorSortorder)
    {
        $this->validatorSortorder = $validatorSortorder;

        return $this;
    }

    /**
     * Get validatorSortorder
     *
     * @return integer
     */
    public function getValidatorSortorder()
    {
        return $this->validatorSortorder;
    }

    /**
     * Set validator
     *
     * @param \AppBundle\Entity\Validator $validator
     *
     * @return ScenarioInquestValidator
     */
    public function setValidator(\AppBundle\Entity\Validator $validator = null)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Get validator
     *
     * @return \AppBundle\Entity\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Set scenarioInquest
     *
     * @param \AppBundle\Entity\ScenarioInquest $scenarioInquest
     *
     * @return ScenarioInquestValidator
     */
    public function setScenarioInquest(\AppBundle\Entity\ScenarioInquest $scenarioInquest = null)
    {
        $this->scenarioInquest = $scenarioInquest;

        return $this;
    }

    /**
     * Get scenarioInquest
     *
     * @return \AppBundle\Entity\ScenarioInquest
     */
    public function getScenarioInquest()
    {
        return $this->scenarioInquest;
    }
}
