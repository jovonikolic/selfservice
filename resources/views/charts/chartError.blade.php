<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Charts for errors from the charging stations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ url('/csvExport', ["errors"]) }}" target="_blank">
                        <button class="btn"><i class="fa fa-download"></i> Download Raw Data </button>                    </a>
                    <div style="width: 50%">
                        <h3 style="font-size: 19px; font-weight: bold">
                            Error codes by occurrence
                        </h3>
                        <error-charts></error-charts>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
