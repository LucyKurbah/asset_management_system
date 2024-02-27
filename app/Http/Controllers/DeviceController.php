<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Device;
use App\Models\Category;
use App\Models\ItemType;
use App\Models\Oem;

use App\Http\Requests\StoreDeviceRequest;

class DeviceController extends Controller
{
     //----------------------DEVICE
     public function device_index()
     {
            $role   = Auth::user()->role->role_name;
            $category =Category::all();
            $item_type =ItemType::all();
            $oem =Oem::all();
            $device =Device::all();
     
            return view('modules.admin.device')->with(compact('role','device','category','item_type','oem'));
     }
     public function ViewDeviceContent(Request $request){
            $devices = Device::with('categoryRelation', 'itemType', 'oemRelation')
            ->orderBy('device.category','DESC')
            ->get();

            return response()->json($devices)->withHeaders([
                'Cache-Control' => 'max-age=15, public',
                'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
            ]);
            
     }
     public function StoreDeviceData(StoreDeviceRequest $request){
            $validator = Validator::make($request->all(),$request->rules());
    
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else {
               
                 if(isset($request->id)){   //Edit Device
                   $sql_count = Device::where('id',$request->id)->count();
                   if($sql_count>0){
                    try{
                        DB::beginTransaction();
                        Device::whereId($request->id)->update([
                                'serial_no' => $this->normalizeString($request->serial_no),
                                'category' => $this->normalizeString($request->category),
                                'item_type' => $this->normalizeString($request->item_type),
                                'oem' => $this->normalizeString($request->oem),
                                
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
                        $device = new Device();
                        $device->serial_no = $this->normalizeString($request->serial_no);
                        $device->category = $this->normalizeString($request->category);
                        $device->item_type = $this->normalizeString($request->item_type);
                        $device->oem = $this->normalizeString($request->oem);
                        $device->save();
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
     public function ShowDeviceData(Request $request) {
         $sql = Device::select('id', 'category','item_type','oem','serial_no')
                         ->where('id', $request->id)
                         ->get();
            return response()->json($sql);
     }
     public function DeleteDeviceData(Request $request){
            try{
                DB::beginTransaction();
                $sql = Device::where('id',$request->id)->delete();
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
