<div class="category-item col-md-6">
    <input type="checkbox" name="cat-id" value="{{ $category->id }}"> {{  $category->name }}
    @if($count > 0)
        <div class="row">
            <div class="category-item col-md-12">
                @foreach ($category->children as $child)
                    @include('account.settings.work.typeview', ['category' => $child, 'dep' => $dep.'-'])
                @endforeach
            </div>
        </div>
    @endif
</div>

