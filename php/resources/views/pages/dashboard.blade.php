@php
$thead = [
    'Name',
    'Date',
    'Price',
    'Category',
    'Status',
    'Action',
];
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <x-table :thead="$thead" title="Latest Transactions" titleClass="text-lg font-semibold text-gray-800"/>
    </div>
@endsection