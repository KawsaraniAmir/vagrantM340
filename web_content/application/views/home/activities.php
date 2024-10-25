            <main>
                <h1>Activities</h1>
                <?php
                if ($_SESSION['role'] == 'Admin') {
                    require 'application/views/home/stats/adminStats.php';
                } else {
                    require 'application/views/home/stats/userStats.php';
                }
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
                            <th>Project ID</th>
                            <th>Author</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($associatedActivities as $projectId => $activities): ?>
                            <?php foreach ($activities as $activity): ?>
                                <tr>
                                    <td><?php echo $activity->id; ?></td>
                                    <td><?php echo $activity->startingDate; ?></td>
                                    <td><?php echo $activity->endingDate; ?></td>
                                    <td><?php echo $activity->hours; ?></td>
                                    <td><?php echo $activity->description; ?></td>
                                    <td><?php echo $activity->state; ?></td>
                                    <td><?php echo $activity->projectId; ?></td>
                                    <td><?php echo $activity->author; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="#" style="display: <?php
                    if ($_SESSION['role'] == 'Admin') {
                        echo 'block';
                    } else {
                        echo 'none';
                    }
                    ?>">Add project</a>
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