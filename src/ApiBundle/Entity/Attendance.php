<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Attendance
 *
 * @ORM\Table(name="attendance", indexes={@ORM\Index(name="fk_assistance_user_has_courses1_idx", columns={"user_has_courses_id"})})
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AttendanceRepository")
 */
class Attendance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"data_attendance"})
     */
    private $idIncrement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="option_date", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i:s'>")
     * @JMSS\Groups({"data_attendance"})
     */
    private $optionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="option_status", type="string", length=45, nullable=true)
     * @JMSS\Groups({"data_attendance"})
     */
    private $optionStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var \ApiBundle\Entity\UserHasCourses
     *
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\UserHasCourses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_has_courses_id", referencedColumnName="id_increment", unique=true)
     * })
     */
    private $userHasCourses;



    /**
     * Set idIncrement
     *
     * @param integer $idIncrement
     *
     * @return Assistance
     */
    public function setIdIncrement($idIncrement)
    {
        $this->idIncrement = $idIncrement;

        return $this;
    }

    /**
     * Get idIncrement
     *
     * @return integer
     */
    public function getIdIncrement()
    {
        return $this->idIncrement;
    }

    /**
     * Set optionDate
     *
     * @param \DateTime $optionDate
     *
     * @return Assistance
     */
    public function setOptionDate($optionDate)
    {
        $this->optionDate = $optionDate;

        return $this;
    }

    /**
     * Get optionDate
     *
     * @return \DateTime
     */
    public function getOptionDate()
    {
        return $this->optionDate;
    }

    /**
     * @return string
     */
    public function getOptionStatus()
    {
        return $this->optionStatus;
    }

    /**
     * @param string $optionStatus
     */
    public function setOptionStatus($optionStatus)
    {
        $this->optionStatus = $optionStatus;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Assistance
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Assistance
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Assistance
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set userHasCourses
     *
     * @param \ApiBundle\Entity\UserHasCourses $userHasCourses
     *
     * @return Assistance
     */
    public function setUserHasCourses(\ApiBundle\Entity\UserHasCourses $userHasCourses = null)
    {
        $this->userHasCourses = $userHasCourses;

        return $this;
    }

    /**
     * Get userHasCourses
     *
     * @return \ApiBundle\Entity\UserHasCourses
     */
    public function getUserHasCourses()
    {
        return $this->userHasCourses;
    }
}
