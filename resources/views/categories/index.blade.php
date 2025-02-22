@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<h2>Categories</h2>
<ul class="list-group">
    @foreach($categories as $category)
        <li class="list-group-item">
            <a href="{{ route('cmdb.show', $category['id']) }}">{{ $category['name'] }}</a>
            <br>
            <strong>CMDB Fields:</strong>
            <ul>
                @foreach($category['cmdb_fields'] as $field)
                    <li>{{ $field }}</li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
@endsection