<div class="user-page container">
    <div class="table-responsive d-flex justify-content-center h-100">
        <div class="card">
                <div class="header flex-row">
                    <h2>User Information</h2>
                </div>
            <div class="card-body">

        
                <div class="box" id="user_data">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="data" id="email"><?php echo $email ?></div>
                    </div>                    
                                           
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <div class="data" id="name"><?php echo $name ?></div>
                    </div>                    
                                           
                    <div class="form-group">
                        <label for="lastname">Lastname:</label>
                        <div class="data" id="lastname"><?php echo $lastname ?></div>
                    </div>                    
                                           
                    <div class="form-group">
                        <label for="dob">Date of birth:</label>
                        <div class="data" id="dob"><?php echo $dob ?></div>
                    </div>                    
                </div>
            </div>
            
            <div class="buttons">
                <button type="button" class="btn btn-primary">
                    <a href="edit.php">Edit</a>
                </button>                
                <button type="button" class="btn btn-danger">
                    <a href="logout.php">Logout</a>
                </button>
            </div>
        </div>        
    </div>
</div>