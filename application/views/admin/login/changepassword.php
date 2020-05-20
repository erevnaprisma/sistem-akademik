<form id="changePasswordForm" method="post" action="<?=base_url('api/auth/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3"></i> Password Old</label>
        <div class="col-md-9">
            <input type="password" name="password_old" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"></i> Password New</label>
        <div class="col-md-9">
            <input type="password" name="password" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"></i> Password Repeat</label>
        <div class="col-md-9">
            <input type="password" name="password_repeat" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>