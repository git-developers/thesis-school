<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\UserProject as User;
use ApiBundle\Entity\UserHasCourses;
use ApiBundle\Entity\Communication;
use ApiBundle\Entity\Courses;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class NoticesController extends BaseController
{

    public function listNoticeByFatherAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $courseId = $data['course_id'];

                $course = $this->getCourse($courseId);
                if(is_null($course)){
                    return $this->createJsonResponseWarning("Curso no encontrado");
                }

                $userHasCourses = $this->getUserHasCoursesByCourse($course);
                if(is_null($userHasCourses)){
                    return $this->createJsonResponseWarning("Curso no asignado a usuario");
                }

                $result = ['notices'=> $this->getNotice($userHasCourses)];

                return $this->createJsonResponseSuccess(null, $result);
            }
        } catch(Exception $e) {
            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }

    private function getNotice(array $userHasCourses)
    {
        $out = [];
        foreach ($userHasCourses as $key => $value){
            $out[] = $value->getIdIncrement();
        }

        $em = $this->getDoctrine()->getManager();
        $communication = $em->getRepository('ApiBundle:Communication')->findByUserHasCourses($out);

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $communication,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(['data_communication'])
        );

        return json_decode($entitiesJson);
    }

    public function createNoticeAction(Request $request)
    {
         try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $username = $data['username'];
                $message = $data['message'];
                $noticeType = $data['notice_type'];
                $courseId = $data['course_id'];

                $user = $this->getUserProject($username);
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

                $c = new Communication();
                $c->setMessageType($noticeType);
                $c->setMessage($message);
                $c->setUserHasCourses($userHasCourses);
                $c->setCreatedAt(new \DateTime());
                $this->save($c);

                $result = [
                    'communication'=> [
                        'notice_type' => $noticeType,
                        'communication_id' => $c->getIdIncrement(),
                    ]
                ];

                return $this->createJsonResponseSuccess(null, $result);
            }
         } catch(\Exception $e) {
             return $this->createJsonResponseError();
         }

        return $this->createJsonResponseError();
    }

    protected function getUserHasCoursesByCourse(Courses $course)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ApiBundle:UserHasCourses')->findOneByCourse($course->getIdIncrement());
    }

}
