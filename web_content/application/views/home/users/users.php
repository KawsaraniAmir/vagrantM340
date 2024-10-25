<main>
    <h1>Users</h1>
    <?php
    if ($_SESSION['role'] == 'Admin') {
        require 'application/views/home/stats/adminStats.php';
    } else {
        require 'application/views/home/stats/userStats.php';
    }
    ?>
    <div class="recent-orders">
        <h2>Users</h2>
        <table>
            <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Surname</th>
                <th>City</th>
                <th>Role</th>
                <th>Disable</th>
            </tr>
            </thead>
            <tbody id="users">
                <?php foreach ($users as $user): ?>
                    <?php if($user->username != "deleted_user"): ?>
                        <tr onclick="window.location='<?php echo URL; ?>home/user/<?php echo $user->username; ?>'">
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->surname; ?></td>
                            <td><?php echo $user->city; ?></td>
                            <td><?php echo $user->role; ?></td>
                            <td><a onclick="deleteUser('<?php echo $user->username; ?>','<?php echo URL."userController/delete"; ?>')">Delete</a></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a onclick="newUser('<?php echo URL."userController/add"; ?>')" style="display: <?php
        if ($_SESSION['role'] == 'Admin') {
            echo 'block';
        } else {
            echo 'none';
        }
        ?>">Add a user</a>
    </div>
</main>
<div class="right-section">
    <?php require 'application/views/templates/profile.php'; ?>
    <div class="reminders" style="display: none">
        <div class="header">
            <h2>Reminders</h2>
            <span class="material-icons-sharp">
                notifications_none
            </span>
        </div>
        <div class="notification">
            <div class="icon">
                <span class="material-icons-sharp">
                    volume_up
                </span>
            </div>
            <div class="content">
                <div class="info">
                    <h3>Workshop</h3>
                    <small class="text_muted">
                        08:00 AM - 1:00 PM
                    </small>
                </div>
                <span class="material-icons-sharp">
                    more_vert
                </span>
            </div>
        </div>
        <div class="notification deactive">
            <div class="icon">
                <span class="material-icons-sharp">
                    group
                </span>
            </div>
            <div class="content">
                <div class="info">
                    <h3>Meeting</h3>
                    <small class="text_muted">
                        3:00 PM - 5:00 PM
                    </small>
                </div>
                <span class="material-icons-sharp">
                    more_vert
                </span>
            </div>
        </div>
        <div class="notification add-reminder">
            <div>
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Add Activity</h3>
            </div>
        </div>
    </div>
</div>