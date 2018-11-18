<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\UserProject as User;
use ApiBundle\Entity\UserHasCourses;
use ApiBundle\Entity\Grades;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class GradesController extends BaseController
{

    public function createGradeAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $studentUsername = $data['student_username'];
                $courseId = $data['course_id'];
                $bimester = $data['bimester'];
                $noteMonthly = $data['grade_monthly'];
                $noteBimonthly = $data['grade_bimonthly'];
                $noteTeacher = $data['grade_teacher'];

                $user = $this->getUserProject($studentUsername);
                if(is_null($user)){
                    return $this->createJsonResponseWarning("Usuario no encontrado");
                }

                $course = $this->getCourse($courseId);
                if(is_null($course)){
                    return $this->createJsonResponseWarning("Curso no encontrado");
                }

                $userHasCourses = $this->getUserHasCourses($user, $course);
                if(is_null($userHasCourses)){
                    return $this->createJsonResponseWarning("Curso no asignado a usuario");
                }

                $c = new Grades();
                $c->setBimester($bimester);
                $c->setUserHasCourses($userHasCourses);
                $c->setNoteMonthly($noteMonthly);
                $c->setNoteBimonthly($noteBimonthly);
                $c->setNoteTeacher($noteTeacher);
                $this->save($c);

                $result = [
                    'grades'=> [
                        'grades_id' => $c->getIdIncrement(),
                    ]
                ];

                return $this->createJsonResponseSuccess(null, $result);
            }
        } catch(\Exception $e) {
            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }

    public function listGradeAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $studentUsername = $data['student_username'];
                $courseId = $data['course_id'];
                $bimester = $data['bimester'];

                $user = $this->getUserProject($studentUsername);
                if(is_null($user)){
                    return $this->createJsonResponseWarning("Usuario no encontrado");
                }

                $course = $this->getCourse($courseId);
                if(is_null($course)){
                    return $this->createJsonResponseWarning("Curso no encontrado");
                }

                $userHasCourses = $this->getUserHasCourses($user, $course);
                if(is_null($userHasCourses)){
                    return $this->createJsonResponseWarning("Curso no asignado a usuario");
                }

                $result = ['grades'=> $this->getGradesByBimester($userHasCourses, $bimester)];

                return $this->createJsonResponseSuccess(null, $result);
            }
        } catch(\Exception $e) {
            echo $e->getMessage();
//            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }

    private function getGradesByBimester(UserHasCourses $userHasCourses, $bimester)
    {
        $em = $this->getDoctrine()->getManager();
        $grades = $em->getRepository('ApiBundle:Grades')->findByCourseAndBimester($userHasCourses->getIdIncrement(), $bimester);

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $grades,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(['data_grades'])
        );

        return json_decode($entitiesJson);;
    }


}
