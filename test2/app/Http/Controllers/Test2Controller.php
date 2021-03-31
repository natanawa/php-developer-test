<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use View;
use Session;
use Excel;
use File;

class Test2Controller extends Controller {

  public function index()
  {
    return view('index');
  }

  public function import(Request $request){
    $result=[];
    if($request->hasFile('file')){
      $extension = File::extension($request->file->getClientOriginalName());
      if ($extension == "xlsx" || $extension == "xls" ) {
        $path = $request->file->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();
        if(!empty($data) && $data->count()){
          $x=0;
          foreach ($data as $key => $items) {
            $result[$key]['error']  = '';
            $result[$key]['row']    = $key + 2;
            if(isset($items->field_a)){
              if(empty($items->field_a)){
                $result[$key]['error'] = $result[$key]['error'].'Missing value in Field_A, ';
              }
            }
            if(isset($items->field_b)){
              if(!empty($items->field_b)){
                if(strpos($items->field_b, ' ') !== false){
                  $result[$key]['error'] = $result[$key]['error'].'FIELD_B should not contain any space, ';
                }
              }
            }
            if(isset($items->field_d)){
              if(empty($items->field_d)){
                $result[$key]['error'] = $result[$key]['error'].'Missing value in Field_D, ';
              }
            }
            if(isset($items->field_e)){
              if(empty($items->field_e)){
                $result[$key]['error'] = $result[$key]['error'].'Missing value in Field_E, ';
              }
            }
            $x++;
          }
        }
        if(!empty($result)){
          Session::flash('error', '');
          return redirect()->route('index')->with( ['result' => $result] );
        }else{
          Session::flash('success', 'Success');
          return redirect()->route('index')->with( ['success' => 'Success'] );
        }
      } else {
        Session::flash('error', '');
        return redirect()->route('index')->with( ['result' => 'File is a '.$extension.' file.!! Please upload a valid xls/xlsx file..!!'] );
      }
    }
  }
}

