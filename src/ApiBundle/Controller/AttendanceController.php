<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\UserProject as User;
use ApiBundle\Entity\Attendance;
use ApiBundle\Entity\UserHasCourses;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class AttendanceController extends BaseController
{

    public function getStatusAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $studentUsername = $data['student_username'];
                $courseId = $data['course_id'];
                $dateSelected = $data['date_selected'];

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

                $attendanceStatus = $this->getAttendanceStatus($userHasCourses, $dateSelected);

                $result = [
                    'attendance_status'=> $attendanceStatus
                ];

                return $this->createJsonResponseSuccess(null, $result);
            }
        } catch(Exception $e) {
            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }

    public function createAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $courseId = $data['course_id'];
                $attendance = isset($data['attendance']) ? $data['attendance'] : [];

                if(empty($attendance)){
                    return $this->createJsonResponseWarning("Lista de alumnos vacio");
                }

                $attendance = str_replace('=', ':', $attendance);
                $attendance = str_replace('#', '"', $attendance);
                $attendance = str_replace('attendance_status', '"attendance_status"', $attendance);
                $attendance = str_replace('student_username', '"student_username"', $attendance);
                $attendance = json_decode($attendance, true);

                foreach ($attendance as $key => $value){
                    $user = $this->getUserProject($value['student_username']);

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

                    $a = new Attendance();
                    $a->setUserHasCourses($userHasCourses);
                    $a->setOptionDate(new \DateTime());
                    $a->setOptionStatus($value['attendance_status']);
                    $this->save($a);
                }

                $result = [
                    'attendance'=> [
                        'attendance_id' => 1,
                    ]
                ];

                return $this->createJsonResponseSuccess(null, $result);

            }
        } catch(\Exception $e) {
            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }

    private function getAttendanceStatus(UserHasCourses $userHasCourses, $dateSelected)
    {

        $dateSelected = new \DateTime($dateSelected);
        $dateSelected = $dateSelected->format('Y-m-d');

        $em = $this->getDoctrine()->getManager();
        $attendance = $em->getRepository('ApiBundle:Attendance')->findStatusOfAttendance($userHasCourses->getIdIncrement(), $dateSelected);

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $attendance,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(['data_attendance'])
        );

        return json_decode($entitiesJson);
    }


}
