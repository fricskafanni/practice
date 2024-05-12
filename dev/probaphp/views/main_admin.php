<div class="user-page">
    <div class="profile">
        <div class="profile-container">
            <a href="edit.php" class="profile-pic">
                <img src="img/profile.svg"></img>
            </a>
        </div>
        <div class="admin-data">
            <p>
                <?php echo $name  ?>
            </p>            
            <p>
                <?php echo $lastname  ?>
            </p>            
            <p>
                <?php echo $email  ?>
            </p>            
            <p>
                <?php echo $dob  ?>
            </p>
        </div>
        <div class="logout">
            <button type="button" class="btn btn-danger">
                <a href="logout.php">Logout</a>
            </button>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive d-flex justify-content-center h-100">
            <div class="card">
                <table class="table-class">
                    <thead>
                        <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">LASTNAME</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">BIRTHDAY</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($users as $user){ ?>
                            <tr>
                                <td class="col"><?php echo $user['name'] ?></td>
                                <td class="col"><?php echo $user['lastname'] ?></td>
                                <td class="col"><?php echo $user['email'] ?></td>
                                <td class="col"><?php echo $user['dob'] ?></td>
                                <td style="display: flex;">
                                    <button class="btn primary" onclick="editUser('<?php echo $user['id'] ?>')" style="margin: 0 10px 0 0;">Edit</button>
                                    <button class="btn primary" onclick="deleteUser('<?php echo $user['id'] ?>')" style="margin: 0 10px 0 0;">Delete</button>
                                    <button class="btn primary" onclick="changeUserPassword('<?php echo $user['id'] ?>')">Password</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
    
                </table>
            </div>
            <div class="create-btn">
                <button type="button" class="btn btn-primary">
                    <a href="create.php">Create new User</a>
                </button>
            </div>
        </div>
    </div>
</div>





