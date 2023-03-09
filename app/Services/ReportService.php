<?php

namespace App\Services;

use App\Reports\CuratorActivitiesReport;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportService
{
    const CURATORS_REPORT = 'curators_report';
    const SERVICE_REPORT = 'service_report';

    public function downloadReport(string $report, Collection $activities, Carbon $date): BinaryFileResponse
    {
        switch ($report) {
            case self::CURATORS_REPORT:
                return $this->downloadCuratorsReport($activities, $date);
            default:
                throw new Exception('Такого отчета нет');
        }
    }

    private function downloadCuratorsReport(Collection $activities, Carbon $date): BinaryFileResponse
    {
        return Excel::download(new CuratorActivitiesReport($activities, $date), 'Отчет ФИСТ кураторы ' . $date->format('m.Y') . '.xlsx');
    }
}
