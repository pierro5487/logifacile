<?php

namespace App\Components;

use Anouar\Fpdf\Fpdf;

class FacturePdf extends Fpdf {
	
	public $cellHeight = 5;
	public $font = 10;
	public $AE = false;
	
	public function Header(){
		if (is_file(public_path() .'/logo.png')){
			$this->Image(public_path() .'/logo.png',75,5,70);
		}
		$this->SetY(50);
	}
	
	public function setAutoE(){
		$this->AE = true;
	}
	
	public function infoFacture($facture){
		$this->SetFont('Arial','B',$this->font+2);
		$this->Cell(100,$this->cellHeight,strtoupper($facture->type),0,2,'L');
		$this->Cell(100,$this->cellHeight,'Ref : '.$facture->numero,0,2,'L');
		$this->SetFont('Arial','B',$this->font);
		$this->Cell(100,$this->cellHeight,'Date de la facture : '.$facture->date_document->format('d/m/Y'));
	}
	
	public function client($facture){
		$this->SetY(50);
		$this->SetX(140);
		$this->SetFont('Arial','',$this->font);
		$this->Cell(100,$this->cellHeight,$facture->nom_client,0,2,'L');
		$this->Cell(100,$this->cellHeight,$facture->adresse,0,2,'L');
		if(!empty($facture->adresse_comp)){
			$this->Cell(100,$this->cellHeight,$facture->adresse_comp,0,2,'L');
		}
		$this->Cell(100,$this->cellHeight,$facture->code_postal.' '.ucfirst($facture->ville).' '.strtoupper($facture->pays),0,0,'L');
	}
	
	public function lignes($groupes){
		$this->SetX(10);
		$this->SetY(100);
		foreach ($groupes as $groupe){
			//on test si on ajoute un header
			if($groupe->no_header == '0'){
				$this->SetFont('Arial','B',$this->font-1);
				$this->SetColor();
				$this->Cell(50,$this->cellHeight+5,strtoupper('Vehicule : '),'B',0,'C');
				$this->Cell(60,$this->cellHeight+5,strtoupper('Immatriculation : '),'B',0,'C');
				$this->Cell(40,$this->cellHeight+5,mb_strtoupper(utf8_decode('Kilometrage : ')),'B',0,'C');
				$this->Cell(40,$this->cellHeight+5,mb_strtoupper(utf8_decode('Date : ')),'B',0,'C');
				$this->ln();
				$this->SetColor(true);
				$this->SetFont('Arial','',$this->font-1);
				$this->Cell(50,$this->cellHeight+5,utf8_decode($groupe->auto_string),0,0,'C');
				$this->Cell(60,$this->cellHeight+5,$groupe->immatriculation,0,0,'C');
				$this->Cell(40,$this->cellHeight+5,$groupe->kilometrage,0,0,'C');
				$this->Cell(40,$this->cellHeight+5,$groupe->date_document->format('d/m/Y'),0,0,'C');
				$this->ln(20);
			}
			// on affiche les lignes
			$this->tableHeader();
			$sousTotal = 0;
			foreach($groupe->Ligne as $ligne){
				$this->SetFont('Arial','B',$this->font-1);
				$this->Cell(110,$this->cellHeight+5,utf8_decode($ligne->libelle),'B',0,'L');
				$this->SetFont('Arial','',$this->font-1);
				$this->Cell(30,$this->cellHeight+5,number_format($ligne->prix_unitaire_HT,2,',',' ').' '.chr(128),'B',0,'R');
				$this->Cell(20,$this->cellHeight+5,$ligne->quantite,'B',0,'R');
				$montantTotal = $ligne->prix_unitaire_HT*$ligne->quantite;
				$this->Cell(30,$this->cellHeight+5,number_format($montantTotal,2,',',' ').' '.chr(128),'B',0,'R');
				$this->ln();
				$sousTotal += $montantTotal;
				//on verifie la remise
				if(!empty($ligne->remise) && $ligne->remise != 0){
					$montantRemise = $ligne->prix_unitaire_HT*$ligne->remise/100*-1*$ligne->quantite;
					$this->Cell(110,$this->cellHeight+5,'Remise de '.$ligne->remise.' %','B',0,'L');
					$this->SetFont('Arial','',$this->font-1);
					$this->Cell(30,$this->cellHeight+5,'','B',0,'R');
					$this->Cell(20,$this->cellHeight+5,'','B',0,'R');
					$this->Cell(30,$this->cellHeight+5,number_format($montantRemise,2,',',' ').' '.chr(128),'B',0,'R');
					$this->ln();
					$sousTotal += $montantRemise;
				}
			}
			//si il y a plusieurs groupe on affiche le sous total
			if(true ||count($groupes) > 1){
				$this->SetX(150);
				$this->Cell(20,$this->cellHeight+5,'Sous-total : ','B',0,'R');
				$this->Cell(30,$this->cellHeight+5,number_format($sousTotal,2,',',' ').' '.chr(128),'B',0,'R');
				$this->ln(40);
			}
		}
	}
	
