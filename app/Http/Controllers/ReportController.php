<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function reportsView()
    {
        return view('reports.main');
    }

    public function downloadReport(Request $request): BinaryFileResponse
    {
        $date = now()->setMonth($request->get('month'))->setYear($request->get('year'));
        $report = $request->get('report');
        $activities = Activity::query()
            ->whereBetween('date', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])
            ->get();

        return app(ReportService::class)->downloadReport($report, $activities, $date);
    }
}
