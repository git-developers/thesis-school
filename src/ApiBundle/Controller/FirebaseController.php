<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class FirebaseController extends BaseController
{

    public function postAction(Request $request)
    {
        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $username = $data['username'];

                $registrationIds = [
                    "epbUulW5Z-I:APA91bGueDAQdb96qfujg3FFi_07rhK8dNNJSvnL8LvkVYXYDZ8OXydEBaGWE5AeEJLsGivNTBFMGDX-f2s1GhIxGJUzN-QMrT6sCmBc9cxE5ovHP-9z6i9wCjEs4Jenw3R_APBm-sWN",
                ];
                $response = $this->firebase($registrationIds);

                return $this->createJsonResponseSuccess(null, $response);
                //return $this->createJsonResponseWarning("Curso no asignado a usuario");
            }
        } catch(Exception $e) {
            return $this->createJsonResponseError();
        }

        return $this->createJsonResponseError();
    }


}
