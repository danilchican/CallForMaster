<div class="spoiler" data-spoiler-link="{{ $category->id }}">
    @if($category->getDescendantCount() > 0)
        <i class="fa fa-plus left-ico" aria-hidden="true"></i>
    @endif
        <b>{{ $category->name }}</b>
    <div class="pull-right">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        <i class="fa fa-times" aria-hidden="true"></i>
    </div>
</div>
<div class="spoiler-content" data-spoiler-link="{{ $category->id }}">
    @foreach ($category->children as $child)
        @include('adminpanel.categories.category', ['category' => $child, 'dep' => $dep.'-'])
    @endforeach
</div>
