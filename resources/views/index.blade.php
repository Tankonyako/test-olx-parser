<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('index.title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
</head>
<body class="flex w-full h-screen items-center justify-center gap-10">
<div class="w-full bg-blue-200/20 max-w-[300px] min-h-[300px] rounded-xl overflow-clip">
    <div class="bg-blue-700 p-4">
        <h1 class="text-2xl font-bold text-gray-100 dark:text-white">@lang('index.title')</h1>
    </div>

    <div class="grid grid-cols-1 gap-4  p-4">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('index.title.add')</h2>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('index.form.input.url.title')</label>
            <input type="text" id="url" name="url"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="@lang('index.form.input.url.placeholder')" required/>
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('index.form.input.email.title')</label>
            <input type="text" id="email" name="email"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="@lang('index.form.input.email.placeholder')" required/>
        </div>
        <div>
            <button type="button" id="add" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                @lang('index.form.submit.title')
            </button>
        </div>
        <hr>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('index.title.list')</h2>
        <div id="list">
        </div>
    </div>
</div>
<div class="w-full bg-blue-200/10 max-w-[400px] min-h-[500px] rounded-xl overflow-clip">
    <div class="bg-blue-700 p-4">
        <h1 class="text-2xl font-bold text-gray-100 dark:text-white">@lang('index.title.api')</h1>
    </div>
    <!-- list api methods-->
    <div class="grid grid-cols-1 gap-4 p-4">
        <div class="gap-2 flex flex-col">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('index.title.api.list')</h2>
            <span class="font-mono bg-gray-900 text-gray-100 w-full block p-2 rounded-xl"><span class="text-green-500">GET</span> /api/olx/list</span>
        </div>
        <hr>
        <div class="gap-2 flex flex-col">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('index.title.api.add')</h2>
            <span class="font-mono bg-gray-900 text-gray-100 w-full block p-2 rounded-xl"><span class="text-orange-500">POST</span> /api/olx/add</span>
            <h3>@lang('index.title.api.add.params')</h3>
            <ul class="list-disc list-inside">
                <li><span class="text-green-500">url</span> - @lang('index.title.api.add.params.url')</li>
                <li><span class="text-green-500">email</span> - @lang('index.title.api.add.params.email')</li>
            </ul>
        </div>
        <hr>
        <div class="gap-2 flex flex-col">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('index.title.api.delete')</h2>
            <span class="font-mono bg-gray-900 text-gray-100 w-full block p-2 rounded-xl"><span class="text-red-500">DELETE</span> /api/olx/delete/{id}</span>
            <h3>@lang('index.title.api.delete.params')</h3>
            <ul class="list-disc list-inside">
                <li><span class="text-green-500">id</span> - @lang('index.title.api.delete.params.id')</li>
            </ul>
        </div>
    </div>
</div>
<div style="display: none">
    <div class="item flex gap-4" id="pattern-list-item">
        <div class="w-1/2">
            <img src="#" alt="Image" class="w-full h-full object-contain item-image"/>
        </div>
        <div class="flex flex-col justify-center gap-2">
            <div>
                <h1 class="text-lg font-bold text-gray-900 dark:text-white item-title">Title</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 item-description">Description</p>
            </div>
            <hr>
            <div>
                <p><span class="item-price">0</span> <span class="item-currency">UAH</span></p>
                <p class="text-[10px] text-gray-500 item-last-change-at">2021-01-01 00:00:00</p>
            </div>
            <hr>
            <a href="#" class="text-blue-700 dark:text-blue-500 item-link" target="_blank">@lang('index.list.button.go')</a>
            <a href="#" data-delete-id="-1" class="text-red-700 dark:text-red-500 item-delete">@lang('index.list.button.delete')</a>
        </div>
    </div>
</div>

<!-- Styles / Scripts -->
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
</body>
</html>