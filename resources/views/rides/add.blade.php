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

        <div class="container" style="margin-top: 4%; margin-left: 1%;">
            <h2>Thêm chuyến đi</h2>
            <form action="{{ route('rides.add') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="car_details">Chọn xe</label>
                    <select class="form-control" id="car_details" name="car_details" required>
                        @foreach ($vehicles as $carDetail)
                            <option value="{{ $carDetail['id'] }}">{{ $carDetail['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="company">Tài xế</label>
                    <select class="form-control" id="company" name="company" required>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver['name'] }}">{{ $driver['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="date">Ngày chạy</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group mb-3">
                    <label for="pickup">Điểm bắt đầu</label>
                    <select class="form-control" id="pickup" name="pickup" required>
                        @foreach ($locations as $location)
                            <option value="{{ $location['id'] }}">{{ $location['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="destination">Điểm kết thúc</label>
                    <select class="form-control" id="destination" name="destination" required>
                        @foreach ($locations as $location)
                            <option value="{{ $location['id'] }}">{{ $location['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Giá vé</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group mb-3">
                    <label for="time">Giờ chạy</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>
                <br>
                <div style="text-align: center;"><button type="submit" class="btn btn-primary">Xác nhận</button></div>
            </form>
        </div>
        </form>
    </div>
    </div>
</body>

</html>