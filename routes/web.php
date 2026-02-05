<?php

use App\Http\Controllers\Account\PasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyStatisticController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\OurManagementController;
use App\Http\Controllers\CompanyAboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\TrackRecordController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CareerApplicantController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CoverageAreaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CorporateSocialController;
use App\Http\Controllers\InitiativeController;
use App\Http\Controllers\SafetyManagementController;
use App\Http\Controllers\DocumentReportController;
use App\Http\Controllers\AnnualReportController;
use App\Http\Controllers\FinancialStatementController;
use App\Http\Controllers\InvestorPresentationController;
use App\Http\Controllers\StockInformationController;
use App\Http\Controllers\ShareholderController;
use App\Http\Controllers\MenuNavigationController;
use App\Http\Controllers\MenuGroupController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\EmailConfigController;
use App\Http\Controllers\LogEmailSenderController;
use App\Http\Controllers\LogDownloadReportController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/articles', [FrontController::class, 'article'])->name('front.articles');
Route::get('/article/{id}', [FrontController::class, 'articleDetail'])->name('front.article-detail');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/business', [FrontController::class, 'business'])->name('front.business');;
Route::get('/career', [FrontController::class, 'career'])->name('front.career');
Route::get('/career/form/{id}', [FrontController::class, 'careerForm'])->name('front.career-form');
Route::post('/career/store', [FrontController::class, 'careerStore'])->name('front.career.store');
Route::get('/career/{id}', [FrontController::class, 'careerDetail'])->name('front.career-detail');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::post('/contact/store', [FrontController::class, 'questionStore'])->name('question.store');
Route::get('/safety', [FrontController::class, 'safety'])->name('front.safety');
Route::get('/socials', [FrontController::class, 'social'])->name('front.socials');
Route::get('/social/{id}', [FrontController::class, 'socialDetail'])->name('front.social-detail');
Route::get('/initiatives', [FrontController::class, 'initiative'])->name('front.initiatives');
Route::get('/initiative/{id}', [FrontController::class, 'initiativeDetail'])->name('front.initiative-detail');
Route::post('/like', [FrontController::class, 'toggleLike'])->name('front.like.toggle');
Route::get('/documents', [FrontController::class, 'document'])->name('front.documents');
Route::get('/document/download/{id}', [FrontController::class, 'documentDownload'])->name('front.document.download');
Route::post('/document/download-with-log/{id}', [FrontController::class, 'documentDownloadWithLog'])->name('front.document.download.with.log');
Route::get('/report', [FrontController::class, 'report'])->name('front.report');
Route::get('/report/download/{id}', [FrontController::class, 'reportDownload'])->name('front.report.download');
Route::post('/report/download-with-log/{id}', [FrontController::class, 'reportDownloadWithLog'])->name('front.report.download.with.log');
Route::get('/financial', [FrontController::class, 'financial'])->name('front.financial');
Route::get('/financial/download/{id}', [FrontController::class, 'financialDownload'])->name('front.financial.download');
Route::post('/financial/download-with-log/{id}', [FrontController::class, 'financialDownloadWithLog'])->name('front.financial.download.with.log');
Route::get('/investor', [FrontController::class, 'investor'])->name('front.investor');
Route::get('/investor/download/{id}', [FrontController::class, 'investorDownload'])->name('front.investor.download');
Route::post('/investor/download-with-log/{id}', [FrontController::class, 'investorDownloadWithLog'])->name('front.investor.download.with.log');
Route::get('/stock', [FrontController::class, 'stock'])->name('front.stock');
Route::get('/stock/download/{id}', [FrontController::class, 'stockDownload'])->name('front.stock.download');
Route::post('/stock/download-with-log/{id}', [FrontController::class, 'stockDownloadWithLog'])->name('front.stock.download.with.log');
Route::get('/shareholder', [FrontController::class, 'shareholder'])->name('front.shareholder');
Route::get('/shareholder/download/{id}', [FrontController::class, 'shareholderDownload'])->name('front.shareholder.download');
Route::post('/shareholder/download-with-log/{id}', [FrontController::class, 'shareholderDownloadWithLog'])->name('front.shareholder.download.with.log');

