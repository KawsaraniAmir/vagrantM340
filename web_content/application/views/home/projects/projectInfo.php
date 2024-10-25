<h2>Info</h2>
<div class="analyse">
    <div class="searches">
        <div class="status">
            <div class="info">
                <h3>Starting Date</h3>
                <h1><?php echo $project->startingDate; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches">
        <div class="status">
            <div class="info">
                <h3>Author</h3>
                <h1><?php echo $project->author; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches">
        <div class="status">
            <div class="info">
                <h3>Type</h3>
                <h1><?php echo $project->type; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches"  <?php if($_SESSION['username'] == $project->author): ?>
        onclick="changeProjectDescription(<?php echo $project->id; ?>, '<?php echo $project->description; ?>', '<?php echo URL."projectController/modifyDescription"; ?>')"
    <?php endif; ?>>
        <div class="status">
            <div class="info">
                <h3>Description</h3>
                <h1 id="description"><?php echo $project->description; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches" <?php if($_SESSION['username'] == $project->author): ?>
        onclick="changeProjectState(<?php echo $project->id; ?>, '<?php echo $project->state; ?>', '<?php echo URL."projectController/modifyState"; ?>')"
    <?php endif; ?>>
        <div class="status">
            <div class="info">
                <h3>Status</h3>
                <h1 id="state"><?php echo $project->state;?></h1>
            </div>
        </div>
    </div>
</div>
