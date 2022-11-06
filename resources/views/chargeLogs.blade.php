<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Charging Processes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ url('/csvExport', ["chargingProcesses"]) }}" target="_blank">
                        <button class="btn"><i class="fa fa-download"></i> Download Raw Data </button>
                    </a>
                    <a type="button" href="{{ url('/chargingProcessAnalytics') }}" style="display: block">
                        Analyze Charging Process Data
                    </a>
                    <charge-logs></charge-logs>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
