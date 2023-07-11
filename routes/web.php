<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthorController;
use App\Http\Controllers\CompanyCategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\savedJobController;
use App\Http\Controllers\RozeeController;
use App\Http\Controllers\ContourController;
use App\Http\Controllers\BeoeController;
use App\Http\Controllers\PaperpkController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;




//public routes
Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/job/{job}', [PostController::class, 'show'])->name('post.show');
Route::get('employer/{employer}', [AuthorController::class, 'employer'])->name('account.employer');

Route::get('rozee/jobs', [RozeeController::class, 'showJobs'])->name('websiterozee');
Route::get('rozee/jobs/search', [RozeeController::class, 'search'])->name('rozeesearch');
Route::get('rozee/reset', [RozeeController::class, 'reset'])->name('resetrozee');

Route::get('contour/jobs', [ContourController::class, 'showJobs'])->name('websitecontour');
Route::get('contour/jobs/search', [ContourController::class, 'search'])->name('contoursearch');
Route::get('contour/reset', [ContourController::class, 'reset'])->name('resetcontour');

Route::get('beoe/jobs', [BeoeController::class, 'showJobs'])->name('websitebeoe');
Route::get('beoe/jobs/search', [BeoeController::class, 'search'])->name('beoesearch');
Route::get('beoe/reset', [BeoeController::class, 'reset'])->name('resetbeoe');

Route::get('paperpk/jobs', [PaperpkController::class, 'showJobs'])->name('websitepaperpk');
Route::get('paperpk/jobs/search', [PaperpkController::class, 'search'])->name('paperpksearch');
Route::get('paperpk/reset', [PaperpkController::class, 'reset'])->name('resetpaperpk');

Route::get('/forgot-password', function () {
  return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
  $request->validate(['email' => 'required|email']);

  $status = Password::sendResetLink(
      $request->only('email')
  );

  if ($status === Password::RESET_LINK_SENT) {
      Alert::toast('Reset link sent successfully!', 'success');
      return back();
  } else if ($status === Password::INVALID_USER) {
      Alert::toast('Email does not exist!', 'error');
      return back();
  } else {
      Alert::toast('Failed!', 'error');
      return back();
  }
})->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
  return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
  // dd('ok');
  $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|confirmed',
  ]);

  $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
          $user->forceFill([
              'password' => Hash::make($password)
          ])->setRememberToken(Str::random(60));

          $user->save();

          event(new PasswordReset($user));
      }
  );

  if($status === Password::PASSWORD_RESET)
  {
      Alert::toast('Password change successfuly', 'success');
      return redirect()->route('login');
  }
  else
  {
      Alert::toast('Password Not change', 'error');
      return back();
  }

})->name('password.update');


//return vue page
Route::get('/search', [JobController::class, 'index'])->name('job.index');

//auth routes
Route::middleware('auth')->prefix('account')->group(function () {
  //every auth routes AccountController
  Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
  Route::get('overview', [AccountController::class, 'index'])->name('account.index');
  Route::get('deactivate', [AccountController::class, 'deactivateView'])->name('account.deactivate');
  Route::get('change-password', [AccountController::class, 'changePasswordView'])->name('account.changePassword');
  Route::delete('delete', [AccountController::class, 'deleteAccount'])->name('account.delete');
  Route::put('change-password', [AccountController::class, 'changePassword'])->name('account.changePassword');
  //savedJobs
  Route::get('my-saved-jobs', [savedJobController::class, 'index'])->name('savedJob.index');
  Route::get('my-saved-jobs/{id}', [savedJobController::class, 'store'])->name('savedJob.store');
  Route::delete('my-saved-jobs/{id}', [savedJobController::class, 'destroy'])->name('savedJob.destroy');
  //applyjobs
  Route::get('apply-job', [AccountController::class, 'applyJobView'])->name('account.applyJob');
  Route::post('apply-job', [AccountController::class, 'applyJob'])->name('account.applyJob');


  //Admin Role Routes
  Route::group(['middleware' => ['role:admin']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('account.dashboard');
    Route::get('view-all-users', [AdminController::class, 'viewAllUsers'])->name('account.viewAllUsers');
    Route::delete('view-all-users', [AdminController::class, 'destroyUser'])->name('account.destroyUser');

    Route::get('category/{category}/edit', [CompanyCategoryController::class, 'edit'])->name('category.edit');
    Route::post('category', [CompanyCategoryController::class, 'store'])->name('category.store');
    Route::put('category/{id}', [CompanyCategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CompanyCategoryController::class, 'destroy'])->name('category.destroy');
  });

  //Author Role Routes
  Route::group(['middleware' => ['role:author']], function () {
    Route::get('author-section', [AuthorController::class, 'authorSection'])->name('account.authorSection');

    Route::get('job-application/{id}', [JobApplicationController::class, 'show'])->name('jobApplication.show');
    Route::delete('job-application', [JobApplicationController::class, 'destroy'])->name('jobApplication.destroy');
    Route::get('job-application', [JobApplicationController::class, 'index'])->name('jobApplication.index');

    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::put('company/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('company/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::delete('company', [CompanyController::class, 'destroy'])->name('company.destroy');
  });

  //User Role routes
  Route::group(['middleware' => ['role:user']], function () {
    Route::get('become-employer', [AccountController::class, 'becomeEmployerView'])->name('account.becomeEmployer');
    Route::post('become-employer', [AccountController::class, 'becomeEmployer'])->name('account.becomeEmployer');
  });
});
