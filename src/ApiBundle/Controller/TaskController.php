<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\UserProject as User;
use ApiBundle\Entity\UserHasCourses;
use ApiBundle\Entity\Task;
use ApiBundle\Entity\Courses;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class TaskController extends BaseController
{

    public function createAction(Request $request)
    {
         try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $taskId = $data['task_id'];
                $username = $data['username'];
                $courseId = $data['course_id'];

                $tarea = $data['tarea'];
                $fechaEntrega = $data['fecha_entrega'];
                $notaProfesor = $data['nota_profesor'];
                $estado = $data['estado'];

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

                $fechaEntrega = new \DateTime($fechaEntrega);

                $t = new Task();

                if(!empty($taskId)){
                    $t = $this->findTaskById($taskId);
                }

                $t->setTarea($tarea);
                $t->setFechaEntrega($fechaEntrega);
                $t->setNota($notaProfesor);
                $t->setEstado($estado);
                $t->setUserHasCourses($userHasCourses);
                $t->setCreatedAt(new \DateTime());
                $this->save($t);

                $result = [
                    'task'=> [
                        'id_increment' => $t->getIdIncrement(),
                    ]
                ];

                return $this->createJsonResponseSuccess(null, $result);
            }
         } catch(\Exception $e) {
             return $this->createJsonResponseError();
         }

        return $this->createJsonResponseError();
    }

    public function listByCourseAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $courseId = $data['course_id'];
                $estado = isset($data['estado']) ? $data['estado'] : '';

                $course = $this->getCourse($courseId);
                if(is_null($course)){
                    return $this->createJsonResponseWarning("Curso no encontrado");
                }

                $userHasCourses = $this->getUserHasCoursesByCourse($course);
                if(is_null($userHasCourses)){
                    return $this->createJsonResponseWarning("Curso no asignado a usuario");
                }

                $result = ['task'=> $this->getTask($userHasCourses, $estado)];

                return $this->createJsonResponseSuccess(null, $result);
            }
        } catch(Exception $e) {
            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }

    private function getTask(array $userHasCourses, $estado)
    {
        $out = [];
        foreach ($userHasCourses as $key => $value){
            $out[] = $value->getIdIncrement();
        }

        $em = $this->getDoctrine()->getManager();
//        $communication = $em->getRepository('ApiBundle:Task')->findByUserHasCourses($out);
        $communication = $em->getRepository('ApiBundle:Task')->findTask($out, $estado);

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $communication,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(['data_task'])
        );

        return json_decode($entitiesJson);
    }

    protected function getUserHasCoursesByCourse(Courses $course)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ApiBundle:UserHasCourses')->findOneByCourse($course->getIdIncrement());
    }

    protected function findTaskById($taskId)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ApiBundle:Task')->findOneByIdIncrement($taskId);
    }

}
