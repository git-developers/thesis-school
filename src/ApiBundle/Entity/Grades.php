<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Grades
 *
 * @ORM\Table(name="grades", indexes={@ORM\Index(name="fk_notes_user_has_courses1_idx", columns={"user_has_courses_id"})})
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\GradesRepository")
 */
class Grades
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"data_grades"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="bimester", type="string", length=45, nullable=true)
     * @JMSS\Groups({"data_grades"})
     */
    private $bimester;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_monthly", type="integer", nullable=true)
     * @JMSS\Groups({"data_grades"})
     */
    private $noteMonthly;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_bimonthly", type="integer", nullable=true)
     * @JMSS\Groups({"data_grades"})
     */
    private $noteBimonthly;

    /**
     * @var integer
     *
     * @ORM\Column(name="note_teacher", type="integer", nullable=true)
     * @JMSS\Groups({"data_grades"})
     */
    private $noteTeacher;

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
     * @return Notes
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
     * Set bimester
     *
     * @param string $bimester
     *
     * @return Notes
     */
    public function setBimester($bimester)
    {
        $this->bimester = $bimester;

        return $this;
    }

    /**
     * Get bimester
     *
     * @return string
     */
    public function getBimester()
    {
        return $this->bimester;
    }

    /**
     * Set noteMonthly
     *
     * @param integer $noteMonthly
     *
     * @return Notes
     */
    public function setNoteMonthly($noteMonthly)
    {
        $this->noteMonthly = $noteMonthly;

        return $this;
    }

    /**
     * Get noteMonthly
     *
     * @return integer
     */
    public function getNoteMonthly()
    {
        return $this->noteMonthly;
    }

    /**
     * Set noteBimonthly
     *
     * @param integer $noteBimonthly
     *
     * @return Notes
     */
    public function setNoteBimonthly($noteBimonthly)
    {
        $this->noteBimonthly = $noteBimonthly;

        return $this;
    }

    /**
     * Get noteBimonthly
     *
     * @return integer
     */
    public function getNoteBimonthly()
    {
        return $this->noteBimonthly;
    }

    /**
     * Set noteTeacher
     *
     * @param integer $noteTeacher
     *
     * @return Notes
     */
    public function setNoteTeacher($noteTeacher)
    {
        $this->noteTeacher = $noteTeacher;

        return $this;
    }

    /**
     * Get noteTeacher
     *
     * @return integer
     */
    public function getNoteTeacher()
    {
        return $this->noteTeacher;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Notes
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
     * @return Notes
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
     * @return Notes
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
     * @return Notes
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