	public function totauxFooter($totaux){
		$yPos = $this->GetY();
		
		$this->SetY($yPos);
		$xPosRight = 10;
		$this->SetX($xPosRight);
		// partie reglement
		if(!empty($totaux['encaissements'])){
			$this->SetFont('Arial', 'B', $this->font - 1);
			$this->SetColor();
			$this->Cell(30, $this->cellHeight, 'Date', 'B', 0, 'C');
			$this->Cell(30, $this->cellHeight, 'Mode reglement', 'B', 0, 'C');
			$this->Cell(30, $this->cellHeight, 'Montant', 'B', 1, 'C');
			$this->SetFont('Arial', '', $this->font - 1);
			$this->SetColor(true);
			foreach ($totaux['encaissements'] as $encaissement) {
				$this->Cell(30, $this->cellHeight, $encaissement['date']->format('d/m/Y'), 'B', 0, 'R');
				$this->Cell(30, $this->cellHeight, strtoupper($encaissement['mode']), 'B', 0, 'R');
				$this->Cell(30, $this->cellHeight, number_format($encaissement['montant'], 2, ',', ' ') . ' ' . chr(128), 'B', 1, 'R');
			}
			$this->ln(10);
		}
		//partie tva
		if(!$this->AE) {
			$this->SetFont('Arial', 'B', $this->font - 1);
			$this->SetColor();
			$this->Cell(30, $this->cellHeight, 'Base HT', 'B', 0, 'C');
			$this->Cell(30, $this->cellHeight, '% TVA', 'B', 0, 'C');
			$this->Cell(30, $this->cellHeight, 'Montant TVA', 'B', 1, 'C');
			$this->SetFont('Arial', '', $this->font - 1);
			$this->SetColor(true);
			foreach ($totaux['tva'] as $taux => $montants) {
				$this->Cell(30, $this->cellHeight, number_format($montants['base'], 2, ',', ' ') . ' ' . chr(128), 'B', 0, 'R');
				$this->Cell(30, $this->cellHeight, $taux . ' %', 'B', 0, 'R');
				$this->Cell(30, $this->cellHeight, number_format($montants['montant'], 2, ',', ' ') . ' ' . chr(128), 'B', 1, 'R');
			}
		}
		
		//totaux
		$this->SetY($yPos);
		$xPosRight = 110;
		$this->SetX($xPosRight);
		$this->Cell(60,$this->cellHeight,'Net HT',0,0,'R');
		$this->Cell(30,$this->cellHeight,number_format($totaux['totalHT'],2,',',' ').chr(128),0,1,'R');
		$this->SetX($xPosRight);
		$this->Cell(60,$this->cellHeight,'Remise HT',0,0,'R');
		$this->Cell(30,$this->cellHeight,number_format($totaux['totalRemise'],2,',',' ').chr(128),0,1,'R');
		$this->SetX($xPosRight);
		//$this->SetY($yPos+$this->cellHeight);
		$this->Cell(60,$this->cellHeight,'Total TVA','B',0,'R');
		$this->Cell(30,$this->cellHeight,number_format($totaux['totalTvaRemise'],2,',',' ').chr(128),'B',1,'R');
		$this->SetX($xPosRight);
		$this->Cell(60,$this->cellHeight,'Total TTC','B',0,'R');
		$this->Cell(30,$this->cellHeight,number_format($totaux['totalTTC'],2,',',' ').chr(128),'B',1,'R');
		$this->SetX($xPosRight);
		$this->Cell(60,$this->cellHeight,'Encaissement','B',0,'R');
		$this->Cell(30,$this->cellHeight,number_format($totaux['totalEncaissement'],2,',',' ').chr(128),'B',1,'R');
		$this->SetX($xPosRight);
		$this->Cell(60,$this->cellHeight,utf8_decode('Net à payer'),'B',0,'R');
		$this->Cell(30,$this->cellHeight,number_format($totaux['totalTTC'],2,',',' ').chr(128),'B',1,'R');
	}
	
	private function tableHeader(){
		$this->SetColor();
		$this->SetFont('Arial','',$this->font);
		if($this->AE){
			$this->Cell(110,$this->cellHeight,utf8_decode('Désignation'),'B',0,'L');
			$this->Cell(30,$this->cellHeight,'P.U. TTC','B',0,'R');
			$this->Cell(20,$this->cellHeight,utf8_decode('Qté'),'B',0,'R');
			$this->Cell(30,$this->cellHeight,'Total TTC','B',0,'R');
		}else{
			$this->Cell(110,$this->cellHeight,utf8_decode('Désignation'),'B',0,'L');
			$this->Cell(30,$this->cellHeight,'P.U. HT','B',0,'R');
			$this->Cell(20,$this->cellHeight,utf8_decode('Qté'),'B',0,'R');
			$this->Cell(30,$this->cellHeight,'Total HT','B',0,'R');
		}
		$this->ln();
		$this->SetColor(true);
	}
	
	private function SetColor($black = null){
		$this->SetTextColor(16,78,169);
		$this->SetDrawColor(16,78,169);
		if(!empty($black)){
			$this->SetTextColor(0,0,0);
//			$this->SetDrawColor(0,0,0);
		}
	}
	
	public function Footer() {
		parent::Footer(); // TODO: Change the autogenerated stub
		$this->SetX(20);
		$this->SetY(-20);
		$posY = $this->GetY();
		$this->SetDrawColor(16,78,169);
		$this->Line(20,$posY,190,$posY);
		$this->SetX(40);
		$this->SetFont('Arial','',$this->font-2);
		$this->Write(5,'Jp MultiService');
// Lien en bleu souligné
		$this->SetTextColor(0,0,255);
		$this->SetFont('','U');
		$this->Write(5,' Autoentreprise');
		//numero de page
		$this->SetFont('','');
		$this->SetTextColor(0,0,0);
		$this->SetY(-10);
		$this->SetX(-10);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
	}
}