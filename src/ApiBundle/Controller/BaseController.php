<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Entity\Courses;
use ApiBundle\Entity\UserProject as User;

class BaseController extends Controller
{

    const MAX_AGE_HOUR = 3600; #cache for 300 seconds
    const MAX_AGE_YEAR = 31622400; #cache for 300 seconds

    const MESSAGE_SUCCESS = "Proceso satisfactorio";
    const MESSAGE_WARNING = "Ops! Warning, algo salió mal. Por favor, contacte a su proveedor";
    const MESSAGE_ERROR = "Ops! Error, algo salió mal. Por favor, contacte a su proveedor";
    const MESSAGE_EXCEPTION = "NO_HUBO_ACCION";

    const STATUS_SUCCESS = 1;
    const STATUS_WARNING = 2;
    const STATUS_ERROR = 3;

    /**
     * Crear JsonResponse exitoso
     *
     * @param string|null $mensaje
     * @param array $result
     * @return JsonResponse
     */
    protected function createJsonResponseSuccess($mensaje = null, array $result = [])
    {
        $mensajeData = [
            'status' => self::STATUS_SUCCESS,
            'message' => is_null($mensaje) || empty($mensaje) ? self::MESSAGE_SUCCESS : $mensaje
        ];

        $data = array_merge($mensajeData, $result);

        return $this->createJsonResponse($data);

//        return $this->createJsonResponse($result);
    }

    /**
     * Crear JsonResponse con error
     * El Json aun sigue devolviendo HTTP code = 200
     *
     * @param string|null $mensaje
     * @param array $result
     * @return JsonResponse
     */
    protected function createJsonResponseError($mensaje = null, array $result = [])
    {
        $mensajeData = [
            'status' => self::STATUS_ERROR,
            'message' => is_null($mensaje) || empty($mensaje) ? self::MESSAGE_ERROR : $mensaje
        ];

        $data = array_merge($mensajeData, $result);

        return $this->createJsonResponse($data);
    }

    /**
     * Crear JsonResponse con warning,
     * El Json aun sigue devolviendo HTTP code = 200
     *
     * @param string|null $mensaje
     * @param array $result
     * @return JsonResponse
     */
    protected function createJsonResponseWarning($mensaje =null, array $result = [])
    {
        $mensajeData = [
            'status' => self::STATUS_WARNING,
            'message' => is_null($mensaje) || empty($mensaje) ? self::MESSAGE_WARNING : $mensaje
        ];

        $data = array_merge($mensajeData, $result);

        return $this->createJsonResponse($data);
    }

    protected function createJsonResponse($data)
    {
        return new JsonResponse($data);
    }

    protected function isJsonRequest(Request $request)
    {
        return 0 === strpos($request->headers->get('Content-Type'), 'application/json');
    }

    protected function flush()
    {
        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }

    protected function save($entity)
    {
        $this->sendNotification();

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }

    protected function getUserProject($username)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApiBundle:UserProject')->findOneBy(
            array(
                'username' => $username,
                'isActive'  => true
            )
        );

        return $user;
    }

    protected function getCourse($courseId)
    {
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository('ApiBundle:Courses')->findOneByIdIncrement($courseId);

        return $course;
    }

    protected function firebase(array $registrationIds = [])
    {

        $fields = [
            //"condition" => " 'Symulti' in topics || 'SymultiLite' in topics",
            //"content_available" => true,
            "priority" => "normal",
            "time_to_live" => 0,
            'notification' => [
                'title' => "SCDA",
                'text' => "Your Text",
                "body" => "Notificaciones de la aplicacion",
                "icon" => "ic_launcher",
                'click_action' => "OPEN_ACTIVITY_1",
            ],
            'data' => [
                "id" => 1,
                "text" => "new Symulti update !",
                'keyname' => "any value",
            ],
            //'to' => $id,
            'registration_ids' => $registrationIds,
        ];


        $postFields = json_encode($fields);
        $serverKey = "AAAAuMCFctg:APA91bEZuY095KOzLT6f5jGoAF9o0tbyKhJouuiCKSxQYeDf4-GgtC-DP-cp0PBwreg68-S3jMo-neL7GtK-agjRFZfYIL_AgtAjf2rTwEVa0yl5M8QVOGODL7wWFok4O_mxidiVjOAd";
        $url = "https://fcm.googleapis.com/fcm/send";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Connection: Keep-Alive',
            'Authorization: key='.$serverKey,
        ]);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1); //0 for a get request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        curl_close ($ch);

        return json_decode($response, true);
    }

    protected function getUserHasCourses(User $user, Courses $course)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ApiBundle:UserHasCourses')->findOneByUserAndCourse($user->getIdIncrement(), $course->getIdIncrement());
    }

    protected function getAllUserProject()
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ApiBundle:UserProject')->findAll();
    }

    protected function sendNotification()
    {
        $users = $this->getAllUserProject();

        $registrationIds = [];
        foreach ($users as $key => $value){
            $registrationIds[] = $value->getRegistrationId();
        }

        $this->firebase($registrationIds);
    }

}