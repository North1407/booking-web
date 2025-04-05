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
        <div class="content flex-grow-1" style="margin-top: 2%; margin-left: -15%;">
            <div class="container">
                <h1>Danh sách vé</h1>
                <!-- <div>
                    <p>Pickup: {{ $ride['pickup'] }} | Destination: {{ $ride['destination'] }} | Driver:
                        {{ $ride['company'] }}
                    </p>
                    <p>Price: {{ $ride['price'] }} | Status: {{ $ride['status'] }} | Total Seats:
                        {{ $ride['totalSeats'] }}
                    </p>
                </div> -->
                <table class="table table-bordered">
                    <!-- ticket list -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Điển đón</th>
                            <th>Điểm trả</th>
                            <th>Phương thức TT</th>
                            <th>Số vé</th>
                            <th>Số tiền</th>
                            <th>Đã thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket['id'] }}</td>
                                <td>{{ $ticket['name'] }}</td>
                                <td>{{ $ticket['email'] }}</td>
                                <td>{{ $ticket['phoneNumber'] }}</td>
                                <td>{{ $ticket['pickupPoint'] }}</td>
                                <td>{{ $ticket['dropoffPoint'] }}</td>
                                <td>{{ $ticket['payment_method'] }}</td>
                                <td>{{ $ticket['quantity'] }}</td>
                                <td>{{ $ticket['price'] }}</td>
                                <td>
                                    <a href="{{ route('tickets.updateStatus', ['id' => $ticket['id']]) }}"
                                        class="text-decoration-none d-flex justify-content-center">
                                        @if ($ticket['status'] === 'Đã thanh toán')
                                            <span class="text-success d-flex justify-content-center">&#10003;</span>
                                        @else
                                            <span class="text-danger d-flex justify-content-center">&#10060;</span>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('rides.index') }}" class="btn btn-primary">Quay về</a>
            </div>
        </div>
    </div>
</body>

</html>