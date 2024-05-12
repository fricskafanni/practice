<div class="container">
    <div class="table-responsive">
        <div class="header flex-row">
            <h2>Change password</h2>
        </div>
        
        <form class="box update-form" id="userDataForm">
            <div class="form-group">
                <label for="password">Previous password:</label>
                <input type="password" name="password" id="password" value="" placeholder="" class="form-control" required/>
            </div>                    
            <div class="form-group">
                <label for="password1">New password:</label>
                <input type="password" name="password1" id="password1" value="" placeholder="" class="form-control" required/>
            </div>                        
            <div class="form-group">
                <label for="password2">New password again:</label>
                <input type="password" name="password2" id="password2" value="" placeholder="" class="form-control" required/>
            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $_GET['id']?>"/>
            </div>
        </form>
    </div>
    
    <div class="update">
        <button class="btn btn-primary" type="button" id="updateUserPassword">Save</button>
        <button class="btn btn-primary" type="button" ><action="action"
            onclick="window.history.go(-1); return false;"
            type="submit"
            value="Cancel">Back</action>
        </button>
    </div>
</div>