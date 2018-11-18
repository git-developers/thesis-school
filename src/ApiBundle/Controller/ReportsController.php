<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\UserProject as User;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class ReportsController extends BaseController
{

    public function piechartAction(Request $request)
    {

        $response = $this->render(
            'ApiBundle:Reports:piechart.html.twig',
            [
                'formEntity' =>'',
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_YEAR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

    public function steppedareachartAction(Request $request)
    {

        $response = $this->render(
            'ApiBundle:Reports:steppedareachart.html.twig',
            [
                'formEntity' =>'',
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_YEAR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

    public function gaugeAction(Request $request)
    {

        $response = $this->render(
            'ApiBundle:Reports:gauge.html.twig',
            [
                'formEntity' =>'',
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_YEAR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

}
