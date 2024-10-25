            <main>
                <h1><?php echo $project->name; ?></h1>
                <?php
                require 'application/views/home/projects/projectInfo.php';
                ?>
                <div class="recent-orders">
                    <h2>Members</h2>
                    <table>
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>City</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody id="users">
                        <?php foreach ($members as $member): ?>
                            <tr>
                                <td><?php echo $member->username; ?></td>
                                <td><?php echo $member->name; ?></td>
                                <td><?php echo $member->surname; ?></td>
                                <td><?php echo $member->city; ?></td>
                                <td><a onclick="removeUserFromProject('<?php echo $project->id; ?>','<?php echo $member->username; ?>','<?php echo URL."projectController/removeUser"; ?>')">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a onclick="addUserToProject(
                    '<?php echo $project->id; ?>',
                        '<?php echo URL."projectController/addUser"; ?>')" style="display: <?php
                    if ($_SESSION['role'] == 'Admin') {
                        echo 'block';
                    } else {
                        echo 'none';
                    }
                    ?>">Add a member</a>
                </div>
                <div class="recent-orders">
                    <h2>Activities</h2>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Starting Date</th>
                            <th>Ending Date</th>
                            <th>Hours</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Author</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($activities as $activity): ?>
                            <tr>
                                <td><?php echo $activity->id; ?></td>
                                <td><?php echo $activity->startingDate; ?></td>
                                <td><?php echo $activity->endingDate; ?></td>
                                <td><?php echo $activity->hours; ?></td>
                                <td><?php echo $activity->description; ?></td>
                                <td><?php echo $activity->state; ?></td>
                                <td><?php echo $activity->author; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
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