<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Task
 *
 * @ORM\Table(name="task", indexes={@ORM\Index(name="fk_task_user_has_courses1_idx", columns={"user_has_courses_id"})})
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\TaskRepository")
 */
class Task
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"data_task"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"data_task"})
     */
    private $tarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="datetime", nullable=true)
     * @JMSS\Groups({"data_task"})
     */
    private $fechaEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="nota", type="integer", nullable=true)
     * @JMSS\Groups({"data_task"})
     */
    private $nota;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"data_task"})
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i:s'>")
     * @JMSS\Groups({"data_task"})
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
     * @return Task
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
     * Set tarea
     *
     * @param string $tarea
     *
     * @return Task
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado($estado)
    {
        switch ($estado){
            case 0:
                $estadoTxt = 'pendiente';
                break;
            case 1:
                $estadoTxt = 'no_pendiente';
                break;
            default:
                $estadoTxt = 'pendiente';
                break;
        }

        $this->estado = $estadoTxt;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return Task
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set nota
     *
     * @param integer $nota
     *
     * @return Task
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return integer
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Task
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
     * @return Task
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
     * @return Task
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
     * @return Task
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
