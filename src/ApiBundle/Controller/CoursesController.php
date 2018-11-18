<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\UserProject as User;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class CoursesController extends BaseController
{

    public function listCoursesByUsernameAction(Request $request)
    {
         try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $username = $data['username'];

                $user = $this->getUserProject($username);

                if(is_null($user)){
                    return $this->createJsonResponseWarning("Usuario no encontrado");
                }

                $result = ['courses'=> $this->getUserCourses($user)];

                return $this->createJsonResponseSuccess(null, $result);
            }
         } catch(\Exception $e) {
             return $this->createJsonResponseError();
         }

        return $this->createJsonResponseError();
    }

    public function listByUserAction(Request $request)
    {
         try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $username = $data['username'];

                $user = $this->getUserProject($username);

                if(is_null($user)){
                    return $this->createJsonResponseWarning("Usuario no encontrado");
                }

                $result = ['courses'=> $this->getUserCourses($user)];

                return $this->createJsonResponseSuccess(null, $result);
            }
         } catch(\Exception $e) {
             return $this->createJsonResponseError();
         }

        return $this->createJsonResponseError();
    }

    private function getUserCourses(User $user)
    {

        $em = $this->getDoctrine()->getManager();
        $userHasCourses = $em->getRepository('ApiBundle:UserHasCourses')->findCoursesByUser($user->getIdIncrement());

        $out = [];
        foreach ($userHasCourses as $key => $value){
            $out[$key]['id'] = $value->getCourses()->getIdIncrement();
            $out[$key]['name'] = $value->getCourses()->getName();
        }

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $out,
            'json'
        );
         //SerializationContext::create()->setSerializeNull(true)->setGroups(['data_course'])

//        return $entitiesJson;
        return json_decode($entitiesJson);
    }
}
