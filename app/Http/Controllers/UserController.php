<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Allocation;
use App\Models\Division;
use App\Models\Group;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $role   = Auth::user()->role->role_name;
        $division = Division::all();
        $group = Group::all();
        return view('modules.user.user')->with(compact('role','division','group'));
    }

    public function ViewContent(Request $request){
        $sql = User::whereHas('role', function ($query) {
                    $query->where('id', 3); // role_id for user is 3    
                })->with('role')
                ->get(); 

         return response()->json($sql)->withHeaders([
            'Cache-Control' => 'max-age=15, public',
            'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
        ]);
    }

    public function StoreData(StoreUserRequest $request){
        $validator = Validator::make($request->all(),$request->rules());

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else {
            if(isset($request->id)){   //Edit a user
               $sql_count = User::where('id',$request->id)->count();
               if($sql_count>0){
                try{
                    DB::beginTransaction();
                    User::whereId($request->id)->update([
                            'name' => $this->normalizeString($request->name),
                            'emp_code' => $this->normalizeString($request->emp_code),
                            'designation' => $this->normalizeString($request->designation),
                            'division' => $this->normalizeString($request->division),
                            'group' => $this->normalizeString($request->group),
                            'password' => Hash::make($request->password),
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
            else {    //Create new admin
                try{
                        DB::beginTransaction();
                        $User = new User();
                        $User->name = $this->normalizeString($request->name);
                        $User->emp_code = $this->normalizeString($request->emp_code);
                        $User->designation=$this->normalizeString($request->designation);
                        $User->division=$this->normalizeString($request->division);
                        $User->group=$this->normalizeString($request->group);
                        $User->email = $this->normalizeString($request->email);
                        $User->password = Hash::make($request->password);
                        $User->role_id=3;
                        $User->save();
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

    public function ShowData(Request $request) {
        $sql = User::select('id','emp_code','name','email','designation','division','group')
                    ->where('id',$request->id)
                    ->get();
        return response()->json($sql);
    }

    public function DeleteData(Request $request){
        try{
            DB::beginTransaction();
            $sql = User::where('id',$request->id)->delete();
            DB::commit();
            return response()->json(["flag"=>"Y"]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(["flag"=>"N"]);
        }
    }

    public function UserDevice(Request $request)
    {
        $userId = Auth::id();
        $role   = Auth::user()->role->role_name;

        $userAllocationsWithDetails = Allocation::with([
            'device.categoryRelation',
            'employee', // Assuming 'employee' is the relationship for the user in the Allocation model
            'device.itemType',
            'device.oemRelation'
        ])
        ->whereHas('employee', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
        ->get();
      
        return view('modules.user.device_allocation')->with(compact('role','userAllocationsWithDetails'));
       
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
