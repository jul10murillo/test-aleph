@extends('layouts.app')

@section('title', 'CMDB Records')

@section('content')
<h2>CMDB Records</h2>

@if(empty($records))
    <div class="alert alert-warning">No records found for this category.</div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Identifier</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record['identifier'] }}</td>
                    <td>{{ $record['name'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('cmdb.export', ['categoryId' => $categoryId, 'categoryName' => urlencode($categoryName)]) }}" class="btn btn-primary">Export</a>
@endif

<h3>Import Records</h3>
<form action="{{ route('cmdb.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit" class="btn btn-success">Import</button>
</form>
@endsection