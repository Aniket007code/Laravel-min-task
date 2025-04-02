<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .parent-conatiner01{
            /* background-color: aqua; */
            width: 100%;
            height: 80;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        .sare-routes{
            background-color: pink;
            display: flex;
            justify-content: space-around;
            align-items: center;
            list-style-type: none;
        }
    </style>

    <div class="parent-conatiner01">
        <h1>ider apne routes honge</h1>
    </div>

    <div class="sare-routes">
        <a href="admin/dashboard">
            <li>Admin Dashboard</li>
        </a>
        <a href="user/dashboard">
            <li>user Dashboard</li>
        </a>
        <a href="testPage">
            <li>Test page</li>
        </a>
    </div>

</x-app-layout>




