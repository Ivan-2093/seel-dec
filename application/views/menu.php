<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="<?php echo base_url() ?>">
            <div class="logo-img">
                <img width="30px" src="<?php echo base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" class="header-brand-img" alt="lavalite">
            </div>
            <span class="text">SEELDEC</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <?php echo $data_menus ?>
            </nav>
        </div>
    </div>
</div>