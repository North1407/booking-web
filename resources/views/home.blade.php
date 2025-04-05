<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/TRIPMATE.png') }}');
            background-size: cover;
        }

        .d-flex {
            height: 100vh;
            overflow: hidden;
        }

        .content {
            flex-grow: 1;
            /* Adjust padding to match sidebar width */
            background: url('{{ asset('images/TRIPMATE.png') }}');
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="content"></div>