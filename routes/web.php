<?php

use App\Http\Controllers\CarInfoController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\GeoLocationApi;
use App\Http\Controllers\Moderator\DashboardController as ModeratorDashboardController;
use App\Http\Controllers\Moderator\ModeratorController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Models\CompanyQuoteCustomization;
use App\Models\Quote;
use  \Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {


      return redirect()->route('user.home');
});

Auth::routes();
Route::get('/email-verify/{id}', [UserController::class, 'verify'])->name('email.verify');
Route::get('/quote-accept/{id}', [QuoteController::class, 'accept'])->name('quote.accept');
Route::get('/quote-decline/{id}', [QuoteController::class, 'decline'])->name('quote.decline');
Route::get('/quote-mail-status', [QuoteController::class, 'mailStatus'])->name('quote.mail.status');
Route::get('/job-mail-status', [QuoteController::class, 'jobStatus'])->name('quote.job.status');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function () {
      Route::middleware(['guest:web,businessUser', 'preventBackHistory'])->group(function () {
            Route::view('/login', 'user.login')->name('login');
            Route::view('/register', 'user.register')->name('register');
            Route::post('/create', [UserController::class, 'create'])->name('create');
            Route::post('/check', [UserController::class, 'check'])->name('check');
            Route::get('/password/forgot', [UserController::class, 'forgotForm'])->name('forgot.form');
            Route::post('/password/forgot', [UserController::class, 'resetLink'])->name('forgot.link');
            route::get('password/reset/{token}', [UserController::class, 'resetForm'])->name('reset.password.form');
            route::post('/password/reset', [UserController::class, 'resetPassword'])->name('reset.password');
      });
      Route::middleware(['auth:web,businessUser'])->group(function () {
            // Route::view('/home','user.pages.dashboard')->name('home');
            Route::get('/home', [DashboardController::class, 'dashboard'])->name('home');
            Route::view('/enquiry/engine', 'user.pages.enquiry.engine')->name('enquiry.engine');
            Route::view('/enquiry/gearbox', 'user.pages.enquiry.gearbox')->name('enquiry.gearbox');
            Route::view('/enquiry/anchillary', 'user.pages.enquiry.anchillary')->name('enquiry.anchillary');
            Route::view('/quotes', 'user.pages.quotes')->name('quotes');
            Route::view('/employee', 'user.pages.employee')->name('employee');
            Route::view('/job', 'user.pages.job')->name('job');
            Route::view('/invoices', 'user.pages.invoice')->name('invoice');
            Route::view('/hidden/engine', 'user.pages.hidden.engine')->name('hidden.engine');
            Route::view('/hidden/gearbox', 'user.pages.hidden.gearbox')->name('hidden.gearbox');
            Route::view('/hidden/anchillary', 'user.pages.hidden.anchillary')->name('hidden.anchillary');
            Route::post('/create-employee', [UserController::class, 'create_employee'])->name('createEmployee');
            Route::put('/update-employee', [UserController::class, 'update_employee'])->name('updateEmployee');
            Route::get('/delete-employee/{id}', [UserController::class, 'delete_employee'])->name('deleteEmployee');
            Route::get('/test-pdf', [QuoteController::class, 'sent'])->name('sent');
            Route::get('/geoLocationCoordinate', [GeoLocationApi::class, 'coordinate'])->name('coordinate');
            Route::get('/geoLocationDistance', [GeoLocationApi::class, 'distance'])->name('distance');
            // Route::get('/pdf-test', function () {
            //       $pdf = Pdf::loadView('user.pdf.test');
            //       return $pdf->download();
            // });

            Route::controller(StripePaymentController::class)->group(function () {
                  Route::get('/stripe', 'stripe')->name('stripe.get');
                  Route::post('/stripe', 'stripePost')->name('stripe.post');
            });








            //ajax req//
            Route::get('/user-enquiry', [EnquiryController::class, 'userEnquiry'])->name('userEnquiry');
            Route::get('/single-enquiry', [EnquiryController::class, 'singleEnquiry'])->name('singleEnquiry');
            Route::get('/single-enquiry_with_all_info', [EnquiryController::class, 'singleEnquiryWithAllInfo'])->name('singleEnquiryWithAllInfo');
            Route::get('/invoice-details', [EnquiryController::class, 'invoiceDetails'])->name('invoiceDetails');



            Route::get('/enquiry-info-for-issue', [EnquiryController::class, 'enquiryInfoForIssue'])->name('enquiryInfoForIssue');
            Route::get('/all-job-status', [QuoteController::class, 'allJobStatus'])->name('job.allStatus');
            Route::get('/get-quote-price', [QuoteController::class, 'priceQuote'])->name('priceQuote');
            Route::get('/print', [QuoteController::class, 'print'])->name('print');
            Route::post('/quote-post', [QuoteController::class, 'quotePost'])->name('quotePost');
            Route::post('/quote-post-custom', [QuoteController::class, 'quotePostCustom'])->name('quotePostCustom');
            Route::post('/quote-recreate', [QuoteController::class, 'quoteRecreate'])->name('quoteRecreate');
            Route::post('/updateQuoteWithEmail', [QuoteController::class, 'quoteUpdate'])->name('quoteUpdate');
            Route::get('/user-quotes', [QuoteController::class, 'userQuotes'])->name('userQuotes');
            Route::get('/user-jobs', [QuoteController::class, 'userJobs'])->name('userJobs');
            Route::get('/user-invoices', [QuoteController::class, 'userInvoices'])->name('userInvoices');

            Route::get('/user-hidden', [QuoteController::class, 'userHidden'])->name('userHidden');
            Route::get('/single-quote', [QuoteController::class, 'singleQuote'])->name('singleQuote');
            Route::post('/job-status-change', [QuoteController::class, 'statusChange'])->name('job.statusChange');
            Route::get('/bar-chart-data', [DashboardController::class, 'barChart'])->name('barChart');
            // Route::get('/bar-chart-data',[DashboardController::class,'barChart'])->name('barChart');
            Route::get('/delete-enquery', [EnquiryController::class, 'delete_enquery'])->name('deleteEnquery');
            Route::get('/delete-quote', [QuoteController::class, 'delete_quote'])->name('deleteQuote');
            Route::get('/hide-quote', [QuoteController::class, 'hide_quote'])->name('hideQuote');
            Route::get('/recovery-info', [EnquiryController::class, 'recoveryInfo'])->name('recoveryInfo');
            Route::post('/sample-quote', [QuoteController::class, 'create_sample_quote'])->name('sampleQuote');
            Route::get('/view-quote', [QuoteController::class, 'viewQuote'])->name('viewQuote');
            Route::post('/note', [NoteController::class, 'create_note'])->name('create.note');
            Route::get('/get-notes', [NoteController::class, 'get_notes'])->name('get.notes');
            Route::post('/job-invoice', [QuoteController::class, 'job_invoice'])->name('job.invoice');
            Route::get('/download-invoice', [QuoteController::class, 'downloadInvoice'])->name('invoice.download');
            Route::post('/send-invoice-from-invoice', [QuoteController::class, 'sendInvoiceFromInvoice'])->name('invoice.send');









            //ajax req//


            Route::prefix('account')->name('account.')->group(function () {

                  // Route::view('/profile', 'user.pages.profile')->name('profile');
                  Route::get('/profile', [UserController::class, 'profilePage'])->name('profile');
                  Route::post('/quote-customization', [UserController::class, 'quote_customization'])->name('quoteCustomization');
                  Route::post('/social-link', [UserController::class, 'add_social_link'])->name('addSocialLink');
                  Route::post('/update-profile', [UserController::class, 'update_profile'])->name('update');
            });


            Route::post('/logout', [UserController::class, 'logout'])->name('logout');
            // Route::view('/pdf','user.pdf');
            Route::get('/pdf', [QuoteController::class, 'sent']);
            // Route::view('/pdf-blade', 'user.test');
      });
});

