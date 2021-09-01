<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class csvtojson extends Controller
{
    public function engine(Request $request){
         //get file
         $upload=$request->file('file');
         $filePath=$upload->getRealPath();
         //open and read
         $file=fopen($filePath, 'r');
 
         $header= fgetcsv($file);
 
         // dd($header);
         $escapedHeader=[];
         //validate
         foreach ($header as $key => $value) {
             $lheader=strtolower($value);
             $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
             array_push($escapedHeader, $lheader);
         }
 
         //looping through othe columns
         $ar = [];
         while($columns=fgetcsv($file))
         {
            //  if($columns[1]=="")
            //  {
            //      continue;
            //  }
             //trim data
             foreach ($columns as $key => $value) {
                //  $value=preg_replace('/\D/','',$value);
             }
 
            $data= array_combine($escapedHeader, $columns);
 
            // setting type
            // foreach ($data as $key => &$value) {
            //  $value=($key=="zip" || $key=="month")?(integer)$value: (float)$value;
            // }
 
            // Table update
            array_push($ar,$data);
         }    
         dd($ar);
    }
}
