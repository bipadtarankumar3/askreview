<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SpinnerController;
use App\Http\Controllers\CampingController;
use App\Http\Controllers\BikeModelController;
use App\Http\Controllers\FormFieldsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PrivateReviewController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QrController;



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


Route::get('/',[UserController::class,'login'])->name('login');
Route::get('login',[UserController::class,'login']);
Route::post('login_post',[UserController::class,'login_post']);
Route::get('logout',[UserController::class,'logout']);

// Google OAuth routes
Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('auth/google/one-tap', [UserController::class, 'handleGoogleOneTap'])->name('auth.google.onetap');

// Signup & Captcha routes
Route::get('site/signup', [FrontendController::class, 'site_signup_direct'])->name('site.signup');
Route::get('signup', [FrontendController::class, 'site_signup_direct'])->name('signup');
Route::get('refresh-captcha', [FrontendController::class, 'refresh_captcha'])->name('captcha.refresh');
Route::get('/site/{user_name}',[FrontendController::class,'site_singup']);
Route::post('singup_post',[FrontendController::class,'singup_post']);
Route::get('api/legal-content', [FrontendController::class, 'get_legal_content'])->name('api.legal_content');

// Customer Review & Frontend Routes
Route::get('/u/{user_name}',[FrontendController::class,'index']);
Route::post('/u/review_form_submit',[FrontendController::class,'review_form_submit']);
Route::post('/u/video_testimonial_form_submit',[FrontendController::class,'video_testimonial_form_submit']);
Route::get('/video-download/{id}',[FrontendController::class,'downloadVideoTestimonial'])->name('video.download');
Route::post('/u/private_feedback',[FrontendController::class,'private_feedback']);
Route::post('/u/spinner_form_check/post',[FrontendController::class,'spinner_form_check']);
Route::post('/u/spinner_round_check',[FrontendController::class,'spinner_round_check']);
Route::get('/u/success_submit/{user_name}',[FrontendController::class,'success_submit']);
Route::get('/dummy',[FrontendController::class,'dummy']);
Route::post('/review_links_analytics',[FrontendController::class,'review_links_analytics']);