Route::prefix('superAdmin')->name('superAdmin.')->group(function () {
      Route::middleware(['guest:superAdmin', 'preventBackHistory'])->group(function () {
            Route::view('/login', 'superAdmin.login')->name('login');
            Route::view('/register', 'superAdmin.register')->name('register');
            Route::post('/create', [SuperAdminController::class, 'create'])->name('create');
            Route::post('/check', [SuperAdminController::class, 'check'])->name('check');
            Route::get('/password/forgot', [SuperAdminController::class, 'forgotForm'])->name('forgot.form');
            Route::post('/password/forgot', [SuperAdminController::class, 'resetLink'])->name('forgot.link');
            route::get('password/reset/{token}', [SuperAdminController::class, 'resetForm'])->name('reset.password.form');
            route::post('/password/reset', [SuperAdminController::class, 'resetPassword'])->name('reset.password');
      });
      Route::middleware(['auth:superAdmin'])->group(function () {
            Route::get('/impersonate/{guard}/{id}', [SuperAdminController::class, 'impersonate'])->name('impersonate');
            Route::get('/stop-impersonate', [SuperAdminController::class, 'stopImpersonate'])->name('stopImpersonate');

            //     Route::view('/home','superAdmin.pages.dashboard')->name('home');
            Route::get('/home', [SuperAdminDashboardController::class, 'dashboard'])->name('home');
            Route::view('/company', 'superAdmin.pages.company')->name('company');
            Route::view('/enquiry', 'superAdmin.pages.enquiry')->name('enquiry');
            Route::view('/moderator', 'superAdmin.pages.moderator')->name('moderator');
            // Route::view('/companyDetails', 'superAdmin.pages.companyDetails')->name('companyDetails');
            Route::get('/company_details/{id}', [CompanyController::class, 'companyDetails'])->name('companyDetails');
            Route::view('/my-account', 'superAdmin.pages.account')->name('account');
            Route::post('/update-account', [SuperAdminController::class, 'update_account'])->name('profile.update');
            Route::post('/create-moderator', [SuperAdminController::class, 'create_moderator'])->name('createModerator');
            Route::put('/update-moderator', [SuperAdminController::class, 'update_moderator'])->name('updateModerator');
            Route::get('/delete-moderator/{id}', [SuperAdminController::class, 'delete_moderator'])->name('deleteModerator');
            Route::post('/update-membership', [SuperAdminController::class, 'update_membership'])->name('updateMembership');


            Route::post('/logout', [SuperAdminController::class, 'logout'])->name('logout');
            //ajax req//
            Route::get('/registed-company', [CompanyController::class, 'superAdminSignedCompany'])->name('superAdminSignedCompany');
            Route::get('/all-enquiry', [EnquiryController::class, 'superAdminEnquiry'])->name('superAdminEnquiry');
            Route::get('/bar-chart-data', [SuperAdminDashboardController::class, 'barChart'])->name('barChart');
            Route::get('/company-delete', [SuperAdminDashboardController::class, 'CompanyDelete'])->name('deleteCompany');


            //ajax req//


      });
});

