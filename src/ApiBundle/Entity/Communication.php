<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Communication
 *
 * @ORM\Table(name="communication", indexes={@ORM\Index(name="fk_communication_user_has_courses1_idx", columns={"user_has_courses_id"})})
 * @ORM\Entity
 */
class Communication
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"data_communication"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"data_communication"})
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="message_type", type="string", length=45, nullable=true)
     * @JMSS\Groups({"data_communication"})
     */
    private $messageType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="message_date", type="datetime", nullable=true)
     */
    private $messageDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i:s'>")
     * @JMSS\Groups({"data_communication"})
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
    private $isActive;

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
     * @return Communication
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
     * Set message
     *
     * @param string $message
     *
     * @return Communication
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set messageType
     *
     * @param string $messageType
     *
     * @return Communication
     */
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * Get messageType
     *
     * @return string
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Set messageDate
     *
     * @param \DateTime $messageDate
     *
     * @return Communication
     */
    public function setMessageDate($messageDate)
    {
        $this->messageDate = $messageDate;

        return $this;
    }

    /**
     * Get messageDate
     *
     * @return \DateTime
     */
    public function getMessageDate()
    {
        return $this->messageDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Communication
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
     * @return Communication
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
     * @return Communication
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
     * @return Communication
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
