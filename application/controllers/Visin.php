<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Visin extends CI_Controller {
public function index()
    {
        $dataUrl=base_url('assets/data_row.json');
        $dataStringJson=file_get_contents($dataUrl);
        $dataJson=json_decode($dataStringJson);

        $data=$dataJson[2]->data; 

        $output['region']=$this->region($data);
        $output['jenis']=$this->jenis($data);
        $output['tahun']=$this->tahun($data); 

        $this->load->view('visin',$output);        
    }

    function region($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Region]) == false)
            {
                $result[$row->Region]=$row->Jumlah;
            }else{
                $Jumlah=$result[$row->Region];
                $result[$row->Region]=$Jumlah + $row->Jumlah;
            }
        };
    //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['Region','Jumlah']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
    }

    function jenis($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Jenis]) == false)
            {
                $result[$row->Jenis]=$row->Jumlah;
            }else{
                $Jumlah=$result[$row->Jenis];
                $result[$row->Jenis]=$Jumlah + $row->Jumlah;
            }
        };

    //sorting data berdasarkan value array secara menurun
        arsort($result);
        //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['Jenis','Jumlah']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
    }

    function tahun($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Tahun]) == false)
            {
                $result[$row->Tahun]=$row->Jumlah;
            }else{
                $Jumlah=$result[$row->Tahun];
                $result[$row->Tahun]=$Jumlah + $row->Jumlah;
            }
        };
        //sorting data berdasarkan value array secara menurun
        arsort($result);
        //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['Tahun','Jumlah']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
        }
    }; 