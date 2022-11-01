<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ChargingProcessController;
use App\Http\Controllers\Api\ChargingStationController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ErrorController;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CsvController extends Controller
{
    /**
     * @var ErrorController
     */
    protected ErrorController $errorController;

    /**
     * @var ChargingProcessController
     */
    protected ChargingProcessController $chargingProcessController;

    /**
     * @var ChargingStationController
     */
    protected ChargingStationController $chargingStationController;

    /**
     * When the class is called, the controllers are available through dependency injection
     *
     * @param ErrorController $errorController
     * @param ChargingProcessController $chargingProcessController
     * @param ChargingStationController $chargingStationController
     */
    public function __construct(ErrorController           $errorController,
                                ChargingProcessController $chargingProcessController,
                                ChargingStationController $chargingStationController)
    {
        $this->errorController = $errorController;
        $this->chargingProcessController = $chargingProcessController;
        $this->chargingStationController = $chargingStationController;
    }

    /**
     * @param Request $request
     * @return BinaryFileResponse|void
     */
    public function getCSV(Request $request)
    {
        $userId = auth()->user()->id;

        $exportType = $request->type ?: null;
        if (!$exportType) {
            return;
        }

        $data = null;
        $headers = null;
        $fileName = Uuid::uuid4()->toString();

        // TODO: Create cases for other export types
        switch ($exportType) {
            case 'errors':
                $data = $this->errorController->getErrorsForCSVExport($userId);
                $headers = [[
                    "id",
                    "code",
                    "info",
                    "cp_id",
                    "occurred",
                    "solved"
                ]];
                break;
            case 'chargingProcesses':
                $data = $this->chargingProcessController->getChargeLogsForCSVExport($userId);
                $headers = [[
                    "id",
                    "cp_id",
                    "start",
                    "end",
                    "kwh_start",
                    "kwh_end",
                    "invoiced"
                ]];
                break;
            case 'chargingStations':
                $data = $this->chargingStationController->getStationsForCSVExport($userId);
                $headers = [[
                    "id",
                    "label",
                    "public_display_name",
                    "street",
                    "city",
                    "zip",
                    "geo_long",
                    "geo_lat",
                    "serialnumber"
                ]];
            default:
                break;
        }

        $this->createFile($data, $headers, $fileName);
        return response()->download(
            storage_path('../public/' . "$fileName.csv"),
            "$fileName.csv"
        );
    }

    private function createFile($data, $headers, $fileName): void
    {
        $fp = fopen($fileName . '.csv', 'w');

        foreach ($headers as $header) {
            fputcsv($fp, $header);
        }
        foreach ($data as $fields) {
            fputcsv($fp, get_object_vars($fields));
        }

        fclose($fp);
    }
}
