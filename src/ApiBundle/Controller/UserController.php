<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\UserProject as User;
use ApiBundle\Entity\Assistance;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class UserController extends BaseController
{

    public function listChildrenAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $username = $data['username'];

                $user = $this->getUserProject($username);

                if(is_null($user)){
                    return $this->createJsonResponseWarning("Usuario no encontrado");
                }

                $result = ['children'=> $this->findChildrenByFather($user)];

                return $this->createJsonResponseSuccess(null, $result);
            }
        } catch(\Exception $e) {
            echo $e->getMessage();
//            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }

    public function loginAction(Request $request)
    {
         try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $username = $data['username'];
                $password = $data['password'];
                $registrationId = $data['registration_id'];

                $user = $this->getUserProject($username);

                if(is_null($user)){
                    return $this->createJsonResponseWarning("Usuario no encontrado");
                }

                $userLogin = $this->loginGetUser($username, $password);

                if(is_null($userLogin)){
                    return $this->createJsonResponseWarning("Username o password incorrectos");
                }

                //Firebase: guarando el Registration Id
                $user->setRegistrationId($registrationId);
                $this->save($user);

                $result = ['user'=> $userLogin];

                return $this->createJsonResponseSuccess(null, $result);
            }
         } catch(Exception $e) {
             return $this->createJsonResponseError();
         }

        return $this->createJsonResponseError();
    }

    public function listUsersByCourseAction(Request $request)
    {
         try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $courseId = $data['course_id'];

                $usersByCourse = $this->listUsersByCourse($courseId);

                if(is_null($usersByCourse)){
                    return $this->createJsonResponseWarning("No hay alumnos en el curso");
                }

                $result = ['users_by_course'=> $usersByCourse];

                return $this->createJsonResponseSuccess(null, $result);
            }
         } catch(Exception $e) {
             return $this->createJsonResponseError();
         }

        return $this->createJsonResponseError();
    }

    private function loginGetUser($username, $password)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApiBundle:UserProject')->loginByUsername($username, $password);

        $out = [];
        $out['username'] = $user->getUsername();
        $out['name'] = $user->getName();
        $out['email'] = $user->getEmail();
        $out['created_at'] = $user->getCreatedAt();
        $out['insert_type'] = User::INSERT_TYPE_LOGIN;

        $permissions = $user->getProfile()->getPermission();
        foreach ($permissions as $key => $value){
            $out['role'] = $value->getAlias();
        }

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $out,
            'json'
        );
//        SerializationContext::create()->setSerializeNull(true)->setGroups(['data_user'])

        return json_decode($entitiesJson);
    }

    private function listUsersByCourse($courseId)
    {

        $idProfile = 3; //students
        $em = $this->getDoctrine()->getManager();
        $userHasCourses = $em->getRepository('ApiBundle:UserHasCourses')->findAllUsersByCourse($courseId, $idProfile);

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $userHasCourses,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(['data_users_by_course'])
        );
        
        $out = [];
        $entitiesJson = json_decode($entitiesJson);
        foreach ($entitiesJson as $key => $value){
            foreach ($value->user as $key2 => $value2){
                $out[$key][$key2] = $value2;
                $out[$key]['insert_type'] = User::INSERT_TYPE_SELECTED_STUDENT;
            }
        }

        return $out;
    }

    private function findChildrenByFather($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiBundle:UserProject')->findChildrenByFather($userId);

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $users,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(['data_child'])
        );

        $out = [];
        $entitiesJson = json_decode($entitiesJson);
        foreach ($entitiesJson as $key => $value){
            foreach ($value as $key2 => $value2){
                $out[$key][$key2] = $value2;
                $out[$key]['insert_type'] = User::INSERT_TYPE_CHILDREN;
            }
        }

        return $out;
    }

}
