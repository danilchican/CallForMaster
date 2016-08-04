<div class="special-item">
    <input type="hidden" class="special-id" value="{{ $specialization->id }}">
    <b>{{ $specialization->name }}</b>
    <div class="pull-right">
        <i class="fa fa-pencil edit-special" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#edit-special-modal"></i>
        <i class="fa fa-times del-special" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Delete"></i>
    </div>
</div>