<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="content flex-grow-1">



            <!-- Rides Table -->
            <div class="container">
                <h1>Rides</h1>
                <div class="mb-3">
                    <a href="{{ route('rides.add') }}" class="btn btn-primary">Add Ride</a>
                    </p>

                    <table class="table table-bordered">
                        <!-- ticket list -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Driver</th>
                                <th>Time</th>
                                <th>Price</th>
                                <th>Seats</th>
                                <th>Pickup</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rides as $ride)
                                <tr>
                                    <td>{{ $ride['id'] }}</td>
                                    <td>{{ $ride['company'] }}</td>
                                    <td>{{ $ride['time'] }}</td>
                                    <td>{{ $ride['price'] }}</td>
                                    <td>{{ $ride['totalSeats'] }}</td>
                                    <td>{{ $ride['pickup'] }}</td>
                                    <td>{{ $ride['destination'] }}</td>
                                    <td>{{ $ride['status'] }}</td>
                                    <td>
                                        @if ($ride['status'] === 'completed')
                                            <button class="btn btn-success" disabled>
                                                <i class="bi bi-check-circle-fill">Completed</i>
                                            </button>
                                        @else
                                            <form action="{{ route('rides.edit', ['id' => $ride['id']]) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class="bi bi-pencil-fill">Change state</i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('rides.detail', ['id' => $ride['id']]) }}" class="btn btn-info">
                                            <i class="bi bi-eye-fill">View</i>
                                        </a>
                                        <a href="{{ route('rides.edit', ['id' => $ride['id']]) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square">Edit</i>
                                        </a>
                                        <form action="{{ route('rides.delete', ['id' => $ride['id']]) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash-fill">Delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
</body>

</html>