<?php

use App\Http\Controllers\Example\AnimalController;
use App\Http\Controllers\Example\CategoryController;
use App\Http\Controllers\Example\PostController;
use App\Http\Controllers\CarrerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CertificateaofabsenceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //rutas con controlador y prefix
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    });

    Route::prefix('/posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
    });

    Route::prefix('/animals')->group(function () {
        Route::get('/', [AnimalController::class, 'index'])->name('animals.index');
        Route::get('/create', [AnimalController::class, 'create'])->name('animals.create');
        Route::post('/', [AnimalController::class, 'store'])->name('animals.store');
        Route::get('/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
        Route::put('/{animal}', [AnimalController::class, 'update'])->name('animals.update');
        Route::delete('/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
        Route::get('/{animal}', [AnimalController::class, 'show'])->name('animals.show');
    });

    //rutas de posts de tipo resource
    // Route::resource('/students', StudentController::class);
    Route::resource('/carrers', CarrerController::class);

    Route::resource('/categories', CategoryController::class);
    Route::resource('/animals', AnimalController::class);
});

//? absences
Route::middleware('auth')->group(function () {

Route:: get('/absences', [AbsenceController::class,'index'])->name('absence.index');

Route::get('/absences/create', [AbsenceController::class,'create'])->name('absence.create');

Route::post('/absences', [AbsenceController::class,'store'])->name('absence.store');

Route::get ('/absences/{absence}', [AbsenceController::class,'show'])->name('absence.show');

Route::get('/absences/{absence}/edit', [AbsenceController::class,'edit'])->name('absence.edit');

Route :: put('/absences/{absence}', [AbsenceController::class, 'update'])->name('absence.update');

Route :: delete('/absences/{absence}',[AbsenceController::class,'destroy'])->name('absence.destroy');
});

//? attendances

Route::middleware('auth')->group(function () {

Route:: get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');

Route::get('/attendances/create', [AttendanceController::class,'create'])->name('attendances.create');

Route::post('/attendances', [AttendanceController::class,'store'])->name('attendances.store');

Route::get ('/attendances/{attendance}', [AttendanceController::class, 'show'])->name('attendances.show');
    Route::get('/attendances/{attendance}/delete', [AttendanceController::class,'delete'])->name('attendances.delete');

Route::get('/attendances/{attendance}/edit', [AttendanceController::class,'edit'])->name('attendances.edit');

Route :: put('/attendances/{attendance}', [AttendanceController::class, 'update'])->name('attendances.update');

Route :: delete('/attendances/{attendance}',[AttendanceController::class, 'destroy'])->name('attendances.destroy');
});

//?areas

Route::middleware('auth')->group(function () {

Route:: get('/areas', [AreaController::class, 'index'])->name('areas.index');

Route::get('/areas/create', [AreaController::class,'create'])->name('areas.create');

Route::post('/areas', [AreaController::class,'store'])->name('areas.store');

Route::get ('/areas/{area}', [AreaController::class, 'show'])->name('areas.show');
    Route::get('/areas/{area}/delete', [AreaController::class, 'delete'])->name('areas.delete');

Route::get('/areas/{area}/edit', [AreaController::class, 'edit'])->name('areas.edit');

Route :: put('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');

Route :: delete('/areas/{area}',[AreaController::class, 'destroy'])->name('areas.destroy');
});

//? schedules

Route::middleware('auth')->group(function () {

    // Backward compatibility: singular schedule routes
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::get('/schedule/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    Route::get('/schedules', [ScheduleController::class,'index'])->name('schedules.index');

    Route::get('/schedules/create', [ScheduleController::class,'create'])->name('schedules.create');

    Route::post('/schedules', [ScheduleController::class,'store'])->name('schedules.store');

    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');

    Route::get('/schedules/{schedule}/edit', [ScheduleController::class,'edit'])->name('schedules.edit');

    Route::put('/schedules/{schedule}', [ScheduleController::class,'update'])->name('schedules.update');

    Route::delete('/schedules/{schedule}',[ScheduleController::class, 'destroy'])->name('schedules.destroy');
});

//?certificateaofabsences

Route::middleware('auth')->group(function () {

Route:: get('/certificateaofabsences', [CertificateaofabsenceController::class,'index'])->name('certificateaofabsences.index');

Route::get('/certificateaofabsences/create', [CertificateaofabsenceController::class,'create'])->name('certificateaofabsences.create');

Route::post('/certificateaofabsences', [CertificateaofabsenceController ::class,'store'])->name('certificateaofabsences.store');

Route::get ('/certificateaofabsences/{certificateaofabsence}', [CertificateaofabsenceController::class,'show'])->name('certificateaofabsences.show');

Route::get('/certificateaofabsences/{certificateaofabsence}/edit', [CertificateaofabsenceController::class,'edit'])->name('certificateaofabsences.edit');

Route :: put('/certificateaofabsences/{certificateaofabsence}', [CertificateaofabsenceController::class,'update'])->name('certificateaofabsences.update');

Route :: delete('/certificateaofabsences/{certificateaofabsence}',[CertificateaofabsenceController::class,'destroy'])->name('certificateaofabsences.destroy');
});

//?reports

Route::middleware('auth')->group(function () {

Route:: get('/reports', [ReportController::class,'index'])->name('reports.index');

Route::get('/reports/create', [ReportController::class,'create'])->name('reports.create');

Route::post('/reports', [ReportController ::class,'store'])->name('reports.store');

Route::get ('/reports/{report}', [ReportController::class,'show'])->name('reports.show');

Route::get('/reports/{report}/edit', [ReportController::class,'edit'])->name('reports.edit');

Route :: put('/reports/{report}', [ReportController::class,'update'])->name('reports.update');

Route :: delete('/reports/{report}',[ReportController::class,'destroy'])->name('reports.destroy');
});


Route::middleware('auth')->group(function () {

Route::get('/workers',[WorkerController::class,'index'])->name('workers.index');

Route::get('/workers/create',[WorkerController::class,'create'])->name('workers.create');

Route::post('/workers',[WorkerController:: class,'store'])->name('workers.store');

Route::get('/workers/{worker}',[WorkerController::class,'show'])->name('workers.show');

Route::get('/workers/{worker}/edit',[WorkerController::class,'edit'])->name('workers.edit');

Route::get('/workers/{worker}/delete',[WorkerController::class, 'delete'])->name('workers.delete');

Route::put('/workers/{worker}',[WorkerController::class,'update'])->name('workers.update');

Route::delete('/workers/{worker}',[WorkerController::class,'destroy'])->name('workers.destroy');
});
//?


require __DIR__ . '/auth.php';
