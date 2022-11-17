<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timeline of the charging processes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 style="font-size: 19px; font-weight: bold">
                        Aggregated Consumption of all charging processes within a day
                    </h3>
                    <timeline-charging-processes></timeline-charging-processes>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
