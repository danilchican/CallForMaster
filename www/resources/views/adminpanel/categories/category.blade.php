<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $dep  }} {{ $category->name }}</td>
    <td>/{{ $category->slug }}</td>
    <td>{{ empty($desc = $category->desc) ? "No descrition yet..." : $desc }}</td>
    @foreach ($category->children as $child)
        @include('adminpanel.categories.category', ['category' => $child, 'dep' => $dep.'-'])
    @endforeach
</tr>
