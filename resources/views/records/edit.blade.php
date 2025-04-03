@extends('layouts.app')

@section('content')
<h1>Edit Record</h1>
<form action="{{ route('records.update', $id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="data">Data:</label>
    <input type="text" name="data" id="data" value="{{ $record['data'] ?? '' }}">
    <button type="submit">Update</button>
</form>
@endsection
