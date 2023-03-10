<?php

namespace App\Services;

use App\Reports\CuratorActivitiesReport;
use App\Reports\ServiceCuratorsReport;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportService
{
    const CURATORS_REPORT = 'curators_report';
    const SERVICE_REPORT  = 'service_report';

    public function downloadReport(string $report, Collection $activities, Carbon $date): BinaryFileResponse
    {
        switch ($report) {
            case self::CURATORS_REPORT:
                return $this->downloadCuratorsReport($activities, $date);
            case self::SERVICE_REPORT:
                return $this->downloadServiceReport($activities, $date);
            default:
                throw new Exception('Такого отчета нет');
        }
    }

    private function downloadCuratorsReport(Collection $activities, Carbon $date): BinaryFileResponse
    {
        return Excel::download(new CuratorActivitiesReport($activities, $date), 'Отчет ФИСТ кураторы ' . $date->format('m.Y') . '.xlsx');
    }

    private function downloadServiceReport(Collection $activities, Carbon $date): BinaryFileResponse
    {
        $documentName = 'Служебная надбавка ' . $date->format('m.Y') . '.docx';

        $report = new ServiceCuratorsReport($activities, $date);
        $report->buildAndSave($documentName);

        return response()->download(Storage::path($documentName))->deleteFileAfterSend();
    }
}
