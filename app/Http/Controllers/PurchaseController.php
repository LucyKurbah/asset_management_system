<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;

class PurchaseController extends Controller
{
    public function purchase_index()
     {
            $role   = Auth::user()->role->role_name;
            $purchase =Purchase::all();

            return view('modules.admin.purchase')->with(compact('role','purchase'));
     }
     public function ViewPurchaseContent(Request $request){
            $purchase = Purchase::all();
            return response()->json($purchase)->withHeaders([
                'Cache-Control' => 'max-age=15, public',
                'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
            ]);
            
     }

     public function StorePurchaseData(StorePurchaseRequest $request){
       $validator = Validator::make($request->all(),$request->rules());

       if($validator->fails()){
           return response()->json(['errors' => $validator->errors()], 422);
       }
       else {
          
            if(isset($request->id)){   //Edit Purchase
              $sql_count = Purchase::where('id',$request->id)->count();
              if($sql_count>0){
               try{
                   DB::beginTransaction();
                   Purchase::whereId($request->id)->update([
                           'po_no' => $this->normalizeString($request->po_no),
                           'installation_date' => $this->normalizeString($request->install_date),
                           'delivery_date' => $this->normalizeString($request->delivery_date),
                           'warranty_start' => $this->normalizeString($request->warranty_from),
                           'warranty_end' => $this->normalizeString($request->warranty_to),
                           'purchased_by' => $this->normalizeString($request->purchased_by),
                           
                       ]);
                   DB::commit();
                   return response()->json(["flag"=>"YY"]);
               }
               catch(\Exception $e){
                   DB::rollback();
                   return response()->json(["flag"=>"NN"]);
               }
              }
              else {
               return response()->json(["flag"=>"NN"]);
              }
           }
           else {    //Store new Rate
               try{
                   DB::beginTransaction();
                   $purchase = new Purchase();
                   $purchase->po_no = $this->normalizeString($request->po_no);
                   $purchase->installation_date = $this->normalizeString($request->install_date);
                   $purchase->delivery_date = $this->normalizeString($request->delivery_date);
                   $purchase->warranty_start = $this->normalizeString($request->warranty_from);
                   $purchase->warranty_end = $this->normalizeString($request->warranty_to);
                   $purchase->purchased_by = $this->normalizeString($request->purchased_by);
                   $purchase->save();
                   DB::commit();
                   return response()->json(["flag"=>"Y"]);
                }
                catch(\Exception $e){
                       DB::rollback();
                       return $e;
                       return response()->json(["flag"=>"N"]);
                   }
           }
       }
}
public function ShowPurchaseData(Request $request) {
    $sql = Purchase::select('id', 'po_no','installation_date','delivery_date','warranty_start','warranty_end','purchased_by')
                    ->where('id', $request->id)
                    ->get();
       return response()->json($sql);
}
public function DeletePurchaseData(Request $request){
       try{
           DB::beginTransaction();
           $sql = Purchase::where('id',$request->id)->delete();
           DB::commit();
           return response()->json(["flag"=>"Y"]);
       }
       catch(\Exception $e){
           DB::rollback();
           return response()->json(["flag"=>"N"]);
       }
}


public function normalizeString($str){
   $str = strip_tags($str);
   $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
   $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
   $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
   $str = htmlentities($str, ENT_QUOTES, "utf-8");
   $str = mb_ereg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
   $str = str_replace('%', '-', $str);
  return $str;
}

}
