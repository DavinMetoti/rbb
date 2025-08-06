@extends('app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-6">{{ __('participants') }} - Locale Test</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold mb-4">Translation Test</h2>
                    <table class="w-full border">
                        <tr>
                            <td class="border px-4 py-2 font-medium">Key</td>
                            <td class="border px-4 py-2 font-medium">Translation</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">participants</td>
                            <td class="border px-4 py-2">{{ __('messages.participants') }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">add_participant</td>
                            <td class="border px-4 py-2">{{ __('messages.add_participant') }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">logout</td>
                            <td class="border px-4 py-2">{{ __('messages.logout') }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">search</td>
                            <td class="border px-4 py-2">{{ __('messages.search') }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">edit</td>
                            <td class="border px-4 py-2">{{ __('messages.edit') }}</td>
                        </tr>
                    </table>
                </div>
                
                <div>
                    <h2 class="text-lg font-semibold mb-4">Debug Information</h2>
                    <table class="w-full border">
                        <tr>
                            <td class="border px-4 py-2 font-medium">Session Locale</td>
                            <td class="border px-4 py-2">{{ session('applocale', 'not set') }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-medium">App Locale</td>
                            <td class="border px-4 py-2">{{ app()->getLocale() }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-medium">Config Locale</td>
                            <td class="border px-4 py-2">{{ config('app.locale') }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-medium">HTML Lang</td>
                            <td class="border px-4 py-2">{{ session('applocale', 'en') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-4">Test Links</h2>
                <div class="space-x-4">
                    <a href="{{ url('/lang/en') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        🇬🇧 Set English
                    </a>
                    <a href="{{ url('/lang/zh') }}" 
                       class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        🇨🇳 Set Chinese
                    </a>
                    <a href="{{ route('participants.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Go to Participants
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
