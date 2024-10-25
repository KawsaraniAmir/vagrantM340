            <main>
                <h1>Projects</h1>
                <?php
                if ($_SESSION['role'] == 'Admin') {
                    require 'application/views/home/stats/adminStats.php';
                } else {
                    require 'application/views/home/stats/userStats.php';
                }
                ?>
                <div class="recent-orders">
                    <h2>Your Projects</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Project Id</th>
                                <th>Project Name</th>
                                <th>Starting Date</th>
                                <th>Author</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($projects as $project): ?>
                            <tr onclick="window.location='<?php echo URL; ?>home/project/<?php echo $project->id?>'">
                                <td><?php echo $project->id; ?></td>
                                <td><?php echo $project->name; ?></td>
                                <td><?php echo $project->startingDate; ?></td>
                                <td><?php echo $project->author; ?></td>
                                <td><?php echo $project->description; ?></td>
                                <td><?php echo $project->state; ?></td>
                                <td><?php echo $project->type; ?></td>
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