<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use App\Models\Student;
use App\Models\Subject;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(private readonly ReportService $reportService)
    {
    }

    public function index(Request $request): View
    {
        return view('reports.index', [
            'reports' => $this->reportService->listLatest($request->only([
                'student_id',
                'subject_id',
                'semester',
                'academic_year',
            ])),
            'students' => Student::query()->orderBy('full_name')->get(),
            'subjects' => Subject::query()->orderBy('name')->get(),
            'filters' => $request->only(['student_id', 'subject_id', 'semester', 'academic_year']),
        ]);
    }

    public function store(StoreReportRequest $request): RedirectResponse
    {
        $this->reportService->create(
            $request->validated(),
            $request->user()?->id
        );

        return back()->with('status', 'Data rapor berhasil disimpan.');
    }

    public function edit(Report $report): View
    {
        return view('reports.edit', [
            'report' => $report->load(['student', 'subject']),
            'students' => Student::query()->orderBy('full_name')->get(),
            'subjects' => Subject::query()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateReportRequest $request, Report $report): RedirectResponse
    {
        $this->reportService->update($report, $request->validated());

        return redirect()->route('reports.index')->with('status', 'Data rapor berhasil diperbarui.');
    }

    public function destroy(Report $report): RedirectResponse
    {
        $this->reportService->delete($report);

        return back()->with('status', 'Data rapor berhasil dihapus.');
    }

    public function exportPdf(Request $request): Response
    {
        $reports = $this->reportService->listLatest($request->only([
            'student_id',
            'subject_id',
            'semester',
            'academic_year',
        ]), 500);

        $pdf = Pdf::loadView('reports.pdf', [
            'reports' => $reports,
            'generatedAt' => now(),
        ]);

        return $pdf->download('rapor-summary.pdf');
    }
}