Route::prefix('moderator')->name('moderator.')->group(function () {
      Route::middleware(['guest:moderator', 'preventBackHistory'])->group(function () {
            Route::view('/login', 'moderator.login')->name('login');
            Route::view('/register', 'moderator.register')->name('register');
            Route::post('/create', [ModeratorController::class, 'create'])->name('create');
            Route::post('/check', [ModeratorController::class, 'check'])->name('check');
            Route::get('/password/forgot', [ModeratorController::class, 'forgotForm'])->name('forgot.form');
            Route::post('/password/forgot', [ModeratorController::class, 'resetLink'])->name('forgot.link');
            route::get('password/reset/{token}', [ModeratorController::class, 'resetForm'])->name('reset.password.form');
            route::post('/password/reset', [ModeratorController::class, 'resetPassword'])->name('reset.password');
      });
      Route::middleware(['auth:moderator'])->group(function () {
            // Route::view('/home', 'moderator.pages.dashboard')->name('home');
            Route::get('/home', [ModeratorDashboardController::class, 'dashboard'])->name('home');
            Route::view('/approved-company', 'moderator.pages.signedCompany')->name('approvedCompany');
            Route::view('/nonapproved-company', 'moderator.pages.requestedCompany')->name('nonapprovedCompany');
            Route::view('/my-account', 'moderator.pages.myAccount')->name('account');
            Route::post('/update-account', [ModeratorController::class, 'update_account'])->name('profile.update');
            Route::post('/create-company', [ModeratorController::class, 'create_company'])->name('createCompany');
            Route::get('/company-decline/{id}', [ModeratorController::class, 'company_decline'])->name('company.decline');
            Route::get('/company-approve/{id}', [ModeratorController::class, 'company_approve'])->name('company.approve');
            Route::post('/logout', [ModeratorController::class, 'logout'])->name('logout');
            //ajax-request
            Route::get('/signed-company', [CompanyController::class, 'signedCompany'])->name('signedCompany');
            Route::get('/requested-company', [CompanyController::class, 'requestedCompany'])->name('requestedCompany');
            Route::get('/bar-chart-data', [ModeratorDashboardController::class, 'barChart'])->name('barChart');
            Route::get('/company_details', [CompanyController::class, 'companyDetailsModerator'])->name('companyDetails.moderator');
            Route::get('/requested_company/{id}', [CompanyController::class, 'requestedCompanyDetails'])->name('requested.company');
            Route::post('/update-subscription', [ModeratorController::class, 'update_subscription'])->name('update.subscription');
            Route::post('/subscription-email', [ModeratorController::class, 'email_subscription'])->name('send.subs.email');



            //ajax-request
      });
});

Route::get('/carFullInfo', [CarInfoController::class, 'carInfo'])->name('car.info')->middleware('auth:superAdmin,web,businessUser');