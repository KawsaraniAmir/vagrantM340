<main>
    <h1>Types</h1>
    <?php
    if ($_SESSION['role'] == 'Admin') {
        require 'application/views/home/stats/adminStats.php';
    } else {
        require 'application/views/home/stats/userStats.php';
    }
    ?>
    <div class="recent-orders">
        <h2>Types</h2>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody id="types">
            <?php foreach ($types as $type): ?>
                <tr>
                    <td
                        onclick="changeTypeName('<?php echo $type->name; ?>', '<?php echo URL."typeController/modifyName"; ?>')"><?php echo $type->name; ?></td>
                    <td
                        onclick="changeTypeDescription('<?php echo $type->name; ?>', '<?php echo $type->description; ?>', '<?php echo URL."typeController/modifyDescription"; ?>')"><?php echo $type->description; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a onclick="newType('<?php echo URL."typeController/add"; ?>')" style="display: <?php
        if ($_SESSION['role'] == 'Admin') {
            echo 'block';
        } else {
            echo 'none';
        }
        ?>">Add a type</a>
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