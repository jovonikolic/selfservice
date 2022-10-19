<?php

namespace App\Http\Controllers;

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

    public function __construct(ErrorController $errorController)
    {
        $this->errorController = $errorController;
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
