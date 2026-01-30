<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
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
use App\Models\FinancialStatement;
use App\Models\InvestorPresentation;
use App\Models\StockInformation;
use App\Models\Shareholder;
use App\Jobs\TicketingJob;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\StoreCareerApplicantRequest;
use App\Http\Requests\StoreExperiencedApplicantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index() {
        $banners = HeroSection::orderByDesc('id')->take(1)->get();
        $statistics = CompanyStatistic::take(4)->get();
        $products = Product::orderByDesc('id')->take(1)->get();
        $services = Service::orderByDesc('id')->take(1)->get();
        $testimonials = Testimonial::take(5)->get();
        $articles = Article::orderByDesc('id')->take(3)->get();
        return view('front.index', compact('banners', 'statistics', 'products', 'services', 'testimonials', 'articles'));
    }

    public function article() {
        $articles = Article::orderByDesc('id')->take(3)->get();
        return view('front.article', compact('articles'));
    }

    public function articleDetail($id) {
        $article = Article::findOrFail($id);
        return view('front.article-detail', compact('article'));
    }

    public function about() {
        $profiles = CompanyProfile::orderByDesc('id')->take(1)->get();
        $abouts = CompanyAbout::orderByRaw("CASE WHEN type = 'Visions' THEN 0 ELSE 1 END")->orderByDesc('id')->get();
        $histories = TrackRecord::orderBy('track_record_at', 'asc')->take(5)->get();
        $organizations = OrganizationStructure::orderByDesc('id')->take(1)->get();
        $managements = OurManagement::orderBy('id')->take(10)->get();
        return view('front.about', compact('profiles', 'abouts', 'histories', 'organizations', 'managements'));
    }

    public function business() {
        $products = Product::orderByDesc('id')->take(1)->get();
        $services = Service::orderByDesc('id')->take(1)->get();
        $testimonials = Testimonial::take(5)->get();
        return view('front.business', compact('products', 'services', 'testimonials'));
    }

    public function career() {
        $careers = Career::orderByDesc('id')->take(5)->get();
        return view('front.career', compact('careers'));
    }

    public function careerDetail($id) {
        $career = Career::findOrFail($id);
        return view('front.career-detail', compact('career'));
    }

    public function careerForm($id) {
        $career = Career::findOrFail($id);
        return view('front.career-form', compact('career'));
    }

    public function safety() {
        $safeties = SafetyManagement::orderByDesc('id')->take(1)->get();
        return view('front.safety', compact('safeties'));
    }

    public function social() {
        $socials = CorporateSocial::orderByDesc('id')->take(1)->get();
        return view('front.social', compact('socials'));
    }

    public function socialDetail($id) {
        $social = CorporateSocial::findOrFail($id);
        return view('front.social-detail', compact('social'));
    }

    public function initiative() {
        $initiatives = Initiative::orderByDesc('id')->take(1)->get();
        return view('front.initiative', compact('initiatives'));
    }

    public function initiativeDetail($id) {
        $initiative = Initiative::findOrFail($id);
        return view('front.initiative-detail', compact('initiative'));
    }

    public function document() {
        $documents = DocumentReport::orderByDesc('id')->take(5)->get();
        return view('front.document', compact('documents'));
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
        $reports = AnnualReport::orderByDesc('id')->take(5)->get();
        return view('front.report', compact('reports'));
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
        $financials = FinancialStatement::orderByDesc('id')->take(5)->get();
        return view('front.financial', compact('financials'));
    }

    public function investor() {
        $investors = InvestorPresentation::orderByDesc('id')->take(5)->get();
        return view('front.investor', compact('investors'));
    }

    public function stock() {
        $stocks = StockInformation::orderByDesc('id')->take(5)->get();
        return view('front.stock', compact('stocks'));
    }

    public function shareholder() {
        $shareholders = Shareholder::orderByDesc('id')->take(5)->get();
        return view('front.shareholder', compact('shareholders'));
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
        $contacts = Contact::take(3)->get();
        $types = QuestionType::all();
        return view('front.contact', compact('contacts', 'types'));
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
}
