<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="input-group form-group phone-item">
            <input type="hidden" name="phone-id" value="{{ $phone->id }}">
            <input type="text" class="form-control" placeholder="+375(29)123-45-67" name="number" value="{{ $phone->number }}">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default update-phone-item"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-default del-phone-item"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->