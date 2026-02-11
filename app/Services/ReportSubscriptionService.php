<?php

namespace App\Services;

use App\Models\AnnualReport;
use App\Models\DocumentReport;
use App\Models\FinancialReport;
use App\Models\FinancialStatement;
use App\Models\InvestorPresentation;
use App\Models\InvestorReport;
use App\Models\ReportSubscriber;
use App\Models\Shareholder;
use App\Models\ShareholderReport;
use App\Models\StockInformation;
use App\Models\StockReport;
use Illuminate\Support\Carbon;

class ReportSubscriptionService
{
    public function __construct(private EmailService $emailService)
    {
    }

    public function notifyDocumentReport(DocumentReport $document): void
    {
        $publishAt = $document->created_at ?? now();

        $this->notifySubscribers([
            'report_name' => $document->name,
            'report_type' => 'Dokumen',
            'file_name' => $this->resolveFileName($document->original_filename ?? null, $document->report),
            'file_original_name' => $document->original_filename,
            'publish_date' => $publishAt->toDateString(),
            'publish_date_label' => $publishAt->format('d F Y'),
            'list_url' => route('front.documents', ['publish_date' => $publishAt->toDateString()]),
        ]);
    }

    public function notifyAnnualReport(AnnualReport $report): void
    {
        $publishAt = $report->created_at ?? now();

        $this->notifySubscribers([
            'report_name' => $report->name,
            'report_type' => 'Tahunan',
            'file_name' => $this->resolveFileName($report->original_filename ?? null, $report->report),
            'file_original_name' => $report->original_filename,
            'publish_date' => $publishAt->toDateString(),
            'publish_date_label' => $publishAt->format('d F Y'),
            'list_url' => route('front.report', ['publish_date' => $publishAt->toDateString()]),
        ]);
    }

    public function notifyFinancialReport(FinancialStatement $statement, FinancialReport $report): void
    {
        $publishAt = $this->normalizePublishDate($statement->publish_at);

        $this->notifySubscribers([
            'report_name' => $report->name,
            'report_type' => 'Keuangan',
            'file_name' => $this->resolveFileName($report->original_filename ?? null, $report->report),
            'file_original_name' => $report->original_filename,
            'publish_date' => $publishAt->toDateString(),
            'publish_date_label' => $publishAt->format('d F Y'),
            'list_url' => route('front.financial', ['publish_date' => $publishAt->toDateString()]),
        ]);
    }

    public function notifyInvestorReport(InvestorPresentation $presentation, InvestorReport $report): void
    {
        $publishAt = $this->normalizePublishDate($presentation->publish_at);

        $this->notifySubscribers([
            'report_name' => $report->name,
            'report_type' => 'Presentasi Investor',
            'file_name' => $this->resolveFileName($report->original_filename ?? null, $report->report),
            'file_original_name' => $report->original_filename,
            'publish_date' => $publishAt->toDateString(),
            'publish_date_label' => $publishAt->format('d F Y'),
            'list_url' => route('front.investor', ['publish_date' => $publishAt->toDateString()]),
        ]);
    }

    public function notifyStockReport(StockInformation $stock, StockReport $report): void
    {
        $publishAt = $this->normalizePublishDate($stock->publish_at);

        $this->notifySubscribers([
            'report_name' => $report->name,
            'report_type' => 'Saham dan Obligasi',
            'file_name' => $this->resolveFileName($report->original_filename ?? null, $report->report),
            'file_original_name' => $report->original_filename,
            'publish_date' => $publishAt->toDateString(),
            'publish_date_label' => $publishAt->format('d F Y'),
            'list_url' => route('front.stock', ['publish_date' => $publishAt->toDateString()]),
        ]);
    }

    public function notifyShareholderReport(Shareholder $shareholder, ShareholderReport $report): void
    {
        $publishAt = $this->normalizePublishDate($shareholder->publish_at);

        $this->notifySubscribers([
            'report_name' => $report->name,
            'report_type' => 'Rapat Umum Pemegang Saham',
            'file_name' => $this->resolveFileName($report->original_filename ?? null, $report->report),
            'file_original_name' => $report->original_filename,
            'publish_date' => $publishAt->toDateString(),
            'publish_date_label' => $publishAt->format('d F Y'),
            'list_url' => route('front.shareholder', ['publish_date' => $publishAt->toDateString()]),
        ]);
    }

    private function notifySubscribers(array $payload): void
    {
        $subscribers = ReportSubscriber::where('is_active', true)->get();

        if ($subscribers->isEmpty()) {
            return;
        }

        $sendImmediately = $this->shouldSendImmediately();

        foreach ($subscribers as $subscriber) {
            if ($sendImmediately) {
                $this->emailService->sendReportSubscriptionNotification($subscriber, $payload);
                continue;
            }

            $this->emailService->queueReportSubscriptionNotification($subscriber, $payload);
        }
    }

    private function resolveFileName(?string $originalName, ?string $path): string
    {
        if (!empty($originalName)) {
            return $originalName;
        }

        if (!$path) {
            return '-';
        }

        return basename($path);
    }

    private function normalizePublishDate($publishAt): Carbon
    {
        if ($publishAt instanceof Carbon) {
            return $publishAt;
        }

        if ($publishAt) {
            return Carbon::parse($publishAt);
        }

        return now();
    }

    private function shouldSendImmediately(): bool
    {
        return config('mail.report_send_mode', 'queue') === 'direct';
    }
}