Route::any('otp_verify_page',[UserController::class,'otp_verify_page']);
Route::any('otp_verify',[UserController::class,'otp_verify']);
Route::get('forgotPassword',[UserController::class,'forgotPassword']);
Route::post('adminUserIdCheck',[UserController::class,'adminUserIdCheck']);
Route::get('confirmPasswordPage/{adminKey}',[UserController::class,'confirmPasswordPage']);
Route::post('confirmPassword',[UserController::class,'confirmPassword']);
Route::get('changePassword',[UserController::class,'changePassword']);
Route::post('updatePassword',[UserController::class,'updatePassword']);



Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [UserController::class,'dashboard']);
    Route::get('profile', [UserController::class,'profile']);
    Route::post('profile_update', [UserController::class,'profile_update']);
    Route::post('complete_google_onboarding', [UserController::class,'complete_google_onboarding'])->name('google.complete_onboarding');
    Route::get('logout', [UserController::class,'logout']);
    Route::any('sub_user_list', [UserController::class,'sub_user_list']);
    Route::get('add_sub_user_page', [UserController::class,'add_sub_user_page']);
    Route::any('user_name_checking', [UserController::class,'user_name_checking']);
    Route::post('add_sub_user', [UserController::class,'add_sub_user']);
    Route::post('downloadUserPdf', [UserController::class,'downloadUserPdf']);
    Route::get('edit_sub_user/{id}', [UserController::class,'edit_sub_user']);
    Route::get('delete_sub_user/{id}', [UserController::class,'delete_sub_user']);
    Route::get('sub_user_add_expiry_date/{id}', [UserController::class,'sub_user_add_expiry_date']);
    Route::post('update_user_expiry_date', [UserController::class,'update_user_expiry_date'])->name('admin.update_user_expiry_date');
    Route::get('expiry_sub_user', [UserController::class,'expiry_sub_user']);
    Route::get('dashboard_visit/{id}', [UserController::class,'dashboard_visit']);
    Route::get('view_qr', [UserController::class,'view_qr']);
    Route::get('print_qr_code', [UserController::class,'print_qr_code']);
    Route::get('generatePDF', [UserController::class,'generatePDF']);
    Route::get('/show-qrcode', [UserController::class,'showQRCode'])->name('show-qrcode');
    Route::get('/view_noti/{id}', [NotificationController::class,'view_notification'])->name('view_noti');
    Route::post('/star_page_status', [UserController::class,'star_page_status']);

    // Legal & Policy Settings (SuperAdmin)
    Route::get('settings/legal', [UserController::class, 'legal_settings'])->name('admin.settings.legal');
    Route::post('settings/legal', [UserController::class, 'update_legal_settings'])->name('admin.settings.legal.update');


    // ----------------- Admin Controller ------------------------
    Route::any('admin_list', [UserController::class,'admin_list']);
    Route::any('expiry_resaller_user', [UserController::class,'expiry_admin']);
    Route::get('admin_dashboard_visit', [UserController::class,'admin_dashboard_visit']);
    Route::get('add_admin_user', [UserController::class,'add_admin_user']);
    Route::post('submit_admin_user', [UserController::class,'submit_admin_user']);
    Route::get('edit_admin/{id}', [UserController::class,'edit_admin']);
    Route::get('delete_admin/{id}', [UserController::class,'delete_admin']);
    Route::get('my_wallets_list', [WalletsController::class,'my_wallets_list']);
    Route::get('my_user_payment_list', [WalletsController::class,'my_user_payment_list']);
    // ----------------- Admin Controller End------------------------

    // ----------------- Wallet Controller ------------------------
    Route::any('wallets_list', [WalletsController::class,'wallets_list']);
    Route::get('add_wallets', [WalletsController::class,'add_wallets']);
    Route::post('submit_wallets', [WalletsController::class,'submit_wallets']);
    Route::get('edit_wallets/{id}', [WalletsController::class,'edit_wallets']);
    Route::get('delete_wallets/{id}', [WalletsController::class,'delete_wallets']);
    // ----------------- Wallet Controller End------------------------


    // ----------------- UserController ------------------------
    Route::any('ip_skip', [UserController::class,'ip_skip']);
    Route::get('add_ip_skip_page', [UserController::class,'add_ip_skip_page']);
    Route::post('add_ip_skip', [UserController::class,'add_ip_skip']);
    Route::post('downloadCampaignPdf', [UserController::class,'downloadCampaignPdf']);
    Route::get('edit_ip_skip/{id}', [UserController::class,'edit_ip_skip']);
    Route::get('delete_ip_skip/{id}', [UserController::class,'delete_ip_skip']);
    // ----------------- UserController End------------------------


    // ----------------- Camping ------------------------
    Route::any('camping_list', [CampingController::class,'camping_list']);
    Route::get('add_camping_page', [CampingController::class,'add_camping_page']);
    Route::post('add_camping', [CampingController::class,'add_camping']);
    Route::post('downloadCampaignPdf', [CampingController::class,'downloadCampaignPdf']);
    Route::get('edit_camping/{id}', [CampingController::class,'edit_camping']);
    Route::get('delete_camping/{id}', [CampingController::class,'delete_camping']);
    // ----------------- Camping End------------------------



    // ----------------- Form Fields Access ------------------------
    Route::any('form_field', [FormFieldsController::class,'form_field']);
    Route::any('add_form_page', [FormFieldsController::class,'add_form_page']);
    Route::any('field_form', [FormFieldsController::class,'field_form']);
    Route::post('add_input_field', [FormFieldsController::class,'add_input_field']);
    Route::post('add_input_field_data', [FormFieldsController::class,'add_input_field_data']);
    Route::get('edit_form_field/{id}', [FormFieldsController::class,'edit_form_field']);
    Route::get('delete_form_field/{id}', [FormFieldsController::class,'delete_form_field']);
    Route::get('review_list', [FormFieldsController::class,'review_list']);
    Route::get('view_review/{id}', [FormFieldsController::class,'view_review']);
    // ----------------- Form Fields Access End------------------------


    // ----------------- Review Links ------------------------
    Route::any('review_links', [ReviewController::class,'review_links']);
    Route::any('review_links_form', [ReviewController::class,'review_links_form']);
    Route::any('integration_form', [ReviewController::class,'integration_form']);
    Route::any('open_integration_remove_modal', [ReviewController::class,'open_integration_remove_modal']);
    Route::any('integration_remove', [ReviewController::class,'integration_remove']);
    Route::any('add_review_links', [ReviewController::class,'add_review_links']);
    Route::get('edit_review_links/{id}', [ReviewController::class,'edit_review_links']);
    Route::get('delete_review_links/{id}', [ReviewController::class,'delete_review_links']);
    Route::get('social_review_list', [ReviewController::class,'social_review_list']);
    Route::get('video_testimonial', [ReviewController::class,'video_testimonial']);
    Route::get('video_testimonial_details/{id}', [ReviewController::class,'video_testimonial_details']);
    Route::get('video_testimonial_delete/{id}', [ReviewController::class,'video_testimonial_delete']);
    Route::post('integration_start', [ReviewController::class,'integration_start']);
    Route::post('update-integration-order', [ReviewController::class,'update_integration_order']);
    Route::get('google_feedback_templates', [ReviewController::class, 'get_google_feedback_templates']);
    Route::post('google_feedback_template_add', [ReviewController::class, 'add_google_feedback_template']);
    Route::post('google_feedback_template_delete', [ReviewController::class, 'delete_google_feedback_template']);
    Route::post('google_feedback_template_reorder', [ReviewController::class, 'reorder_google_feedback_templates']);

    // ----------------- Review Links End------------------------


    // ----------------- Spinner ------------------------
    Route::any('spinner_list', [SpinnerController::class,'spinner_list']);
    Route::get('add_spinner_page', [SpinnerController::class,'add_spinner_page']);
    Route::get('spinner_form', [SpinnerController::class,'spinner_form']);
    Route::post('add_spinner', [SpinnerController::class,'add_spinner']);
    Route::post('downloadSpinnerPdf', [SpinnerController::class,'downloadSpinnerPdf']);
    Route::get('edit_spinner/{id}', [SpinnerController::class,'edit_spinner']);
    Route::get('delete_spinner/{id}', [SpinnerController::class,'delete_spinner']);
    Route::any('spinner_form_camping_list', [SpinnerController::class,'spinner_form_camping_list']);
    Route::post('downloadFormCampingPdf', [SpinnerController::class,'downloadFormCampingPdf']);
    Route::post('downloadSpinnerFormListPdf', [SpinnerController::class,'downloadSpinnerFormListPdf']);
    Route::any('spinner_form_list/{id}', [SpinnerController::class,'spinner_form_list']);
    Route::any('delete_spinner_form_list/{id}', [SpinnerController::class,'delete_spinner_form_list']);
    // ----------------- Spinner End------------------------


    // ----------------- Private Review ------------------------
    Route::any('private_review_list', [PrivateReviewController::class,'private_review_list']);
    Route::get('add_private_review_page', [PrivateReviewController::class,'add_private_review_page']);
    Route::post('add_private_review', [PrivateReviewController::class,'add_private_review']);
    Route::post('download_private_review_Pdf', [PrivateReviewController::class,'download_private_review_Pdf']);
    Route::get('edit_private_review/{id}', [PrivateReviewController::class,'edit_private_review']);
    Route::get('delete_private_review/{id}', [PrivateReviewController::class,'delete_private_review']);
    // ----------------- Private Review End------------------------


    
    // ----------------- Private Review ------------------------
    Route::any('questions', [QuestionController::class,'questions']);
    Route::any('active_form/{id}', [QuestionController::class,'active_form']);
    Route::any('question_field_form', [QuestionController::class,'question_field_form']);
    Route::post('questions_form', [QuestionController::class,'questions_form']);
    Route::post('my_form_update', [QuestionController::class,'my_form_update']);
    Route::post('add_input_field_data', [QuestionController::class,'add_input_field_data']);
    Route::get('edit_question/{id}', [QuestionController::class,'edit_question']);
    Route::get('delete_question/{id}', [QuestionController::class,'delete_question']);
    Route::get('view_question/{id}', [QuestionController::class,'view_question']);
    Route::get('list_question_answers', [QuestionController::class,'list_question_answers']);
    Route::get('view_question_answers/{id}', [QuestionController::class,'view_question_answers']);
    Route::get('delete_question_answers/{id}', [QuestionController::class,'delete_question_answers']);
    // ----------------- Private Review End------------------------


        
    // ----------------- Template ------------------------
    Route::any('template', [TemplateController::class,'template']);
    Route::any('template_add', [TemplateController::class,'template_add']);
    Route::any('template_edit/{id}', [TemplateController::class,'template_edit']);
    Route::any('template_status/{id}/{status}', [TemplateController::class,'template_status']);
    Route::any('delete_template/{id}', [TemplateController::class,'delete_template']);
    Route::any('template/question_field_form', [TemplateController::class,'question_field_form']);
    Route::post('template/questions_form', [TemplateController::class,'questions_form']);
    Route::post('template/my_form_update', [TemplateController::class,'my_form_update']);
    Route::post('template/add_input_field_data', [TemplateController::class,'add_input_field_data']);
    Route::get('template/edit_question/{id}', [TemplateController::class,'edit_question']);
    Route::get('template/delete_question/{id}', [TemplateController::class,'delete_question']);
    Route::get('template/view_question/{id}', [TemplateController::class,'view_question']);
    Route::get('template/list_question_answers', [TemplateController::class,'list_question_answers']);
    Route::get('template/view_question_answers/{id}', [TemplateController::class,'view_question_answers']);
    Route::get('template/delete_question_answers/{id}', [TemplateController::class,'delete_question_answers']);
    // ----------------- Template End------------------------


    //Category
    Route::get('category',[CategoryController::class,'category']);
    Route::post('catPositionChange',[CategoryController::class,'catPositionChange']);
    Route::post('addCategory',[CategoryController::class,'addCategory']);
    Route::get('categoryEdit/{Id}',[CategoryController::class,'categoryEdit']);
    Route::get('categoryDelete/{Id}',[CategoryController::class,'categoryDelete']);
    Route::get('categoryStatus/{Status}/{Id}',[CategoryController::class,'categoryStatus']);

    Route::post('post-reorder',[CategoryController::class,'updateOrder']); 



    Route::get('subCategory',[CategoryController::class,'subCategory']);
    Route::post('addSubCategory',[CategoryController::class,'addSubCategory']);
    Route::get('subCategoryEdit/{Id}',[CategoryController::class,'subCategoryEdit']);
    Route::get('subCategoryDelete/{Id}',[CategoryController::class,'subCategoryDelete']);
    Route::get('subCategoryStatus/{Status}/{Id}',[CategoryController::class,'subCategoryStatus']);

    Route::post('getSubCategory',[CategoryController::class,'getSubCategory']);

    //End Category

    // ----------------- Service ------------------------
    Route::any('service', [ServiceController::class,'service_list']);
    Route::any('service_update', [ServiceController::class,'service_update']);
    Route::any('user_service', [ServiceController::class,'user_service']);
    Route::any('user_service_payment_view/{id}', [ServiceController::class,'user_service_payment_view']);
    Route::any('service_payment_success/{id}', [ServiceController::class,'service_payment_success']);
    Route::post('user_service_payment_submit', [ServiceController::class,'user_service_payment_submit']);
    Route::get('user_payments_list', [ServiceController::class,'user_payments_list']);
    Route::get('get_state', [ServiceController::class,'get_state']);
    Route::get('service_support', [ServiceController::class,'service_support']);
    
    // ----------------- Service End------------------------

    // ----------------- Admin Service ------------------------
    Route::any('admin_service_payments_list', [ServiceController::class,'admin_service_payments_list']);
    Route::any('admin_blanced_list', [ServiceController::class,'admin_blanced_list']);
    Route::any('admin_service_payment_store', [ServiceController::class,'admin_service_payment_store']);
    Route::any('admin_service_payment_store_view/{id}', [ServiceController::class,'admin_service_payment_store_view']);
    Route::any('admin_service_payment_submit', [ServiceController::class,'admin_service_payment_submit']);
    
    
    // ----------------- Admin Service End------------------------


    Route::any('links_analytics', [QrController::class,'links_analytics']);
    Route::any('qr_analytics', [QrController::class,'qr_analytics']);


});


Route::get('/manifest/{userId}.json', function ($userId) {
    $lastVisitedUrl = request()->query('lastVisitedUrl', '/'); // Fetch from query string

    return response()->view('manifest', [
        'userId' => $userId,
        'lastVisitedUrl' => $lastVisitedUrl
    ])->header('Content-Type', 'application/json');
});

Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return '<h1>Application cache cleared successfully!</h1>';
});


