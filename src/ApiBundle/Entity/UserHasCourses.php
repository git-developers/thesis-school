<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * UserHasCourses
 *
 * @ORM\Table(name="user_has_courses", indexes={@ORM\Index(name="fk_user_project_has_courses_courses1_idx", columns={"courses_id"}), @ORM\Index(name="fk_user_project_has_courses_user_project1_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UserHasCoursesRepository")
 */
class UserHasCourses
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIncrement;

    /**
     * @var \ApiBundle\Entity\Courses
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Courses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="courses_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"data_course"})
     */
    private $courses;

    /**
     * @var \ApiBundle\Entity\UserProject
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\UserProject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"data_users_by_course"})
     */
    private $user;


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
     * Set courses
     *
     * @param \ApiBundle\Entity\Courses $courses
     *
     * @return UserHasCourses
     */
    public function setCourses(\ApiBundle\Entity\Courses $courses = null)
    {
        $this->courses = $courses;

        return $this;
    }

    /**
     * Get courses
     *
     * @return \ApiBundle\Entity\Courses
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set user
     *
     * @param \ApiBundle\Entity\UserProject $user
     *
     * @return UserHasCourses
     */
    public function setUser(\ApiBundle\Entity\UserProject $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ApiBundle\Entity\UserProject
     */
    public function getUser()
    {
        return $this->user;
    }
}
