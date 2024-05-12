<div class="container">
        <div class="table-responsive">
            <div class="header flex-row">
                <h2>Create new user</h2>
            </div>
            
            <form class="box update-form" id="userDataForm">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" value="" placeholder="Email" class="form-control" required/>
                        </div>                    
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" value="" placeholder="" class="form-control" required/>
                        </div>                    
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" value="" placeholder="Name" class="form-control" required/>
                        </div>                    
                        <div class="form-group">
                            <label for="lastname">Lastname:</label>
                            <input type="text" name="lastname" id="lastname" value="" placeholder="Lastname" class="form-control" required/>
                        </div>                    
                        <div class="form-group">
                            <label for="password">Date of birth:</label>
                            <input type="text" name="dob" id="dob" value="" placeholder="YYYY/MM/DD" class="form-control" required/>
                        </div>
            </form>
        </div>
        
        <div class="create">
            <button class="btn btn-primary" type="button" id="createNewUser">Create</button>
            <button class="btn btn-primary" type="button" ><action="action"
                onclick="window.history.go(-1); return false;"
                type="submit"
                value="Cancel">Back</action>
            </button>
        </div>
    </div>