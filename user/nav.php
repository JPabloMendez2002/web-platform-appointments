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
                    <i class="now-ui-icons ui-1_calendar-60"></i>
                        <p>Reservar Cita</p>
                    </a>
                </li>
                <li>
                <?php
            } else {
                ?>
                <li>
                    <a href="citas.php">
                    <i class="now-ui-icons ui-1_calendar-60"></i>
                        <p>Reservar Cita</p>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php if ($_SESSION['nav'] == 'historial') {
            ?>
                <li class="active">
                    <a href="historial.php">
                    <i class="now-ui-icons files_single-copy-04"></i>
                        <p>Historial Citas</p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="historial.php">
                    <i class="now-ui-icons files_single-copy-04"></i>
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
                        <p>Perfil</p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li>
                    <a href="perfil.php">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>Perfil</p>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>