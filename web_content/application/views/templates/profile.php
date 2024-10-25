
<div class="nav">
    <button id="menu-btn">
        <span class="material-icons-sharp">
            menu
        </span>
    </button>

    <div class="dark-mode">
        <span class="material-icons-sharp active">
            light_mode
        </span>
        <span class="material-icons-sharp">
            dark_mode
        </span>
    </div>

    <div class="profile">
        <div class="info">
            <p>Hey, <b><?php echo $_SESSION['username']?></b></p>
            <small class="text-muted"></small>
        </div>
        <div class="profile-photo">
            <img src="<?php echo URL?>application/public/home/images/profile-1.jpg">
        </div>
    </div>
</div>
<div class="user-profile">
    <div class="logo">
        <img src="<?php echo URL?>application/public/home/images/logo.jpg">
        <h2><?php echo $_SESSION['name']?> <?php echo $_SESSION['surname']?></h2>
    </div>
</div>