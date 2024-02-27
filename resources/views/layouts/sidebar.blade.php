<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
<!-- <li class="nav-item" >
  <i class="bi bi-person"></i>
  <span>{{$role}}</span>
</li>
<br> -->
<li class="nav-item">
  <a class="nav-link" href="{{ route('home') }}">
    <i class="bi bi-grid"></i>
    <span>Home</span>
  </a>
</li>
@if ($role=='SuperAdmin') 
<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin') }}">
    <i class="bi bi-person"></i>
      <span>Admin Management</span>
    </a>
  </li>
  @endif
  @if ($role=='SuperAdmin' || $role=='Admin')
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('user')}}">
    <i class="bi bi-person"></i>
      <span>User Management </span>
    </a>
  </li>
  @endif

  @if ($role=='Admin' )
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Master Data </span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a  href="{{route('/master-data/item_type')}}">
          <i class="bi bi-circle"></i><span>Items</span>
        </a>
      </li>
      <!-- <li>
        <a href="{{route('/master-data/employee')}}">
          <i class="bi bi-circle"></i><span>Employees</span>
        </a>
      </li> -->
      <li>
        <a  href="{{route('/master-data/category')}}">
          <i class="bi bi-circle"></i><span>Device Category</span>
        </a>
      </li>

      <li>
        <a  href="{{route('/master-data/oem')}}">
          <i class="bi bi-circle"></i><span>OEM</span>
        </a>
      </li>

      <li>
        <a  href="{{route('/master-data/division')}}">
          <i class="bi bi-circle"></i><span>Division</span>
        </a>
      </li>
      <li>
        <a  href="{{route('/master-data/group')}}">
          <i class="bi bi-circle"></i><span>Location</span>
        </a>
      </li>
      <li>
        <a  href="{{route('/master-data/assigned')}}">
          <i class="bi bi-circle"></i><span>Assigned To</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('device_list')}}">
    <i class="bi bi-person"></i>
      <span>Device List</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('purchase')}}">
    <i class="bi bi-person"></i>
      <span>Purchase</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('allocation')}}">
    <i class="bi bi-person"></i>
      <span>Allocation</span>
    </a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('stock')}}">
    <i class="bi bi-person"></i>
      <span>Stock</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('device_list')}}">
    <i class="bi bi-person"></i>
      <span>Amc</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('odf')}}">
    <i class="bi bi-person"></i>
      <span>Odf</span>
    </a>
  </li> -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Reports </span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('employee_report')}}">
          <i class="bi bi-circle"></i><span>Reports</span>
        </a>
      </li>
      <!-- <li>
        <a href="{{route('/reports/billing-register')}}">
          <i class="bi bi-circle"></i><span>Yearly Report Form</span>
        </a>
      </li>
      <li>
        <a  href="">
          <i class="bi bi-circle"></i><span>Detailed Report</span>
        </a>
      </li> -->
      
    </ul>
  </li>
  @endif
  
  @if ($role=='User' )
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('user_device')}}">
    <i class="bi bi-person"></i>
      <span>Device Allocation</span>
    </a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('device_list')}}">
    <i class="bi bi-person"></i>
      <span>Report</span>
    </a>
  </li>
  
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Reports </span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{route('/reports/issue-register')}}">
          <i class="bi bi-circle"></i><span>Issue Form</span>
        </a>
      </li>
      <li>
        <a href="{{route('/reports/billing-register')}}">
          <i class="bi bi-circle"></i><span>Return From</span>
        </a>
      </li>
      
      
    </ul>
  </li> -->
  @endif
 
  <!-- End Login Page Nav -->



<li class="nav-item">

  <a class="nav-link collapsed" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-in-right"></i>
        <span>Logout</span>
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
  </li>
  </ul>
</aside>