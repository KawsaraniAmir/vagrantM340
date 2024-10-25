<h2>Info</h2>
<div class="analyse">
    <div class="searches"
         onclick="changeUserUsername('<?php echo $user->username; ?>', '<?php echo URL."userController/modifyUsername"; ?>')">
        <div class="status">
            <div class="info">
                <h3>Username</h3>
                <h1 id="username"><?php echo $user->username; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches"
         onclick="changeUserName('<?php echo $user->username; ?>', '<?php echo $user->name; ?>', '<?php echo URL."userController/modifyName"; ?>')">
        <div class="status">
            <div class="info">
                <h3>Name</h3>
                <h1 id="name"><?php echo $user->name; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches"
         onclick="changeUserSurname('<?php echo $user->username; ?>', '<?php echo $user->surname; ?>', '<?php echo URL."userController/modifySurname"; ?>')">
        <div class="status">
            <div class="info">
                <h3>Surname</h3>
                <h1 id="surname"><?php echo $user->surname; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches"
         onclick="changeUserCity('<?php echo $user->username; ?>', '<?php echo $user->city; ?>', '<?php echo URL."userController/modifyCity"; ?>')">
        <div class="status">
            <div class="info">
                <h3>City</h3>
                <h1 id="city"><?php echo $user->city; ?></h1>
            </div>
        </div>
    </div>
    <div class="searches"
         onclick="changeUserRole('<?php echo $user->username; ?>', '<?php echo $user->role; ?>', '<?php echo URL."userController/modifyRole"; ?>')">
        <div class="status">
            <div class="info">
                <h3>Role</h3>
                <h1 id="role"><?php echo $user->role; ?></h1>
            </div>
        </div>
    </div>
</div>
