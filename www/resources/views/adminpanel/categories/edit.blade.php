<!-- Edit modal -->

<div class="modal fade" id="edit-cat-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Редактирование категории</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    {!! Form::open(array('id' => 'edit-category-form')) !!}
                    <input type="hidden" class="cat-id" name="id" />
                    <div class="form-group">
                        <label for="name">Название категории</label>
                        <input type="text" class="form-control" id="cat-name-edit" name="name" placeholder="Введите название категории">
                    </div>
                    <div class="form-group">
                        <label for="slug">Ссылка</label>
                        <input type="text" class="form-control" id="cat-slug-edit" name="slug">
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
                        <textarea class="form-control" rows="5" id="desc-edit" name="desc"></textarea>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="update-btn">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>