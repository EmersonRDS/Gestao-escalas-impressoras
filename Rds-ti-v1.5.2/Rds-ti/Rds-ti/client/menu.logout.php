<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <i data-feather="menu"></i>
                    <span class="text-dark"><?php echo $_SESSION['nome']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item"  href='logout.php?btn_logout=0' style='text-align: justify;'>
                        <i data-feather="log-out"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>