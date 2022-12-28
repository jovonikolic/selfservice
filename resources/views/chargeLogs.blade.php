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
                        <button class="button-3"><i class="fa fa-download"></i> Download Raw Data</button>
                    </a>
                    <a type="button" class="button-3" href="{{ url('/chargingProcessAnalytics') }}">
                        Analyze Charging Process Data
                    </a>
                    <a type="button" class="button-3" href="{{ url('/weeklyChargingProcessAnalytics') }}">
                        See Weekly Charging Process Data
                    </a>
                    <charge-logs></charge-logs>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .button-3 {
        display: block;
        margin-bottom: 10px;
        width: 350px;
        appearance: none;
        background-color: #2ea44f;
        border: 1px solid rgba(27, 31, 35, .15);
        border-radius: 6px;
        box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        padding: 6px 16px;
        position: relative;
        text-align: center;
        text-decoration: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: middle;
        white-space: nowrap;
    }

    .button-3:focus:not(:focus-visible):not(.focus-visible) {
        box-shadow: none;
        outline: none;
    }

    .button-3:hover {
        background-color: #2c974b;
    }

    .button-3:focus {
        box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
        outline: none;
    }

    .button-3:disabled {
        background-color: #94d3a2;
        border-color: rgba(27, 31, 35, .1);
        color: rgba(255, 255, 255, .8);
        cursor: default;
    }

    .button-3:active {
        background-color: #298e46;
        box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
    }
</style>
