<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvsController extends AbstractController
{
    #[Route('/dashboard/reportes/cvs', name: 'cvs')]
    public function csvAction()
    {
        $info='';
        $em=$this->getDoctrine()->getManager();
        $query = 'SELECT * FROM acceso';
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $info=$statement->fetchAll();
        $list = array(
            //these are the columns
            array('ID', 'Usuario', 'Contrasenia'),
            //these are the rows
            array('Andrei', 'Boar'),
            array('John', 'Doe')
        );

        $fp = fopen('php://output', 'w');

        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'text/csv');
        //it's gonna output in a testing.csv file
        $response->headers->set('Content-Disposition', 'attachment; filename="report.csv"');

        return $response;
    }
}
