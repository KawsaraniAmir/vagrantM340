            <main>
                <h1><?php echo $project->name; ?></h1>
                <?php
                require 'application/views/home/projects/projectInfo.php';
                ?>
                <div class="recent-orders">
                    <h2>Your Activities</h2>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Starting Date</th>
                            <th>Ending Date</th>
                            <th>Hours</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="activities">
                        <?php foreach ($activities as $activity): ?>
                            <tr>
                                <td><?php echo $activity->id; ?></td>
                                <td><?php echo $activity->startingDate; ?></td>
                                <td onclick="changeActivityEndingDate('<?php echo $activity->id; ?>', '<?php echo $activity->endingDate; ?>','<?php echo URL."activityController/modifyEndingDate"; ?>')" ><?php echo $activity->endingDate; ?></td>
                                <td onclick="changeActivityHours('<?php echo $activity->id; ?>', '<?php echo $activity->hours; ?>','<?php echo URL."activityController/modifyHours"; ?>')" ><?php echo $activity->hours; ?></td>
                                <td onclick="changeActivityDescription('<?php echo $activity->id; ?>', '<?php echo $activity->description; ?>','<?php echo URL."activityController/modifyDescription"; ?>')" ><?php echo $activity->description; ?></td>
                                <td onclick="changeActivityState('<?php echo $activity->id; ?>', '<?php echo $activity->state; ?>','<?php echo URL."activityController/modifyState"; ?>')" ><?php echo $activity->state; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a onclick="newActivity('<?php echo $project->id; ?>', '<?php echo URL."activityController/add"; ?>')" style="display: <?php
                    if ($_SESSION['role'] == 'User') {
                        echo 'block';
                    } else {
                        echo 'none';
                    }
                    ?>">Add an activity</a>
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