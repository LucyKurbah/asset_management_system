<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AmcController;
use App\Http\Controllers\OdfController;
use App\Http\Controllers\ReportsController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/password-reset', [ PasswordResetContoller::class, 'index'])
->middleware('cache.headers')
->middleware('throttle')
->name('password-reset');
    
Route::post('/user-reset-password',[ PasswordResetContoller::class, 'ResetPassword'])
->middleware('cache.headers')
->middleware('throttle')
->name('user-reset-password');

Route::get('/auth/google', [ LoginController::class,'redirectToProvider']);
Route::get('/auth/google/callback', [ LoginController::class,'handleProviderCallback']);

Route::middleware('auth')->group(function(){


    Route::get('/home', [HomeController::class, 'index'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('home');

    Route::post('view-data',[TableContoller::class,'ViewContent'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('view-data');

    Route::post('store-data', [ TableContoller::class, 'StoreData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('store-data');

    Route::post('show-data', [ TableContoller::class, 'ShowData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('show-data');

    Route::post('delete-data', [ TableContoller::class, 'DeleteData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('delete-data');

    Route::post('change-active',[ TableContoller::class, 'ChangeActive' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('change-active');

    //ADMIN ROUTES

    Route::get('/admin', [ AdminController::class, 'index'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('admin');
    
    Route::post('admin-view-data',[AdminController::class,'ViewContent'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('admin-view-data');

    Route::post('/admin-store-data',[AdminController::class,'StoreData'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('admin-store-data');

    Route::post('admin-show-data', [ AdminController::class, 'ShowData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('admin-show-data');

    Route::post('admin-delete-data', [ AdminController::class, 'DeleteData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('admin-data');

    //USER ROUTES

    Route::get('/user', [ UserController::class, 'index'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('user');
    
    Route::post('user-view-data',[UserController::class,'ViewContent'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('user-view-data');

    Route::post('/user-store-data',[UserController::class,'StoreData'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('user-store-data');

    Route::post('user-show-data', [ UserController::class, 'ShowData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('user-show-data');

    Route::post('user-delete-data', [ UserController::class, 'DeleteData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('user-data');
        
        
    //MASTER DATA ITEM TYPES
    
    Route::get('/master-data/item_type', [MasterDataController::class, 'item_type_index'])
    ->name('/master-data/item_type');

    Route::post('item_type-view-data',[MasterDataController::class,'ViewItemTypeContent'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('item_type-view-data');

    Route::post('item_type-store-data',[MasterDataController::class,'StoreItemTypeData'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('item_type-store-data');

    Route::post('item_type-show-data', [ MasterDataController::class, 'ShowItemTypeData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('item_type-show-data');

    Route::post('item_type_delete', [ MasterDataController::class, 'DeleteItemTypeData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('item_type-delete');


    // MASTER DATA EMPLOYEES
    Route::get('/master-data/employee', [MasterDataController::class, 'employee_index'])
    ->name('/master-data/employee');

    Route::post('employee-view-data',[MasterDataController::class,'ViewEmployeeContent'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('employee-view-data');

    Route::post('/employee-store-data',[MasterDataController::class,'StoreEmployeeData'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('employee-store-data');

    Route::post('employee-show-data', [ MasterDataController::class, 'ShowEmployeeData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('employee-show-data');

    Route::post('employee-delete-data', [ MasterDataController::class, 'DeleteEmployeeData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('employee-data');

    // MASTER DATA CATEGORY

    Route::get('/master-data/category', [MasterDataController::class, 'category_index'])
    ->name('/master-data/category');

    Route::post('category-view-data',[MasterDataController::class,'ViewCategoryContent'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('category-view-data');

    Route::post('/category-store-data',[MasterDataController::class,'StoreCategoryData'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('category-store-data');

    Route::post('category-show-data', [ MasterDataController::class, 'ShowCategoryData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('category-show-data');

    Route::post('category-delete-data', [ MasterDataController::class, 'DeleteCategoryData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('category-data');

     // MASTER DATA OEM

     Route::get('/master-data/oem', [MasterDataController::class, 'oem_index'])
     ->name('/master-data/oem');
 
     Route::post('oem-view-data',[MasterDataController::class,'ViewOEMContent'])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('oem-view-data');
 
     Route::post('/oem-store-data',[MasterDataController::class,'StoreOEMData'])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('oem-store-data');
 
     Route::post('oem-show-data', [ MasterDataController::class, 'ShowOEMData' ])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('oem-show-data');
 
     Route::post('oem-delete-data', [ MasterDataController::class, 'DeleteOEMData' ])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('oem-data');

    // MASTER DATA DIVISION

    Route::get('/master-data/division', [MasterDataController::class, 'division_index'])
    ->name('/master-data/division');

    Route::post('division-view-data',[MasterDataController::class,'ViewDivisionContent'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('division-view-data');

    Route::post('division-store-data',[MasterDataController::class,'StoreDivisionData'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('division-store-data');

    Route::post('division-show-data', [ MasterDataController::class, 'ShowDivisionData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('division-show-data');

    Route::post('division-delete-data', [ MasterDataController::class, 'DeleteDivisionData' ])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('division-data');

    // MASTER DATA GROUP

    Route::get('/master-data/group', [MasterDataController::class, 'group_index'])
        ->name('/master-data/group');
    
    Route::post('group-view-data',[MasterDataController::class,'ViewGroupContent'])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('group-view-data');
    
    Route::post('group-store-data',[MasterDataController::class,'StoreGroupData'])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('group-store-data');
    
    Route::post('group-show-data', [ MasterDataController::class, 'ShowGroupData' ])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('group-show-data');
    
    Route::post('group-delete-data', [ MasterDataController::class, 'DeleteGroupData' ])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('group-data');

    // MASTER DATA ASSIGNED TO

    Route::get('/master-data/assigned', [MasterDataController::class, 'assigned_index'])
     ->name('/master-data/assigned');
 
    Route::post('assigned-view-data',[MasterDataController::class,'ViewAssignedContent'])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('assigned-view-data');
 
    Route::post('assigned-store-data',[MasterDataController::class,'StoreAssignedData'])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('assigned-store-data');
 
    Route::post('assigned-show-data', [ MasterDataController::class, 'ShowAssignedData' ])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('assigned-show-data');
 
    Route::post('assigned-delete-data', [ MasterDataController::class, 'DeleteAssignedData' ])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('assigned-data');

    //DEVICE LIST

    Route::get('/device_list', [DeviceController::class, 'device_index'])
     ->name('device_list');
 
    Route::post('device-view-data',[DeviceController::class,'ViewDeviceContent'])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('device-view-data');
 
    Route::post('device-store-data',[DeviceController::class,'StoreDeviceData'])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('device-store-data');
 
    Route::post('device-show-data', [ DeviceController::class, 'ShowDeviceData' ])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('device-show-data');
 
    Route::post('device-delete-data', [ DeviceController::class, 'DeleteDeviceData' ])
     ->middleware('cache.headers')
     ->middleware('throttle')
     ->name('device-data');

      //PURCHASE

      Route::get('/purchase', [PurchaseController::class, 'purchase_index'])
      ->name('purchase');
  
      Route::post('purchase-view-data',[PurchaseController::class,'ViewPurchaseContent'])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('purchase-view-data');
  
      Route::post('purchase-store-data',[PurchaseController::class,'StorePurchaseData'])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('purchase-store-data');
  
      Route::post('purchase-show-data', [ PurchaseController::class, 'ShowPurchaseData' ])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('purchase-show-data');
  
      Route::post('purchase-delete-data', [ PurchaseController::class, 'DeletePurchaseData' ])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('purchase-data');

      //ALLOCATION

      Route::get('/allocation', [AllocationController::class, 'allocation_index'])
      ->name('allocation');
  
      Route::post('allocation-view-data',[AllocationController::class,'ViewAllocationContent'])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('allocation-view-data');
  
      Route::post('allocation-store-data',[AllocationController::class,'StoreAllocationData'])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('allocation-store-data');
  
      Route::post('allocation-show-data', [ AllocationController::class, 'ShowAllocationData' ])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('allocation-show-data');
  
      Route::post('allocation-delete-data', [ AllocationController::class, 'DeleteAllocationData' ])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('allocation-data');

       //STOCK

       Route::get('/stock', [StockController::class, 'stock_index'])
       ->name('stock');
   
       Route::post('stock-view-data',[StockController::class,'ViewStockContent'])
       ->middleware('cache.headers')
       ->middleware('throttle')
       ->name('stock-view-data');
   
       Route::post('stock-store-data',[StockController::class,'StoreStockData'])
       ->middleware('cache.headers')
       ->middleware('throttle')
       ->name('stock-store-data');
   
       Route::post('stock-show-data', [ StockController::class, 'ShowStockData' ])
       ->middleware('cache.headers')
       ->middleware('throttle')
       ->name('stock-show-data');
   
       Route::post('stock-delete-data', [ StockController::class, 'DeleteStockData' ])
       ->middleware('cache.headers')
       ->middleware('throttle')
       ->name('stock-data');

        //AMC

        Route::get('/amc', [AmcController::class, 'amc_index'])
        ->name('amc');
    
        Route::post('amc-view-data',[AmcController::class,'ViewAmcContent'])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('amc-view-data');
    
        Route::post('amc-store-data',[AmcController::class,'StoreAmcData'])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('amc-store-data');
    
        Route::post('amc-show-data', [ AmcController::class, 'ShowAmcData' ])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('amc-show-data');
    
        Route::post('amc-delete-data', [ AmcController::class, 'DeleteAmcData' ])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('amc-data');

        //ODF

        Route::get('/odf', [OdfController::class, 'odf_index'])
        ->name('odf');
    
        Route::post('odf-view-data',[OdfController::class,'ViewOdfContent'])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('odf-view-data');
    
        Route::post('odf-store-data',[OdfController::class,'StoreOdfData'])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('odf-store-data');
    
        Route::post('odf-show-data', [ OdfController::class, 'ShowOdfData' ])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('odf-show-data');
    
        Route::post('odf-delete-data', [ OdfController::class, 'DeleteOdfData' ])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('odf-data');

   
        // INDIVIDUAL USER PROFILE

        Route::get('user_device', [ UserController::class, 'UserDevice' ])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('user_device');

        Route::post('.user_allocation-view-data',[UserController::class,'ViewUserAllocationContent'])
        ->middleware('cache.headers')
        ->middleware('throttle')
        ->name('user_allocation-view-data');
    

});
    // REPORT ROUTES
    Route::get('employee_report', [ReportsController::class, 'employee_report'])
    ->name('employee_report');

    Route::post('get_report', [ReportsController::class, 'GetReport'])
    ->name('get_report');

    //Employee register
    Route::get('/reports/print_emp_register/{emp_code}',[ReportsController::class,'printEmpRegister'])
      ->middleware('cache.headers')
      ->middleware('throttle')
      ->name('/reports/print_emp_register');











    //REPORT

    Route::get('/reports/release_order/{id}', [ReportsController::class, 'releaseOrder'])
    ->name('/reports/release_order');

    //issue register
    Route::get('/reports/issue-register', [ReportsController::class, 'indexIssueRegister'])
    ->name('/reports/issue-register');

    Route::post('issue_register-view-data',[ReportsController::class,'ViewIssueRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('issue_register-view-data');

    Route::post('get_issue_register',[ReportsController::class,'GetIssueRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('get_issue_register');

    Route::get('/reports/print_issue_register/{from}/{to}',[ReportsController::class,'printIssueRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('/reports/print_issue_register');

    //BILLING register
    Route::get('/reports/billing-register', [ReportsController::class, 'indexBillingRegister'])
    ->name('/reports/billing-register');
   
    Route::post('billing_register-view-data',[ReportsController::class,'ViewBillingRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('billing_register-view-data');
   
    Route::post('get_billing_register',[ReportsController::class,'GetBillingRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('get_billing_register');
   
    Route::get('/reports/print_billing_register/{from}/{to}',[ReportsController::class,'printBillingRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('/reports/print_billing_register');

    //BILLS not_paid_by_dipr

    Route::get('reports/not_paid_by_dipr', [ReportsController::class, 'indexNonDIPRRegister'])
    ->name('reports/not_paid_by_dipr');
   
    Route::post('nonDIPR_register-view-data',[ReportsController::class,'ViewNonDIPRRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('nonDIPR_register-view-data');
   
    Route::post('get_nonDIPR_register',[ReportsController::class,'GetNonDIPRRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('get_nonDIPR_register');
   
    Route::get('/reports/print_nonDIPR_register/{from}/{to}',[ReportsController::class,'printNonDIPRRegister'])
    ->middleware('cache.headers')
    ->middleware('throttle')
    ->name('/reports/print_nonDIPR_register');

    //Forwarding Letter

    Route::get('/reports/forwarding_letter/{id}', [ReportsController::class, 'forwardingLetter'])
    ->name('/reports/forwarding_letter');

    Route::get('/reports/detailed-expenditure-report', [ReportsController::class, 'detailedExpenditureReport'])
    ->name('/reports/detailed-expenditure-report');

    Route::get('/reports/bills-not-paid-by-dipr', [ReportsController::class, 'billsNotPaidByDIPR'])
    ->name('/reports/bills-not-paid-by-dipr');

    Route::get('/read',function(){  
        return DB::SELECT('SELECT * from public.users');
    });  


