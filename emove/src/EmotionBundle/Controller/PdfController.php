<?php

namespace EmotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PdfController extends Controller
{
    public function indexAction()
    {
        // $id = 1;
		$request = new Request($_GET);
		$id= $request->query->get('id'); 
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Rent')
        ;
        $user = NULL;
        $car = NULL;
        $dated = NULL;
        $dater = NULL;
        $nbday = NULL;
        $listRent = $repository->findUserById($id);
        foreach($listRent as $rent)
        {
            $user = $rent->getUser();
            $car = $rent->getCar();
            $dated = $rent->getDateDelivery();
            $dater = $rent->getDateRental();
            $nbday = $dater->diff($dated);
        }
        //die(dump($user->getDriverLicence()));

        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetTitle('Facture');
        $pdf->SetFont('Arial','B',16);
        $pdf->SetTextColor(0);
        //$pdf->Image("logo.png",30,null,150,83);
        $pdf->Multicell(190, 20, "FACTURE", 0, 'C', 0);
        $pdf->SetFont('Arial','',13);
        $pdf->SetTextColor(255);
        $pdf->Cell(1);
        $pdf->Multicell(190, 7, "CLIENT", 0, '', 1);
        $pdf->SetFont('Arial','',11);
        $pdf->SetTextColor(0);
        $pdf->Cell(1);
        $pdf->Cell(80, 5, "", 'R', 1);
        $pdf->Cell(1);
        $pdf->Cell(80, 7, utf8_decode("Nom : ".$user->getName()), 'R', 0);
        $pdf->Cell(110, 7, utf8_decode("Adresse : ".$user->getAddress()), '', 1);
        $pdf->Cell(1);
        $pdf->Cell(80, 7, utf8_decode("Prenom : ".$user->getFirstName()), 'R', 0);
        $pdf->Cell(110, 7, utf8_decode("Ville : ".$user->getCity()), '', 1);
        $pdf->Cell(1);
        $pdf->Cell(80, 7, "Telephone : ".$user->getPhone(), 'R', 0);
        $pdf->Cell(110, 7, "Code Postal : ".$user->getZipCode(), '', 1);
        $pdf->Cell(1);
        $pdf->Cell(80, 7, "Email : ".$user->getEmail(), 'R', 0);
        $pdf->Cell(110, 7, "Pays : ".$user->getCountry(), '', 1);
        $pdf->Cell(1);
        $pdf->Cell(80, 5, "", 'R', 1);
        $pdf->SetFont('Arial','',13);
        $pdf->SetTextColor(255);
        $pdf->Cell(1);
        $pdf->Multicell(190, 7, "VEHICULE", 0, '', 1);
        $pdf->SetFont('Arial','',11);
        $pdf->SetTextColor(0);
        $pdf->Cell(1);
        $pdf->Cell(95, 5, "", '', 1);
        $pdf->Cell(1);
        $pdf->Cell(95, 7, "Marque : ".$car->getBrand()->getBrand(), '', 0);
        $pdf->Cell(95, 7, "Immatrculation : ".$car->getNumberPlate(), '', 1);
        $pdf->Cell(1);
        $pdf->Cell(95, 7, utf8_decode("Modèle : ".$car->getModel()->getModel()), '', 1);
        $pdf->Cell(1);
        $pdf->Cell(95, 5, "", '', 1);
        $pdf->SetFont('Arial','',13);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(255);
        $pdf->Cell(1);
        $pdf->Cell(95, 7, "AU DEPART", 'R', 0, '', 1);
        $pdf->Cell(95, 7, "AU RETOUR", 'L', 1, '', 1);
        $pdf->SetFont('Arial','',11);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0);
        $pdf->SetFillColor(196);
        $pdf->Cell(1);
        $pdf->Cell(95, 5, "", '', 1);
        $pdf->Cell(2);
        $pdf->Cell(47, 7, "Du : ".$dater->format("d-m-Y"), 'TLB', 0);
        $pdf->Cell(47, 7, "Au : ".$dated->format("d-m-Y"), 'TRB', 0);
        $pdf->Cell(94, 7, "Rendu le : ", '1', 1);
        $pdf->Cell(2);
        $pdf->Cell(94, 7, utf8_decode("Kilométrage : ".$car->getKmNumber()), '1', 0);
        $pdf->Cell(94, 7, utf8_decode("Kilométrage : "), '1', 1);
        $pdf->Cell(1);
        $pdf->Cell(95, 5, "", '', 1);
        $pdf->Cell(2);
        $pdf->Cell(31, 7, "Forfait Euros", '1', 0, '', 1);
        $pdf->Cell(31, 7, "Nb de jours", '1', 0, '', 1);
        $pdf->Cell(32, 7, "Total Euros", '1', 0, '', 1);
        $pdf->Cell(31, 7, "Forfait Euros", '1', 0, '', 1);
        $pdf->Cell(31, 7, "Jours Suppl.", '1', 0, '', 1);
        $pdf->Cell(32, 7, "Total Euros", '1', 1, '', 1);
        $pdf->Cell(2);
        $pdf->Cell(29, 7, $car->getPrice(), 'TLB', 0);
        $pdf->Cell(31, 7, "X ".$nbday->format('%d'), 'TB', 0);
        $pdf->Cell(34, 7, "= ".$car->getPrice()*$nbday->format('%d'), 'TRB', 0);
        $pdf->Cell(29, 7, $car->getPrice(), 'TLB', 0);
        $pdf->Cell(31, 7, "X", 'TB', 0);
        $pdf->Cell(34, 7, "=", 'TRB', 1);
        $pdf->Cell(1);
        $pdf->Cell(95, 5, "", '', 1);
        $pdf->SetFont('Arial','',13);
        $pdf->SetTextColor(255);
        $pdf->SetFillColor(0);
        $pdf->Cell(1);
        $pdf->Multicell(190, 7, "CAUTION", 0, '', 1);
        $pdf->SetFont('Arial','',11);
        $pdf->SetTextColor(0);
        $pdf->Cell(1);
        $pdf->Cell(95, 5, "", '', 1);
        $pdf->Cell(2);
        $pdf->Cell(50, 7, "CB le : ".date("d-m-Y"), '1', 0);
        $pdf->Cell(64, 7, "Total de la Caution = ".round($car->getPrice()*$nbday->format('%d')/3 ,2)."EUR", '1', 0);
        $pdf->Cell(76, 7, "Permis de Conduire : ".$user->getDriverLicence(), '1', 1);
        $pdf->Cell(1);
        $pdf->Cell(95, 5, "", '', 1);
        $pdf->Output("uploads/rents/invoices/".$id."-".$user->getId().".pdf","F");
        return new Response($pdf->Output(), 200, array('Content-Type' => 'application/pdf'));
    }
}