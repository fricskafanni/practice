<div class="user-page container">
    <div class="table-responsive d-flex justify-content-center h-100">
        <div class="card">
                <div class="header flex-row">
                    <h2>User Information</h2>
                </div>
            <div class="card-body">
                <form class="box" id="userDataForm">
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" value="<?php echo $id ?>" placeholder="" class="form-control" readonly/>
                    </div>                      
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" value="<?php echo $userEmail ?>" placeholder="" class="form-control" required/>
                    </div>                    
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="<?php echo $userName  ?>" placeholder="" class="form-control" required/>
                    </div>                    
                    <div class="form-group">
                        <label for="lastname">Lastname:</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $userLastname  ?>" placeholder="" class="form-control" required/>
                    </div>                    
                    <div class="form-group">
                        <label for="password">Date of birth:</label>
                        <input type="text" name="dob" id="dob" value="<?php echo $userDob  ?>" placeholder="" class="form-control" required/>
                    </div>                    
                </form>
            </div>
            
            <div class="buttons">
                <button class="btn btn-primary" type="button" id="updateUser">Edit</button>                
                <button class="btn btn-primary" type="button" ><action="action"
                    onclick="window.history.go(-1); return false;"
                    type="submit"
                    value="Cancel">Back</action>
                </button>
            </div>
        </div>        
    </div>
</div>