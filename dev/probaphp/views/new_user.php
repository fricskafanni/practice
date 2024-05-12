<div class="user-page container">
    <div class="table-responsive d-flex justify-content-center h-100">
        <div class="card">
                <div class="header flex-row">
                    <h2>Create new User</h2>
                </div>
            <div class="card-body">

                <form class="box update-form" id="userDataForm">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" value="<?php echo $email ?>" placeholder="Email" class="form-control" required/>
                    </div>                    
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" value="" placeholder="" class="form-control" required/>
                    </div>                    
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="<?php echo $name  ?>" placeholder="" class="form-control" required/>
                    </div>                    
                    <div class="form-group">
                        <label for="lastname">Lastname:</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $lastname  ?>" placeholder="" class="form-control" required/>
                    </div>                    
                    <div class="form-group">
                        <label for="password">Date of birth:</label>
                        <input type="text" name="dob" id="dob" value="<?php echo $dob  ?>" placeholder="" class="form-control" required/>
                    </div>
                </form>
            </div>
            
            <div class="buttons">
                <button type="button" class="btn btn-primary">
                    <a href="edit.php">Edit</a>
                </button>                
                <button class="btn btn-primary" type="button" ><action="action"
                    onclick="window.history.go(-1); return false;"
                    type="submit"
                    value="Cancel">Back</action>
                </button>
            </div>
        </div>        
    </div>
</div>