Route::get('/home', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/account/password', [PasswordController::class, 'edit'])->name('account.password.edit');
    Route::put('/account/password', [PasswordController::class, 'update'])->name('account.password.update');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::middleware('can:manage company statistics')->group(function () {
            Route::resource('statistics', CompanyStatisticController::class);
        });

        Route::middleware('can:manage testimonials')->group(function () {
            Route::resource('testimonials', TestimonialController::class);
        });

        Route::middleware('can:manage our managements')->group(function () {
            Route::resource('managements', OurManagementController::class);
        });

        Route::middleware('can:manage company abouts')->group(function () {
            Route::resource('abouts', CompanyAboutController::class);
        });

        Route::middleware('can:manage articles')->group(function () {
            Route::resource('articles', ArticleController::class);
        });

        Route::middleware('can:manage hero sections')->group(function () {
            Route::resource('banners', HeroSectionController::class);
        });

        Route::middleware('can:manage track records')->group(function () {
            Route::resource('histories', TrackRecordController::class);
        });

        Route::middleware('can:manage company profiles')->group(function () {
            Route::resource('profiles', CompanyProfileController::class);
        });

        Route::middleware('can:manage organization structures')->group(function () {
            Route::resource('organizations', OrganizationStructureController::class);
        });

        Route::middleware('can:manage questions')->group(function () {
            Route::resource('questions', QuestionController::class);
        });

        Route::middleware('can:manage question types')->group(function () {
            Route::resource('types', QuestionTypeController::class);
        });

        Route::middleware('can:manage services')->group(function () {
            Route::resource('services', ServiceController::class);
        });

        Route::middleware('can:manage careers')->group(function () {
            Route::resource('careers', CareerController::class);
        });

        Route::middleware('can:manage careers applicants')->group(function () {
            Route::resource('applicants', CareerApplicantController::class);
            Route::get('applicants/career/{career}', [CareerApplicantController::class, 'getCareerApplicants'])->name('applicants.career');
            Route::get('applicants/export/career/{career}', [CareerApplicantController::class, 'exportCareerApplicants'])->name('applicants.export.career');
        });

        Route::middleware('can:manage contacts')->group(function () {
            Route::resource('contacts', ContactController::class);
        });

        Route::middleware('can:manage products')->group(function () {
            Route::resource('products', ProductController::class);
        });

        Route::middleware('can:manage coverage areas')->group(function () {
            Route::resource('areas', CoverageAreaController::class);
        });

        Route::middleware('can:manage galleries')->group(function () {
            Route::resource('galleries', GalleryController::class);
        });

        Route::middleware('can:manage corporate socials')->group(function () {
            Route::resource('socials', CorporateSocialController::class);
        });

        Route::middleware('can:manage initiatives')->group(function () {
            Route::resource('initiatives', InitiativeController::class);
        });

        Route::middleware('can:manage safety managements')->group(function () {
            Route::resource('safeties', SafetyManagementController::class);
        });

        Route::middleware('can:manage document reports')->group(function () {
            Route::resource('documents', DocumentReportController::class);
        });

        Route::middleware('can:manage annual reports')->group(function () {
            Route::resource('reports', AnnualReportController::class);
        });

        Route::middleware('can:manage financial statements')->group(function () {
            Route::resource('financials', FinancialStatementController::class);
        });

        Route::middleware('can:manage investor presentations')->group(function () {
            Route::resource('investors', InvestorPresentationController::class);
        });

        Route::middleware('can:manage stock information')->group(function () {
            Route::resource('stocks', StockInformationController::class);
        });

        Route::middleware('can:manage shareholders')->group(function () {
            Route::resource('shareholders', ShareholderController::class);
        });

        Route::middleware('can:manage menu navigations')->group(function () {
            Route::resource('navigations', MenuNavigationController::class);
        });

        Route::middleware('can:manage menu groups')->group(function () {
            Route::resource('groups', MenuGroupController::class);
        });

         Route::middleware('can:manage tickets')->group(function () {
            Route::resource('tickets', TicketController::class);
        });

        Route::middleware('can:manage email logs')->group(function () {
            Route::resource('email-logs', LogEmailSenderController::class)->only(['index', 'show']);
        });

        Route::middleware('can:manage email configs')->group(function () {
            Route::resource('email-configs', EmailConfigController::class);
        });

        Route::middleware('can:manage download logs')->group(function () {
            Route::resource('download-logs', LogDownloadReportController::class);
        });

    });
    
});

Auth::routes();
