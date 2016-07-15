<!-- Create modal -->

<div class="modal fade" id="create-album-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Создание альбома</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    {!! Form::open(array('id' => 'create-album-form')) !!}
                    <div class="form-group">
                        <label for="name">Название альбома</label>
                        <input type="text" class="form-control" name="name" placeholder="Введите название альбома">
                    </div>
                    <div class="form-group">
                        <label for="desc">Описание</label>
                        <textarea class="form-control" rows="5" name="desc"></textarea>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="create-btn">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>