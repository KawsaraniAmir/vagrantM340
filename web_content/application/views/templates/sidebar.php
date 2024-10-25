<div class="container">
    <aside>
        <div class="toggle">
            <div class="logo">
                <img src="<?php echo URL?>application/public/home/images/logo.jpg" style="border-radius: 50% ;">
                <h2>Kaw<span class="danger">ami</span></h2>
            </div>
            <div class="close" id="close-btn">
                        <span class="material-icons-sharp">
                            close
                        </span>
            </div>
        </div>

        <div class="sidebar">
            <a href="<?php echo URL?>home/index"
               class="<?php Sidebar::sidebarActivate('dashboard');?>">
                        <span class="material-icons-sharp">
                            dashboard
                        </span>
                <h3>Dashboard</h3>
            </a>

            <a href="<?php echo URL; ?>home/projects"
               class="<?php Sidebar::sidebarActivate('projects');?>"
               style="display:  <?php Sidebar::adminFunction();?>">
                        <span class="material-icons-sharp">
                            book
                        </span>
                <h3>Projects</h3>
            </a>

            <a href="<?php echo URL; ?>home/types"
               class="<?php Sidebar::sidebarActivate('types');?>"
               style="display: <?php Sidebar::adminFunction();?>">
                        <span class="material-icons-sharp">
                            chat
                        </span>
                <h3>Types</h3>
            </a>

            <a href="<?php echo URL; ?>home/users"
               class="<?php Sidebar::sidebarActivate('users');?>"
               style="display:  <?php Sidebar::adminFunction();?>">
                        <span class="material-icons-sharp">
                            person
                        </span>
                <h3>Users</h3>
            </a>

            <a href="<?php echo URL?>home/logout">
                        <span class="material-icons-sharp">
                            logout
                        </span>
                <h3>Logout</h3>
            </a>

        </div>
    </aside>