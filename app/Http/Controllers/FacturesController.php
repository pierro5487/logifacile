<?php

namespace App\Http\Controllers;

use App\Components\FacturePdf;
use App\Facture;
use App\GroupeLigne;
use Illuminate\Http\Request;

class FacturesController extends Controller
{
    public function add(){
		return view('factures.add');
	}
	
	public function visualise(Facture $facture){
//		dd($facture);
		//on récupère les groupes avec leur ligne pour cette facture
		$groupes = GroupeLigne::where('document_id',$facture->id)->with('Ligne')->get();
//		dd($groupes);
		//on créer la facture
		$pdf = new FacturePdf();
		$pdf->setAutoE();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->infoFacture($facture);
		$pdf->client($facture);
		$pdf->lignes($groupes);
		$pdf->Output();
	}
}
