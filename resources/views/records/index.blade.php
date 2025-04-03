@extends('layouts.app')

@section('content')
<h1>Records</h1>
<a href="{{ route('records.create') }}">Create New Record</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $id => $record)
        <tr>
            <td>{{ $id }}</td>
            <td>{{ json_encode($record) }}</td>
            <td>
                <a href="{{ route('records.edit', $id) }}">Edit</a>
                <form action="{{ route('records.destroy', $id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
