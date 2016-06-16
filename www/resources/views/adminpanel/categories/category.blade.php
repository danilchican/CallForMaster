<div class="spoiler category" data-spoiler-link="{{ $category->id }}">
    @if($count = $category->getDescendantCount() > 0)
        <i class="fa fa-plus left-ico" aria-hidden="true"></i>
    @endif
        <b>{{ $category->name }}</b>
    <div class="pull-right">
        <i class="fa fa-pencil edit-cat" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#edit-cat-modal"></i>
        <i class="fa fa-times del-cat" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Delete"></i>
    </div>
</div>
@if($count > 0)
    <div class="spoiler-content" data-spoiler-link="{{ $category->id }}">
        @foreach ($category->children as $child)
            @include('adminpanel.categories.category', ['category' => $child, 'dep' => $dep.'-'])
        @endforeach
    </div>
@endif
