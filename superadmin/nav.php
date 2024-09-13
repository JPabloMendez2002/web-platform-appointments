<!-- Navbar -->
<div class="sidebar" data-color="red">
    <div class="logo">
        <a class="simple-text logo-mini">
            B
        </a>
        <a class="simple-text logo-normal">
            Bienestar
        </a>
    </div>

    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <?php if ($_SESSION['nav'] == 'inicio') {
            ?>
                <li class="active">
                    <a href="inicio.php">
                        <i class="now-ui-icons health_ambulance"></i>
                        <p>Inicio</p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="inicio.php">
                        <i class="now-ui-icons health_ambulance"></i>
                        <p>Inicio</p>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php if ($_SESSION['nav'] == 'citas') {
            ?>
                <li class="active">
                    <a href="citas.php">
                        <i class="now-ui-icons files_single-copy-04"></i>
                        <p>Lista de Citas</p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="citas.php">
                        <i class="now-ui-icons files_single-copy-04"></i>
                        <p>Lista de Citas</p>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php if ($_SESSION['nav'] == 'usuarios') {
            ?>
                <li class="active">
                    <a href="usuarios.php">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>Lista De Usuarios</p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="usuarios.php">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>Lista De Usuarios</p>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php if ($_SESSION['nav'] == 'historial') {
            ?>
                <li class="active">
                    <a href="historial.php">
                        <i class="fa-solid fa-folders"></i>
                        <p>Historial Citas</p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="historial.php">
                        <i class="fa-solid fa-folders"></i>
                        <p>Historial Citas</p>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php if ($_SESSION['nav'] == 'perfil') {
            ?>
                <li class="active">
                    <a href="perfil.php">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>Mi Perfil</p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="perfil.php">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>Mi Perfil</p>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>

<div class="main-panel" id="main-panel">
    <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <div class="navbar-toggle">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <a class="navbar-brand" href="inicio.php">Inicio</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="now-ui-icons users_single-02"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="perfil.php">Perfil</a>
                            <a class="dropdown-item" href="salir.php">Cerrar Sesión</a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->