<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\MenuNavigation;
use App\Models\CompanyStatistic;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Article;
use App\Models\CompanyProfile;
use App\Models\CompanyAbout;
use App\Models\TrackRecord;
use App\Models\OrganizationStructure;
use App\Models\OurManagement;
use App\Models\Career;
use App\Models\CareerApplicant;
use App\Models\ExperiencedApplicant;
use App\Models\Contact;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\SafetyManagement;
use App\Models\CorporateSocial;
use App\Models\Initiative;
use App\Models\DocumentReport;
use App\Models\LogDownloadReport;
use App\Models\AnnualReport;
use App\Models\FinancialReport;
use App\Models\FinancialStatement;
use App\Models\InvestorReport;
use App\Models\InvestorPresentation;
use App\Models\StockReport;
use App\Models\StockInformation;
use App\Models\ShareholderReport;
use App\Models\Shareholder;
use App\Models\CoverageArea;
use App\Jobs\TicketingJob;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\StoreCareerApplicantRequest;
use App\Http\Requests\StoreExperiencedApplicantRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    /**
     * Get banner by menu navigation name
     */
    private function getBannerByMenuName($menuName)
    {
        $menu = MenuNavigation::where('name', $menuName)->first();
        if ($menu) {
            return HeroSection::where('menu_navigation_id', $menu->id)->get();
        }
        
        // Fallback to latest banner if menu not found
        return HeroSection::orderByDesc('id')->take(1)->get();
    }

    /**
     * Make sure viewer counters behave consistently across content types.
     */
    private function incrementViewerCount(Model $record): void
    {
        if (is_null($record->getAttribute('viewer'))) {
            $record->forceFill(['viewer' => 0])->saveQuietly();
        }

        $record->increment('viewer');
    }

    public function index() {
        $banners = $this->getBannerByMenuName('Beranda');
        $statistics = CompanyStatistic::take(4)->get();
        $products = Product::orderByDesc('id')->take(1)->get();
        $services = Service::orderByDesc('id')->take(1)->get();
        $testimonials = Testimonial::take(5)->get();
        $articles = Article::where('status', 'Published')->orderBy('id')->get();
        $coverageAreas = CoverageArea::whereNotNull('latitude')
                                    ->whereNotNull('longitude')
                                    ->whereNotNull('partner_name')
                                    ->get();
        return view('front.index', compact('banners', 'statistics', 'products', 'services', 'testimonials', 'articles', 'coverageAreas'));
    }

    public function article() {
        $banners = $this->getBannerByMenuName('Artikel');
        $articles = Article::where('status', 'Published')->orderBy('id')->get();
        return view('front.article', compact('banners', 'articles'));
    }

    public function articleDetail($id) {
        $article = Article::with('tags')->findOrFail($id);
        
        // Increment viewer count
        $this->incrementViewerCount($article);

        // Get recent articles (excluding current article)
        $recentArticles = Article::where('status', 'Published')
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('front.article-detail', compact('article', 'recentArticles'));
    }

    public function about() {
        $banners = $this->getBannerByMenuName('Tentang Kami');
        $profiles = CompanyProfile::orderByDesc('id')->take(1)->get();
        $visions = CompanyAbout::where('type', 'visions')->orderBy('id')->take(1)->get();
        $missions = CompanyAbout::where('type', 'missions')->orderBy('id')->take(1)->get();
        $histories = TrackRecord::orderBy('track_record_at', 'asc')->take(5)->get();
        $organizations = OrganizationStructure::orderByDesc('id')->take(1)->get();
        $managements = OurManagement::orderBy('id')->take(10)->get();
        $coverageAreas = CoverageArea::whereNotNull('latitude')
                                    ->whereNotNull('longitude')
                                    ->whereNotNull('partner_name')
                                    ->get();
        return view('front.about', compact('banners', 'profiles', 'visions', 'missions', 'histories', 'organizations', 'managements', 'coverageAreas'));
    }

    public function business() {
        $banners = $this->getBannerByMenuName('Bisnis Kami');
        $products = Product::orderByDesc('id')->take(1)->get();
        $services = Service::orderByDesc('id')->take(1)->get();
        $testimonials = Testimonial::take(5)->get();
        return view('front.business', compact('banners', 'products', 'services', 'testimonials'));
    }

    public function search(Request $request) {
        $query = trim((string) $request->input('q', ''));
        $query = mb_substr($query, 0, 120);

        $hasSearched = $query !== '';
        $results = collect();
        $totalCount = 0;

        if ($hasSearched) {
            $results = $this->buildSearchSections($query);
            $totalCount = $results->sum(function ($section) {
                return $section['items']->count();
            });
        }

        $quickSearchTerms = config('papandayan.search.quick_terms', []);

        return view('front.search', [
            'query' => $query,
            'quickSearchTerms' => $quickSearchTerms,
            'results' => $results,
            'totalCount' => $totalCount,
            'hasSearched' => $hasSearched,
        ]);
    }

    public function career() {
        $banners = $this->getBannerByMenuName('Karier');
        // Update status careers before displaying
        $this->updateStatusCareers();
        
        $careers = Career::where('status', 'Published')
                        ->where('closing_at', '>=', now()->startOfDay())
                        ->orderByDesc('id')
                        ->take(5)
                        ->get();
        return view('front.career', compact('banners', 'careers'));
    }

    public function careerDetail($id) {
        $this->updateStatusCareers();

        $career = Career::findOrFail($id);

        $recentCareers = Career::where('status', 'Published')
            ->where('closing_at', '>=', now()->startOfDay())
            ->where('id', '!=', $career->id)
            ->orderByDesc('posting_at')
            ->limit(5)
            ->get();

        return view('front.career-detail', compact('career', 'recentCareers'));
    }

    public function careerForm($id) {
        $career = Career::findOrFail($id);
        return view('front.career-form', compact('career'));
    }

    public function safety() {
        $banners = $this->getBannerByMenuName('K3');
        $safeties = SafetyManagement::orderByDesc('id')->first();
        return view('front.safety', compact('banners', 'safeties'));
    }

    public function social() {
        $banners = $this->getBannerByMenuName('CSR');
        $socials = CorporateSocial::where('status', 'Published')->orderBy('id')->get();
        return view('front.social', compact('banners', 'socials'));
    }

    public function socialDetail($id) {
        $social = CorporateSocial::findOrFail($id);
        
        // Increment viewer count
        $this->incrementViewerCount($social);
        
        // Get recent socials (excluding current social)
        $recentSocials = CorporateSocial::where('status', 'Published')
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('front.social-detail', compact('social', 'recentSocials'));
    }

    public function initiative() {
        $banners = $this->getBannerByMenuName('Inisiatif');
        $initiatives = Initiative::where('status', 'Published')->orderBy('id')->get();
        return view('front.initiative', compact('banners', 'initiatives'));
    }

    public function initiativeDetail($id) {
        $initiative = Initiative::findOrFail($id);
        
        // Increment viewer count
        $this->incrementViewerCount($initiative);
        
        // Get recent initiatives (excluding current initiative)
        $recentInitiatives = Initiative::where('status', 'Published')
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('front.initiative-detail', compact('initiative', 'recentInitiatives'));
    }

    public function document() {
        $banners = $this->getBannerByMenuName('Laporan Dokumen');
        $documents = DocumentReport::where('status', 'Published')->orderByDesc('id')->get();
        return view('front.document', compact('banners', 'documents'));
    }

    public function documentDownload($id) {
        $document = DocumentReport::findOrFail($id);
        
        // Return the file for download
        $filePath = storage_path('app/public/' . $document->report);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $document->name . '.' . pathinfo($document->report, PATHINFO_EXTENSION));
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function documentDownloadWithLog(Request $request, $id) {
        // Get real IP address from client (handles proxy/forwarded IPs)
        $clientIp = $this->getClientIpAddress($request);
        
        // Debug incoming request
        \Log::info('documentDownloadWithLog called', [
            'id' => $id,
            'request_data' => $request->all(),
            'ip' => $clientIp
        ]);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $document = DocumentReport::findOrFail($id);
        
        // Create log entry with client IP address
        $logData = [
            'name' => $request->name,
            'email' => $request->email,
            'type_report' => $document->name,
            'ip_address' => $clientIp, // IP dari PC/laptop yang download
            'status' => 'success',
            'downloaded_at' => now(),
            'document_report_id' => $document->id,
        ];
        
        \Log::info('Creating log entry', $logData);
        
        $log = LogDownloadReport::create($logData);
        
        \Log::info('Log entry created', ['log_id' => $log->id, 'client_ip' => $clientIp]);
        
        // Return success response with IP info
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan. File akan segera didownload.',
            'log_id' => $log->id,
            'ip_address' => $clientIp // IP dari PC/laptop yang download
        ]);
    }
    
    public function report() {
        $banners = $this->getBannerByMenuName('Laporan Tahunan');
        $reports = AnnualReport::where('status', 'Published')->orderByDesc('id')->get();
        return view('front.report', compact('banners', 'reports'));
    }

    public function reportDownload($id) {
        $report = AnnualReport::findOrFail($id);

        $filePath = storage_path('app/public/' . $report->report);
        if (file_exists($filePath)) {
            return response()->download($filePath, $report->name . '.' . pathinfo($report->report, PATHINFO_EXTENSION));
        }

        abort(404, 'File tidak ditemukan');
    }

    public function reportDownloadWithLog(Request $request, $id) {
        // Get real IP address from client (handles proxy/forwarded IPs)
        $clientIp = $this->getClientIpAddress($request);
        
        // Debug incoming request
        \Log::info('reportDownloadWithLog called', [
            'id' => $id,
            'request_data' => $request->all(),
            'ip' => $clientIp
        ]);
        
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $report = AnnualReport::findOrFail($id);

        // Create log data
        $logData = [
            'name' => $request->name,
            'email' => $request->email,
            'type_report' => $report->name,
            'ip_address' => $clientIp,
            'status' => 'success',
            'downloaded_at' => now(),
            'annual_report_id' => $report->id,
        ];

        \Log::info('Creating log entry', $logData);
        
        // Save to database
        $log = LogDownloadReport::create($logData);
        
        \Log::info('Log entry created', ['log_id' => $log->id, 'client_ip' => $clientIp]);

        // Return success response dengan IP address
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan. File akan segera didownload.',
            'log_id' => $log->id,
            'ip_address' => $clientIp // IP dari PC/laptop yang download
        ]);
    }

    public function financial() {
        $banners = $this->getBannerByMenuName('Laporan Keuangan');
        $financials = FinancialStatement::where('status', 'Published')->orderByDesc('id')->get();
        return view('front.financial', compact('banners', 'financials'));
    }

    public function financialDownload($id) {
        $financialReport = \App\Models\FinancialReport::findOrFail($id);
        
        // Return the file for download
        $filePath = storage_path('app/public/' . $financialReport->report);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $financialReport->name . '.' . pathinfo($financialReport->report, PATHINFO_EXTENSION));
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function financialDownloadWithLog(Request $request, $id) {
        // Get real IP address from client (handles proxy/forwarded IPs)
        $clientIp = $this->getClientIpAddress($request);
        
        // Debug incoming request
        \Log::info('financialDownloadWithLog called', [
            'id' => $id,
            'request_data' => $request->all(),
            'ip' => $clientIp
        ]);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $financialReport = \App\Models\FinancialReport::findOrFail($id);
        
        // Create log entry with client IP address
        $logData = [
            'name' => $request->name,
            'email' => $request->email,
            'type_report' => $financialReport->name,
            'ip_address' => $clientIp, // IP dari PC/laptop yang download
            'status' => 'success',
            'downloaded_at' => now(),
            'financial_report_id' => $financialReport->id,
        ];
        
        \Log::info('Creating log entry', $logData);
        
        $log = LogDownloadReport::create($logData);
        
        \Log::info('Log entry created', ['log_id' => $log->id, 'client_ip' => $clientIp]);
        
        // Return success response with IP info
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan. File akan segera didownload.',
            'log_id' => $log->id,
            'ip_address' => $clientIp // IP dari PC/laptop yang download
        ]);
    }

    public function investor() {
        $banners = $this->getBannerByMenuName('Presentasi Investor');
        $investors = InvestorPresentation::where('status', 'Published')->orderByDesc('id')->get();
        return view('front.investor', compact('banners', 'investors'));
    }

    public function investorDownload($id) {
        $investorReport = InvestorReport::findOrFail($id);
        
        // Return the file for download
        $filePath = storage_path('app/public/' . $investorReport->report);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $investorReport->name . '.' . pathinfo($investorReport->report, PATHINFO_EXTENSION));
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function investorDownloadWithLog(Request $request, $id) {
        // Get real IP address from client (handles proxy/forwarded IPs)
        $clientIp = $this->getClientIpAddress($request);
        
        // Debug incoming request
        \Log::info('investorDownloadWithLog called', [
            'id' => $id,
            'request_data' => $request->all(),
            'ip' => $clientIp
        ]);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $investorReport = InvestorReport::findOrFail($id);
        
        // Create log entry with client IP address
        $logData = [
            'name' => $request->name,
            'email' => $request->email,
            'type_report' => $investorReport->name,
            'ip_address' => $clientIp, // IP dari PC/laptop yang download
            'status' => 'success',
            'downloaded_at' => now(),
            'investor_report_id' => $investorReport->id,
        ];
        
        \Log::info('Creating log entry', $logData);
        
        $log = LogDownloadReport::create($logData);
        
        \Log::info('Log entry created', ['log_id' => $log->id, 'client_ip' => $clientIp]);
        
        // Return success response with IP info
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan. File akan segera didownload.',
            'log_id' => $log->id,
            'ip_address' => $clientIp // IP dari PC/laptop yang download
        ]);
    }

    public function stock() {
        $banners = $this->getBannerByMenuName('Informasi Saham dan Obligasi');
        $stocks = StockInformation::where('status', 'Published')->orderByDesc('id')->get();
        return view('front.stock', compact('banners', 'stocks'));
    }

    public function stockDownload($id) {
        $stockReport = StockReport::findOrFail($id);
        
        // Return the file for download
        $filePath = storage_path('app/public/' . $stockReport->report);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $stockReport->name . '.' . pathinfo($stockReport->report, PATHINFO_EXTENSION));
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function stockDownloadWithLog(Request $request, $id) {
        // Get real IP address from client (handles proxy/forwarded IPs)
        $clientIp = $this->getClientIpAddress($request);
        
        // Debug incoming request
        \Log::info('stockDownloadWithLog called', [
            'id' => $id,
            'request_data' => $request->all(),
            'ip' => $clientIp
        ]);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $stockReport = StockReport::findOrFail($id);
        
        // Create log entry with client IP address
        $logData = [
            'name' => $request->name,
            'email' => $request->email,
            'type_report' => $stockReport->name,
            'ip_address' => $clientIp, // IP dari PC/laptop yang download
            'status' => 'success',
            'downloaded_at' => now(),
            'stock_report_id' => $stockReport->id,
        ];
        
        \Log::info('Creating log entry', $logData);
        
        $log = LogDownloadReport::create($logData);
        
        \Log::info('Log entry created', ['log_id' => $log->id, 'client_ip' => $clientIp]);
        
        // Return success response with IP info
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan. File akan segera didownload.',
            'log_id' => $log->id,
            'ip_address' => $clientIp // IP dari PC/laptop yang download
        ]);
    }

    public function shareholder() {
        $banners = $this->getBannerByMenuName('Rapat Umum Pemegang Saham');
        $shareholders = Shareholder::where('status', 'Published')->orderByDesc('id')->get();
        return view('front.shareholder', compact('banners', 'shareholders'));
    }

    public function shareholderDownload($id) {
        $shareholderReport = ShareholderReport::findOrFail($id);
        
        // Return the file for download
        $filePath = storage_path('app/public/' . $shareholderReport->report);
        
        if (file_exists($filePath)) {
            return response()->download($filePath, $shareholderReport->name . '.' . pathinfo($shareholderReport->report, PATHINFO_EXTENSION));
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function shareholderDownloadWithLog(Request $request, $id) {
        // Get real IP address from client (handles proxy/forwarded IPs)
        $clientIp = $this->getClientIpAddress($request);
        
        // Debug incoming request
        \Log::info('shareholderDownloadWithLog called', [
            'id' => $id,
            'request_data' => $request->all(),
            'ip' => $clientIp
        ]);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $shareholderReport = ShareholderReport::findOrFail($id);
        
        // Create log entry with client IP address
        $logData = [
            'name' => $request->name,
            'email' => $request->email,
            'type_report' => $shareholderReport->name,
            'ip_address' => $clientIp, // IP dari PC/laptop yang download
            'status' => 'success',
            'downloaded_at' => now(),
            'shareholder_report_id' => $shareholderReport->id,
        ];
        
        \Log::info('Creating log entry', $logData);
        
        $log = LogDownloadReport::create($logData);
        
        \Log::info('Log entry created', ['log_id' => $log->id, 'client_ip' => $clientIp]);
        
        // Return success response with IP info
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan. File akan segera didownload.',
            'log_id' => $log->id,
            'ip_address' => $clientIp // IP dari PC/laptop yang download
        ]);
    }

    public function careerStore(StoreCareerApplicantRequest $request) {

        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            // Set default status if not provided
            // $validated['status'] = $validated['status'] ?? 'New';

            if ($request->hasFile('curriculum_vitae')) {
                $curriculumVitaePath = $request->file('curriculum_vitae')->store('applicants', 'public');
                $validated['curriculum_vitae'] = $curriculumVitaePath;
            }

            $experiencedApplicant = null;
            if ($validated['experienced'] === 'Yes') {
                $experiencedData = [
                    'company_name' => $validated['company_name'],
                    'industry' => $validated['industry'],
                    'position' => $validated['position'],
                    'duration' => $validated['duration'],
                ];
                
                $experiencedApplicant = ExperiencedApplicant::create($experiencedData);
                $validated['experienced_id'] = $experiencedApplicant->id;
            }
            
            unset($validated['company_name'], $validated['industry'], $validated['position'], $validated['duration']);
            $newDataRecord = CareerApplicant::create($validated);
        });

        return redirect()->route('front.career')->with('success', 'Your application has been submitted successfully.');
    }

    public function contact() {
        $banners = $this->getBannerByMenuName('Hubungi Kami');
        $contacts = Contact::take(3)->get();
        $types = QuestionType::all();
        return view('front.contact', compact('banners', 'contacts', 'types'));
    }

    public function questionStore(StoreQuestionRequest $request) {
        
        $newDataRecord = null;

        // Closure-based transaction
        DB::transaction(function () use ($request, &$newDataRecord) {
            $validated = $request->validated();
            
            // Set default status if not provided
            $validated['status'] = $validated['status'] ?? 'Open';

            $newDataRecord = Question::create($validated);
        });

        if ($newDataRecord) {
            TicketingJob::dispatch($newDataRecord->id)->afterCommit();
        }

        return redirect()->route('front.contact')->with('success', 'Your question has been submitted successfully.');
    }

    private function buildSearchSections(string $query)
    {
        $limit = (int) config('papandayan.search.per_section_limit', 5);
        $pattern = '%' . $query . '%';

        $sections = collect();

        $pageMatches = $this->buildPageMatches($query);
        if ($pageMatches->isNotEmpty()) {
            $sections->push([
                'key' => 'pages',
                'label' => 'Halaman Terkait',
                'items' => $pageMatches,
            ]);
        }

        $articles = Article::where('status', 'Published')
            ->where(function ($builder) use ($pattern) {
                $builder->where('title', 'like', $pattern)
                    ->orWhere('subtitle', 'like', $pattern)
                    ->orWhere('about', 'like', $pattern);
            })
            ->orderByDesc('publish_at')
            ->limit($limit)
            ->get()
            ->map(function ($article) {
                return [
                    'title' => $article->title,
                    'excerpt' => Str::limit(strip_tags($article->subtitle ?? $article->about ?? ''), 150),
                    'url' => route('front.article-detail', $article->id),
                    'badge' => 'Artikel',
                    'meta' => $article->publish_at ? $article->publish_at->format('d M Y') : null,
                ];
            });
        if ($articles->isNotEmpty()) {
            $sections->push([
                'key' => 'articles',
                'label' => 'Artikel',
                'items' => $articles,
            ]);
        }

        $csrItems = CorporateSocial::where('status', 'Published')
            ->where(function ($builder) use ($pattern) {
                $builder->where('title', 'like', $pattern)
                    ->orWhere('subtitle', 'like', $pattern)
                    ->orWhere('about', 'like', $pattern);
            })
            ->orderByDesc('publish_at')
            ->limit($limit)
            ->get()
            ->map(function ($social) {
                return [
                    'title' => $social->title,
                    'excerpt' => Str::limit(strip_tags($social->subtitle ?? $social->about ?? ''), 150),
                    'url' => route('front.social-detail', $social->id),
                    'badge' => 'CSR',
                    'meta' => $social->publish_at ? $social->publish_at->format('d M Y') : null,
                ];
            });
        if ($csrItems->isNotEmpty()) {
            $sections->push([
                'key' => 'csr',
                'label' => 'Kegiatan CSR',
                'items' => $csrItems,
            ]);
        }

        $initiatives = Initiative::where('status', 'Published')
            ->where(function ($builder) use ($pattern) {
                $builder->where('title', 'like', $pattern)
                    ->orWhere('subtitle', 'like', $pattern)
                    ->orWhere('about', 'like', $pattern);
            })
            ->orderByDesc('publish_at')
            ->limit($limit)
            ->get()
            ->map(function ($initiative) {
                return [
                    'title' => $initiative->title,
                    'excerpt' => Str::limit(strip_tags($initiative->subtitle ?? $initiative->about ?? ''), 150),
                    'url' => route('front.initiative-detail', $initiative->id),
                    'badge' => 'Inisiatif',
                    'meta' => $initiative->publish_at ? $initiative->publish_at->format('d M Y') : null,
                ];
            });
        if ($initiatives->isNotEmpty()) {
            $sections->push([
                'key' => 'initiatives',
                'label' => 'Inisiatif',
                'items' => $initiatives,
            ]);
        }

        $safetyItems = SafetyManagement::where(function ($builder) use ($pattern) {
                $builder->where('title', 'like', $pattern)
                    ->orWhere('about', 'like', $pattern);
            })
            ->limit($limit)
            ->get()
            ->map(function ($safety) {
                return [
                    'title' => $safety->title,
                    'excerpt' => Str::limit(strip_tags($safety->about ?? ''), 150),
                    'url' => route('front.safety'),
                    'badge' => 'K3',
                    'meta' => 'Halaman K3',
                ];
            });
        if ($safetyItems->isNotEmpty()) {
            $sections->push([
                'key' => 'safety',
                'label' => 'Program K3',
                'items' => $safetyItems,
            ]);
        }

        $documents = DocumentReport::where('name', 'like', $pattern)
            ->orderByDesc('id')
            ->limit($limit)
            ->get()
            ->map(function ($document) {
                return [
                    'title' => $document->name,
                    'excerpt' => 'Dokumen perusahaan yang siap diunduh.',
                    'url' => route('front.documents') . '#document-' . $document->id,
                    'badge' => 'Dokumen',
                    'meta' => 'Memerlukan formulir unduhan',
                ];
            });
        if ($documents->isNotEmpty()) {
            $sections->push([
                'key' => 'documents',
                'label' => 'Laporan Dokumen',
                'items' => $documents,
            ]);
        }

        return $sections;
    }

    private function buildPageMatches(string $query)
    {
        $matches = collect();
        $quickTerms = config('papandayan.search.quick_terms', []);

        foreach ($quickTerms as $term) {
            if (empty($term['route'])) {
                continue;
            }

            $keywords = $term['keywords'] ?? [$term['label']];
            if ($this->queryMatchesKeywords($query, $keywords)) {
                $matches->push([
                    'title' => $term['label'],
                    'excerpt' => $term['description'] ?? '',
                    'url' => route($term['route']),
                    'badge' => 'Halaman',
                    'meta' => 'Akses cepat',
                ]);
            }
        }

        return $matches;
    }

    private function queryMatchesKeywords(string $query, array $keywords): bool
    {
        $normalizedQuery = Str::lower($query);

        foreach ($keywords as $keyword) {
            $normalizedKeyword = Str::lower((string) $keyword);
            if ($normalizedKeyword !== '' && Str::contains($normalizedQuery, $normalizedKeyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get client IP address (handles proxy and forwarded IPs)
     * Returns IP address from PC/laptop that makes the request
     */
    private function getClientIpAddress(Request $request)
    {
        // Check for various proxy headers first
        $ipHeaders = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($ipHeaders as $header) {
            if ($request->server($header)) {
                $ip = $request->server($header);
                
                // X-Forwarded-For can contain multiple IPs
                if (strpos($ip, ',') !== false) {
                    $ips = explode(',', $ip);
                    $ip = trim($ips[0]); // First IP is the original client
                }
                
                // Validate IP address
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        // Fallback to Laravel's built-in method
        return $request->ip();
    }

    /**
     * Update careers status based on current date
     */
    private function updateStatusCareers()
    {
        $today = now()->startOfDay();
        
        // Change status from 'Private' to 'Published' if current date is between posting_at and closing_at
        Career::where('status', 'Private')
              ->whereDate('posting_at', '<=', $today)
              ->whereDate('closing_at', '>=', $today)
              ->update(['status' => 'Published']);
        
        // Change status from 'Published' to 'Private' if closing date has passed
        Career::where('status', 'Published')
              ->whereDate('closing_at', '<', $today)
              ->update(['status' => 'Private']);
    }
}
