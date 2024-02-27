<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Allocation;
use App\Models\User;
use App\Models\Device;
use App\Models\Assigned;
use App\Http\Requests\StoreAllocationRequest;
use App\Models\ItemType;
class AllocationController extends Controller
{
    public function allocation_index()
     {
            $role   = Auth::user()->role->role_name;
            $allocation =Allocation::all();
            $assigned =Assigned::all();
            $users = User::where('role_id', 3)->get();
            $item_type = ItemType::all();
            $device = Device::with('categoryRelation', 'itemType', 'oemRelation')->get();
            
            return view('modules.admin.allocation')->with(compact('role','users','allocation','device','item_type','assigned'));
     }
     public function ViewAllocationContent(Request $request){
            $allocation = Allocation::with('employee', 'assignedTo','device.categoryRelation','device.itemType','device.oemRelation','device')->get();
            return response()->json($allocation)->withHeaders([
                'Cache-Control' => 'max-age=15, public',
                'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
            ]);
            
     }

     public function StoreAllocationData(StoreAllocationRequest $request){
       $validator = Validator::make($request->all(),$request->rules());

       if($validator->fails()){
           return response()->json(['errors' => $validator->errors()], 422);
       }
       else {
          
            if(isset($request->id)){   //Edit Allocation
              $sql_count = Allocation::where('id',$request->id)->count();
              if($sql_count>0){
               try{
                   DB::beginTransaction();
                   Allocation::whereId($request->id)->update([
                           'emp_code' => $this->normalizeString($request->emp_code),
                           'issued_on' => ($request->issued_on),
                           'returned_on' => ($request->returned_on),
                           'assigned_to' => $this->normalizeString($request->assigned_to),
                           'device_id' => $this->normalizeString($request->device),
                          
                           
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
                   $allocation = new Allocation();
                   $allocation->emp_code = $this->normalizeString($request->emp_code);
                   $allocation->issued_on = ($request->issued_on);
                   $allocation->returned_on = ($request->returned_on);
                   $allocation->assigned_to = $this->normalizeString($request->assigned_to);
                   $allocation->device_id = $this->normalizeString($request->device);
                   $allocation->save();
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
public function ShowAllocationData(Request $request) {
    $sql = Allocation::with('device.categoryRelation', 'device.oemRelation','device.itemType')
                    ->where('id', $request->id)
                    ->get();
       return response()->json($sql);
}
public function DeleteAllocationData(Request $request){
       try{
           DB::beginTransaction();
           $sql = Allocation::where('id',$request->id)->delete();
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
