@extends('layouts.app_1')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Devices List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Devices</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Bordered Tabs Justified -->
              <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="myTab" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="user-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-food" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-card-list"></i> &nbsp;Devices</button>
                </li>
               
              </ul>
              <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-food" role="tabpanel" aria-labelledby="user-tab">
              
                <div class="alert alert-success alert-block table_msg3" style="display:none;">
                          <strong>Data deleted successfully</strong>
                  </div>
                  <div class="alert alert-danger table_msg4" style="display:none;">
                          <strong>Whoops!</strong> There were some problems with the application.            
                  </div>

                <table class="user-table" width="100%"> 
                <thead>
                  <tr>
                    <th class="text-center" scope="col" width="5%">#</th>
                    <th class="text-center" scope="col" width="15%">Employee</th>
                    <th class="text-center" scope="col" width="15%">Device</th>
                    <th class="text-center" scope="col" width="15%">Issued on</th>
                    <th class="text-center" scope="col" width="15%">Returned On</th>
                    <th class="text-center" scope="col" width="15%">Assigned To</th>
                   
                  </tr>
                </thead>
                <tbody align=center>
                    @foreach($userAllocationsWithDetails as $key=>$all)
                    <td>{{++$key}}</td>
                    <td>{{++$key}}</td>
                    <td>{{++$key}}</td>
                    <td>{{++$key}}</td>
                    @endforeach
                </tbody>
                </table>

        
               </div>

                
              </div><!-- End Bordered Tabs Justified -->

            </div>
        </div>
      </div>
    </section>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  </main>
<style>
    .pointer {cursor: pointer;}
</style>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

@endsection