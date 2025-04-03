@extends('layouts.app')

@section('content')
<h1>Create Record</h1>
<form action="{{ route('records.store') }}" method="POST">
    @csrf
    <label for="data">Data:</label>
    <input type="text" name="data" id="data">
    <button type="submit">Save</button>
</form>
@endsection
