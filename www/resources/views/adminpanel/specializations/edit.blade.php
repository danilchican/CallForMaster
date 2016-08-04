<!-- Edit modal -->

<div class="modal fade" id="edit-special-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Редактирование специальности</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    {!! Form::open(array('id' => 'edit-special-form')) !!}
                    <input type="hidden" class="special-id" name="id" />
                    <div class="form-group">
                        <label for="name">Название специальности</label>
                        <input type="text" class="form-control" id="special-name-edit" name="name" placeholder="Введите название специальности">
                    </div>
                    <div class="form-group">
                        <label for="slug">Ссылка</label>
                        <input type="text" class="form-control" id="special-slug-edit" name="slug">
                    </div>
                    <div class="form-group">
                        <label for="desc">Описание специальности</label>
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