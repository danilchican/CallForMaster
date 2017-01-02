<div class="box box-default create-category">
    <div class="box-header with-border">
        <i class="fa fa-edit"></i>
        <h3 class="box-title">Add Service</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['route' => 'admin.tariffs.additional.create', 'id' => 'create-service-form']) !!}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Введите название услуги">
        </div>
        <button type="submit" class="btn btn-success save-button">Сохранить</button>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>