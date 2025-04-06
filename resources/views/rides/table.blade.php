<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <style>
        /* Highlight row on hover */
        table tbody tr:hover {
            background-color: #f0f8ff;
        }

        /* Enable scrolling for the table */
        .table-container {
            max-height: 500px;
            /* Adjust height as needed */
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <div class="main-content flex-grow-1" style="margin-top: 2%; margin-left: -15%;">
            <!-- Main Content -->
            <div class="content flex-grow-1">
                <!-- Rides Table -->
                <div class="container">
                    <h1>Danh sách chuyến đi</h1>
                    <!-- Display general error messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Display success message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <a href="{{ route('rides.add') }}" class="btn btn-primary">Thêm chuyến đi</a>
                    </div>
                    <div class="table-container">
                        <table class="table table-bordered">
                            <!-- ticket list -->
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tài xế</th>
                                    <th>Giờ chạy</th>
                                    <th>Giá vé</th>
                                    <th>Số vé</th>
                                    <th>Điểm bắt đầu</th>
                                    <th>Điểm kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
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
                                        <td>
                                            @if ($ride['status'] === 'completed')
                                                <span class="text-success">Hoàn thành</span>
                                            @elseif ($ride['status'] === 'upcoming')
                                                <span>Chưa khởi hành</span>
                                            @else
                                                <span>Đang trong chuyến</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($ride['status'] === 'completed')
                                                <button class="btn  btn-secondary" disabled>
                                                    <i class="bi bi-check-circle-fill">Đổi trạng thái</i>
                                                </button>
                                            @else
                                                <form action="{{ route('rides.edit', ['id' => $ride['id']]) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-pencil-fill">Đổi trạng thái</i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('rides.detail', ['id' => $ride['id']]) }}"
                                                class="btn btn-info">
                                                <i class="bi bi-eye-fill">Xem chi tiết</i>
                                            </a>
                                            <a href="{{ route('rides.edit', ['id' => $ride['id']]) }}"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil-square">Sửa</i>
                                            </a>
                                            <form action="{{ route('rides.delete', ['id' => $ride['id']]) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash-fill">Xóa</i>
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
        </div>
    </div>
</body>

</html>