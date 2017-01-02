<div class="box box-default create-category">
    <div class="box-header with-border">
        <i class="fa fa-edit"></i>
        <h3 class="box-title">Add Category</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(array('id' => 'create-category-form')) !!}
        <div class="form-group">
            <label for="name">Название категории</label>
            <input type="text" class="form-control" id="category-name" name="name" placeholder="Введите название категории">
        </div>
        <div class="form-group">
            <label for="slug">Ссылка</label>
            <input type="text" class="form-control" id="category-slug" name="slug">
        </div>
        <div class="form-group">
            <label for="parent">Дочерняя категория</label>
            <select name="parent" class="form-control select2 select2-hidden-accessible parent-select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                <option></option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="desc">Описание категории</label>
            <textarea class="form-control" rows="5" name="desc"></textarea>
        </div>
        <button type="submit" class="btn btn-success save-button">Сохранить</button>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>