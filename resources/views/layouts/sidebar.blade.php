    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary min-vh-100">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Rio Blog</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'text-primary' : 'text-black' }}" aria-current="page" href="{{ route('dashboard') }}">
                <i class="bi bi-house-door-fill mb-1"></i>Dashboard</a>

            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/posts') ? 'text-primary' : 'text-black' }}" href="{{ route('authors') }}">
                <i class="bi bi-pencil"></i>
                Authors
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/posts') ? 'text-primary' : 'text-black' }}" href="{{ route('publishers') }}">
                <i class="bi bi-people-fill"></i>
                Publishers
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/posts') ? 'text-primary' : 'text-black' }}" href="{{ route('categories') }}">
                <i class="bi bi-signpost-split"></i>
                Categories
              </a>
            </li>

             <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/posts') ? 'text-primary' : 'text-black' }}" href="{{ route('books') }}">
                <i class="bi bi-book mb-1"></i>
                books
              </a>
            </li>
          </ul>
          <hr class="my-3">
          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
              <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/logout') ? 'text-primary' : 'text-black' }}"><i class="bi bi-arrow-left"></i>
                        Logout</a></button>
                      </form>
            </li>
          </ul>
        </div>

        @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-center px-3 mt-4 mb-1 text-muted">
          <span>Administrator</span>
          
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/categories*') ? 'text-primary' : 'text-black' }}" href="/dashboard/categories">
                <i class="bi bi-stack"></i>
                Post Categories
              </a>
            </li>
        </ul>
        @endcan
      </div>
    </div>