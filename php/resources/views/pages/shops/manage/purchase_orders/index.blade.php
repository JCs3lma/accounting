@extends('pages.shops.manage.app')
@php
$thead = [
    'profile_path' =>  [
        'header' => 'Profile',
        'tdClass' => 'w-[10vw] max-w-[10vw] lg:w-[5vw] lg:max-w-[5vw] overflow-hidden text-ellipsis',
        'cast' => 'img',
        'tdContentClass' => 'w-full h-16 object-cover rounded-md',
        'defaultAlt' => 'Profile',
    ],
    'fullname' => 'Name',
    'email' => 'Email',
    'phone' => 'Phone',
    'mobile' => 'mobile',
    'shop.employment_status' => 'Status',
    'shop.employment_status' => 'Status',
    'shop.hire_date' => 'Date Hired',
    'shop.is_active' => [
        'header' => 'Active',
        'cast' => 'span',
        'tdContentClass' => 'px-2 py-1 rounded-full text-xs font-semibold h-full',
        'tdContentClassActive' => 'bg-green-100 text-green-800',
        'tdContentClassInactive' => 'bg-red-100 text-red-800',
    ],
];
@endphp
@section('shop_content')
    <article>
        <h1>Purchase Orders</h1>
    </article>
@endsection

@section('footer')
    <x-modal header="Add Staff" headerClass="modalTitle">
        <div id="modalContent"></div>
    </x-modal>
@endsection