<div class="box box-default create-specialization">
    <div class="box-header with-border">
        <i class="fa fa-edit"></i>
        <h3 class="box-title">Add Specialization</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(array('id' => 'create-specialization-form')) !!}
        <div class="form-group">
            <label for="name">Название специальности</label>
            <input type="text" class="form-control" id="special-name" name="name" placeholder="Введите название специальности">
        </div>
        <div class="form-group">
            <label for="slug">Ссылка</label>
            <input type="text" class="form-control" id="special-slug" name="slug">
        </div>
        <div class="form-group">
            <label for="desc">Описание специальности</label>
            <textarea class="form-control" rows="5" name="desc"></textarea>
        </div>
        <button type="submit" class="btn btn-success save-button">Сохранить</button>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>