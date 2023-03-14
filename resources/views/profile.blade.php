@extends('base')

@section('title', 'profile')

@section('body')
    <h1>Profile Page</h1>

    <div class="relative overflow-x-auto">
        <table style="margin-top: 1%" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Field
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Value
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $userDetails)
                    @if($key != 'password_reset_token')
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$key}}
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            {{$userDetails??'-'}}
                        </th>
                    </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

