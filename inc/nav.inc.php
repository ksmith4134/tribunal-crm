<nav class="navbar navbar-expand-lg bg-white sticky-top" style="box-shadow: 2px 4px 4px #ddd;">
    <!-- <img src="img/gavel2.png" alt="" width="30" class="d-inline-block mb-2" style="margin-left:15px;"> -->
    <a class="navbar-brand gradient-text nav-text" href="<?php echo ROOT_URL; ?>">Tribunal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto pt-1">
            <li class="nav-item ms-3 me-4">
                <a class="nav-link" href="<?php echo ROOT_URL; ?>"><i class="fas fa-chart-area" style="margin-right:5px;"></i>Dashboard</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="<?php echo ROOT_URL.'leads.php'; ?>"><i class="fas fa-user-friends" style="margin-right:5px;"></i>Leads</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="<?php echo ROOT_URL.'projects.php'; ?>"><i class="fas fa-clipboard" style="margin-right:5px;"></i>Projects</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="<?php echo ROOT_URL.'companies.php'; ?>"><i class="fas fa-store" style="margin-right:5px;"></i>Companies</a>
            </li>           
            <li class="nav-item me-4">
                <a class="nav-link" href="<?php echo ROOT_URL.'todos.php'; ?>"><i class="fas fa-tasks" style="margin-right:5px;"></i>To-Dos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo ROOT_URL.'settings.php'; ?>"><i class="fas fa-cog" style="margin-right:5px;"></i>Settings</a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->
        </ul>
        <!-- <span class="navbar-text ms-auto" style="padding-right:30px;">
            The Leading B2B CRM
        </span> -->
    </div>
</nav>

<style>
    .gradient-text {
        background-color: #4169E1;
        background-image: linear-gradient(45deg, #4169E1, #76FFB9);
        background-size: 100%;
        background-clip: text;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        -webkit-text-fill-color: transparent; 
        -moz-text-fill-color: transparent;
    }

    .nav-text {
        margin-left:50px;
        font-weight:700;
        font-size:1.7em;
    }
</style>