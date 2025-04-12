
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="{{ route('home') }}" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="../../dist/assets/img/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">AdminLTE 4</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Dashboard
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-box-arrow-in-right"></i>
              <p>
                Auth
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                  <p>
                    Version 1
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./examples/login.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Login</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./examples/register.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Register</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                  <p>
                    Version 2
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./examples/login-v2.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Login</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./examples/register-v2.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Register</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="./examples/lockscreen.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">DOCUMENTATIONS</li>
          <li class="nav-item">
            <a href="./docs/introduction.html" class="nav-link">
              <i class="nav-icon bi bi-download"></i>
              <p>Installation</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./docs/layout.html" class="nav-link">
              <i class="nav-icon bi bi-grip-horizontal"></i>
              <p>Layout</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./docs/color-mode.html" class="nav-link">
              <i class="nav-icon bi bi-star-half"></i>
              <p>Color Mode</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-ui-checks-grid"></i>
              <p>
                Components
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./docs/components/main-header.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Main Header</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./docs/components/main-sidebar.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Main Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-filetype-js"></i>
              <p>
                Javascript
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./docs/javascript/treeview.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Treeview</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="./docs/browser-support.html" class="nav-link">
              <i class="nav-icon bi bi-browser-edge"></i>
              <p>Browser Support</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./docs/how-to-contribute.html" class="nav-link">
              <i class="nav-icon bi bi-hand-thumbs-up-fill"></i>
              <p>How To Contribute</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./docs/faq.html" class="nav-link">
              <i class="nav-icon bi bi-question-circle-fill"></i>
              <p>FAQ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./docs/license.html" class="nav-link">
              <i class="nav-icon bi bi-patch-check-fill"></i>
              <p>License</p>
            </a>
          </li>
          
        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>
  <!--end::Sidebar-->