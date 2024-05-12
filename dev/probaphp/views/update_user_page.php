<div class="container">
        <div class="table-responsive">
            <div class="header flex-row">
                <h2>User Information</h2>
            </div>
            
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
        
        <div class="update">
            <button class="btn btn-primary" type="button" id="update">Update</button>
            <button class="btn btn-primary" type="button" ><action="action"
                    onclick="window.history.go(-1); return false;"
                    type="submit"
                    value="Cancel">Back</action>
            </button>
        </div>
    </div>