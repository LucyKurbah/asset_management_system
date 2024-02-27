<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Oem;
use App\Models\ItemType;
use App\Models\Division;
use App\Models\Group;
use App\Models\Assigned;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreItemTypeRequest;
use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\StoreAssignedRequest;
use App\Http\Requests\StoreOemRequest;


class MasterDataController extends Controller
{
     //-----------------------CATEGORY

     public function oem_index()
     {  
         $role   = Auth::user()->role->role_name;
         $oem = OEM::all();
         return view('modules.admin.oem')->with(compact('role','oem'));
     }
     public function ViewOEMContent(Request $request){
         $sql = OEM::orderBy('oem_name', 'desc')->get();
         return response()->json($sql)->withHeaders([
             'Cache-Control' => 'max-age=15, public',
             'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
         ]);
     }
     public function StoreOEMData(StoreOemRequest $request){
         $validator = Validator::make($request->all(),$request->rules());
 
         if($validator->fails()){
             return response()->json(['errors' => $validator->errors()], 422);
         }
         else {
             if(isset($request->id)){   //Edit an admin
                $sql_count = OEM::where('id',$request->id)->count();
                if($sql_count>0){
                 try{
                     DB::beginTransaction();
                     OEM::whereId($request->id)->update([
                             'oem_name' => $this->normalizeString($request->oem)
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
                     $oem = new OEM();
                     $oem->oem_name = $this->normalizeString($request->oem);
                     $oem->save();
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
     public function ShowOEMData(Request $request) {
         $sql = OEM::select('id','oem_name')
                     ->where('id',$request->id)
                     ->get();
         return response()->json($sql);
     }
 
     public function DeleteOEMData(Request $request){
         try{
             DB::beginTransaction();
             $sql = OEM::where('id',$request->id)->delete();
             DB::commit();
             return response()->json(["flag"=>"Y"]);
         }
         catch(\Exception $e){
             DB::rollback();
             return response()->json(["flag"=>"N"]);
         }
     }
    
    //----------------------DIVISION
    public function division_index()
    {
           $role   = Auth::user()->role->role_name;
           $division =Division::all();
    
           return view('modules.admin.division')->with(compact('role','division'));
    }
    public function ViewDivisionContent(Request $request){
           $sql = Division::all();
           return response()->json($sql)->withHeaders([
               'Cache-Control' => 'max-age=15, public',
               'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
           ]);
    }
    public function StoreDivisionData(StoreDivisionRequest $request){
           $validator = Validator::make($request->all(),$request->rules());
   
           if($validator->fails()){
               return response()->json(['errors' => $validator->errors()], 422);
           }
           else {
              
                if(isset($request->id)){   //Edit Division
                  $sql_count = Division::where('id',$request->id)->count();
                  if($sql_count>0){
                   try{
                       DB::beginTransaction();
                       Division::whereId($request->id)->update([
                               'division_name' => $this->normalizeString($request->division),
                               
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
                       $division = new Division();
                       $division->division_name = $this->normalizeString($request->division);
                       $division->save();
                       DB::commit();
                       return response()->json(["flag"=>"Y"]);
                    }
                    catch(\Exception $e){
                           DB::rollback();
                        //    return $e;
                           return response()->json(["flag"=>"N"]);
                       }
               }
           }
    }
    public function ShowDivisionData(Request $request) {
        $sql = Division::select('id', 'division_name')
                        ->where('id', $request->id)
                        ->get();
           return response()->json($sql);
    }
    public function DeleteDivisionData(Request $request){
           try{
               DB::beginTransaction();
               $sql = Division::where('id',$request->id)->delete();
               DB::commit();
               return response()->json(["flag"=>"Y"]);
           }
           catch(\Exception $e){
               DB::rollback();
               return response()->json(["flag"=>"N"]);
           }
    }

    //----------------------GROUP
    public function group_index()
    {
        $role   = Auth::user()->role->role_name;
        $group =Group::all();

        return view('modules.admin.group')->with(compact('role','group'));
    }
    public function ViewGroupContent(Request $request){
        $sql = Group::all();
        return response()->json($sql)->withHeaders([
            'Cache-Control' => 'max-age=15, public',
            'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
        ]);
    }
    public function StoreGroupData(StoreGroupRequest $request){
        $validator = Validator::make($request->all(),$request->rules());

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else {
            
                if(isset($request->id)){   //Edit Group
                $sql_count = Group::where('id',$request->id)->count();
                if($sql_count>0){
                try{
                    DB::beginTransaction();
                    Group::whereId($request->id)->update([
                            'group_name' => $this->normalizeString($request->group),
                            
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
                    $group = new Group();
                    $group->group_name = $this->normalizeString($request->group);
                    $group->save();
                    DB::commit();
                    return response()->json(["flag"=>"Y"]);
                    }
                    catch(\Exception $e){
                        DB::rollback();
                        //    return $e;
                        return response()->json(["flag"=>"N"]);
                    }
            }
        }
    }
    public function ShowGroupData(Request $request) {
        $sql = Group::select('id', 'group_name')
                        ->where('id', $request->id)
                        ->get();
        return response()->json($sql);
    }

    public function DeleteGroupData(Request $request){
        try{
            DB::beginTransaction();
            $sql = Group::where('id',$request->id)->delete();
            DB::commit();
            return response()->json(["flag"=>"Y"]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(["flag"=>"N"]);
        }
    }

    //----------------------ASSIGNED TO
    public function assigned_index()
    {
        $role   = Auth::user()->role->role_name;
        $assigned =Assigned::all();

        return view('modules.admin.assigned')->with(compact('role','assigned'));
    }
    public function ViewAssignedContent(Request $request){
        $sql = Assigned::all();
        return response()->json($sql)->withHeaders([
            'Cache-Control' => 'max-age=15, public',
            'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
        ]);
    }
    public function StoreAssignedData(StoreAssignedRequest $request){
        $validator = Validator::make($request->all(),$request->rules());

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else {
            
                if(isset($request->id)){   //Edit Assigned To
                $sql_count = Assigned::where('id',$request->id)->count();
                if($sql_count>0){
                try{
                    DB::beginTransaction();
                    Assigned::whereId($request->id)->update([
                            'assigned_to' => $this->normalizeString($request->assigned),
                            
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
                    $assigned = new Assigned();
                    $assigned->assigned_to = $this->normalizeString($request->assigned);
                    $assigned->save();
                    DB::commit();
                    return response()->json(["flag"=>"Y"]);
                    }
                    catch(\Exception $e){
                        DB::rollback();
                        //    return $e;
                        return response()->json(["flag"=>"N"]);
                    }
            }
        }
    }
    public function ShowAssignedData(Request $request) {
        $sql = Assigned::select('id', 'assigned_to')
                        ->where('id', $request->id)
                        ->get();
        return response()->json($sql);
    }

    public function DeleteAssignedData(Request $request){
        try{
            DB::beginTransaction();
            $sql = Assigned::where('id',$request->id)->delete();
            DB::commit();
            return response()->json(["flag"=>"Y"]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(["flag"=>"N"]);
        }
    }


    //-----------------------CATEGORY

    public function category_index()
    {  
        $role   = Auth::user()->role->role_name;
        $category = Category::all();
        return view('modules.admin.category')->with(compact('role','category'));
    }
    public function ViewCategoryContent(Request $request){
        $sql = Category::orderBy('category_name', 'desc')->get();
        return response()->json($sql)->withHeaders([
            'Cache-Control' => 'max-age=15, public',
            'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
        ]);
    }
    public function StoreCategoryData(StoreCategoryRequest $request){
        $validator = Validator::make($request->all(),$request->rules());

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else {
            if(isset($request->id)){   //Edit an admin
               $sql_count = Category::where('id',$request->id)->count();
               if($sql_count>0){
                try{
                    DB::beginTransaction();
                    Category::whereId($request->id)->update([
                            'category_name' => $this->normalizeString($request->category)
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
                    $category = new Category();
                    $category->category_name = $this->normalizeString($request->category);
                    $category->save();
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
    public function ShowCategoryData(Request $request) {
        $sql = Category::select('id','category_name')
                    ->where('id',$request->id)
                    ->get();
        return response()->json($sql);
    }

    public function DeleteCategoryData(Request $request){
        try{
            DB::beginTransaction();
            $sql = Category::where('id',$request->id)->delete();
            DB::commit();
            return response()->json(["flag"=>"Y"]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(["flag"=>"N"]);
        }
    }


    //---------------------EMPLOYEE
    public function employee_index()
    {
        $role   = Auth::user()->role->role_name;
        $employee = Employee::all();

        return view('modules.admin.employee')->with(compact('role','employee'));
    }

    public function ViewEmployeeContent(Request $request){
        $sql = Employee::with('employee_name')->get();
        $employee = Employee::all();
        return response()->json($sql)->withHeaders([
            'Cache-Control' => 'max-age=15, public',
            'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
        ]);
    }
    
    public function StoreEmployeeData(StoreNewspaperRequest $request){
        $validator = Validator::make($request->all(),$request->rules());

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else {
            if(isset($request->id)){   //Edit an admin
               $sql_count = Employee::where('id',$request->id)->count();
               if($sql_count>0){
                try{
                    DB::beginTransaction();
                    Employee::whereId($request->id)->update([
                            'employee_name' => $this->normalizeString($request->employee_name),
                            // 'newspaper_type_id' => $this->normalizeString($request->news_type_id),
                            // 'head_off' => $this->normalizeString($request->head_off),
                            // 'email' => $this->normalizeString($request->email),
                            // 'phone' => $this->normalizeString($request->phone),
                            
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
                    $employee = new Employee();
                    $employee->employee_name = $this->normalizeString($request->employee_name);
                    // $employee->newspaper_type_id = $this->normalizeString($request->news_type_id);
                    // $empanelled->head_off = $this->normalizeString($request->head_off);
                    // $empanelled->email=$this->normalizeString($request->email);
                    // $empanelled->phone=$this->normalizeString($request->phone);
                    $employee->save();
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
    
    public function ShowNewspaperData(Request $request) {
        $employee = Employee::with(['employee_name'])        
                    ->where('id', $request->id)
                    ->get();
    
        return response()->json($employee);
    }

    public function DeleteEmployeeData(Request $request){
        try{
            DB::beginTransaction();
            $sql = Employee::where('id',$request->id)->delete();
            DB::commit();
            return response()->json(["flag"=>"Y"]);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(["flag"=>"N"]);
        }
    }
    //-----------------------Item TYPES

    public function item_type_index()
    {
           $role   = Auth::user()->role->role_name;
           $item_type = ItemType::all();
   
           return view('modules.admin.item_type')->with(compact('role','item_type'));
    }
    public function ViewItemTypeContent(Request $request){
        $sql = ItemType::orderBy('item_name', 'desc')->get();
        
           return response()->json($sql)->withHeaders([
               'Cache-Control' => 'max-age=15, public',
               'Expires' => gmdate('D, d M Y H:i:s', time() + 15) . ' IST',
           ]);
    }
    public function StoreItemTypeData(StoreItemTypeRequest $request){
        $validator = Validator::make($request->all(),$request->rules());

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else {
            if(isset($request->id)){   //Edit an admin
               $sql_count = ItemType::where('id',$request->id)->count();
               if($sql_count>0){
                try{
                    DB::beginTransaction();
                    ItemType::whereId($request->id)->update([
                            'item_name' => $this->normalizeString($request->item_type)
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
                    $item_type = new ItemType();
                    $item_type->item_name = $this->normalizeString($request->item_type);
                    $item_type->save();
                    DB::commit();
                    return response()->json(["flag"=>"Y"]);
                    }
                    catch(\Exception $e){
                        DB::rollback();
                        return $e;
                        // return response()->json(["flag"=>"N"]);
                    }
            }
        }
    }
    public function ShowItemTypeData(Request $request) {
        $sql = ItemType::select('id','item_name')
                    ->where('id',$request->id)
                    ->get();
        return response()->json($sql);
    }

    public function DeleteItemTypeData(Request $request){
        try{
            DB::beginTransaction();
            $sql = ItemType::where('id',$request->id)->delete();
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
