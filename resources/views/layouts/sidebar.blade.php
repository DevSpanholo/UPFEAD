<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-graduation-cap"></i> 
    </div>
    <div class="sidebar-brand-text mx-3">Upf Ead - Cursos</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-tachometer-alt"></i> 
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('courses') }}">
      <i class="fas fa-book"></i> 
      <span>Cursos</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('modules.index') }}">
      <i class="fas fa-cube"></i> 
      <span>Módulos</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('lessons.create') }}">
      <i class="fas fa-chalkboard-teacher"></i> 
      <span>Aula</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('enrollments.index') }}">
      <i class="fas fa-clipboard-list"></i> 
      <span>Matrículas</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/profile">
      <i class="fas fa-user"></i> 
      <span>Perfil</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
