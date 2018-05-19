<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MontageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$datas = array();
		for($i = 14;$i<23;$i++){
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '0' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '0' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '0' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '0' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '1' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '1' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '1' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '0','alu' => '1' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '0' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '0' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '0' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '0' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '1' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '1' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '1' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '0','valve' => '1','alu' => '1' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '0' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '0' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '0' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '0' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '1' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '1' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '1' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '0','alu' => '1' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '0' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '0' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '0' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '0' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '1' ,'runflat'=> '0','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '1' ,'runflat'=> '0','truck' => '1','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '1' ,'runflat'=> '1','truck' => '0','valeur'=> '10');
			$datas[] = array('size' => $i,'montage' => '1','equilibrage' => '1','valve' => '1','alu' => '1' ,'runflat'=> '1','truck' => '1','valeur'=> '10');
		}
		
        foreach ($datas as $data){
			$this->saveLigne($data);
		}
    }
    
    private function saveLigne($datas){
		DB::table('montages')->insert([
			'size' 			=> $datas['size'],
			'montage' 		=> $datas['montage'],
			'equilibrage' 	=> $datas['equilibrage'],
			'valve'			=> $datas['valve'],
			'alu'			=> $datas['alu'],
			'runflat'		=> $datas['runflat'],
			'truck'			=> $datas['truck'],
			'valeur'		=> $datas['valeur']
		]);
	}
    
}
