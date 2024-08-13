<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ExamRuleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\GradeRuleController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\GradingSystemController;
use App\Http\Controllers\SchoolSessionController;
use App\Http\Controllers\AcademicSettingController;
use App\Http\Controllers\AssignedTeacherController;
use App\Http\Controllers\Auth\UpdatePasswordController;

use App\Http\Controllers\RequestController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\FirmasController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ReporteController;

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

Route::get('prueba-correo', function () {
    return view('mail.prueba');
});




Route::get('/', function () {
    return view('welcome');
});
Route::get('/viewinscription', [ReporteController::class, 'index'])->name('viewinscription');
Route::post('/storeinscription', [ReporteController::class, 'store'])->name('storeinscription');
Route::get('/reload-captcha', [ReporteController::class, 'reloadCaptcha']);

Auth::routes();
Route::get('verificar/{id}', [ProcedureController::class, 'verify'])->name('verificar');

Route::middleware(['auth'])->group(function () {
    Route::resource('procedure', ProcedureController::class);
    Route::get('preview/{id}', [PreviewController::class, 'preview'])->name('preview');
    Route::get('predelete/{id}', [PreviewController::class, 'predelete'])->name('predelete');
    Route::get('editsolicitud/{id}', [ProcedureController::class, 'editsolicitud'])->name('editsolicitud');
    Route::post('updatesolicitud', [ProcedureController::class, 'updatesolicitud'])->name('updatesolicitud');

    Route::prefix('school')->name('school.')->group(function () {
        Route::post('session/create', [SchoolSessionController::class, 'store'])->name('session.store');
        Route::post('session/browse', [SchoolSessionController::class, 'browse'])->name('session.browse');

        Route::post('semester/create', [SemesterController::class, 'store'])->name('semester.create');
        Route::post('final-marks-submission-status/update', [AcademicSettingController::class, 'updateFinalMarksSubmissionStatus'])->name('final.marks.submission.status.update');

        Route::post('attendance/type/update', [AcademicSettingController::class, 'updateAttendanceType'])->name('attendance.type.update');

        // Class
        Route::post('class/create', [SchoolClassController::class, 'store'])->name('class.create');
        Route::post('class/update', [SchoolClassController::class, 'update'])->name('class.update');

        // Sections
        Route::post('section/create', [SectionController::class, 'store'])->name('section.create');
        Route::post('section/update', [SectionController::class, 'update'])->name('section.update');

        // Courses
        Route::post('course/create', [CourseController::class, 'store'])->name('course.create');
        Route::post('course/update', [CourseController::class, 'update'])->name('course.update');
        Route::post('courseregister', [CourseController::class, 'courseregister'])->name('courseregister');

        // Teacher
        Route::post('teacher/create', [UserController::class, 'storeTeacher'])->name('teacher.create');
        Route::post('teacher/update', [UserController::class, 'updateTeacher'])->name('teacher.update');
        Route::post('teacher/assign', [AssignedTeacherController::class, 'store'])->name('teacher.assign');

        // Student
        Route::post('student/create', [UserController::class, 'storeStudent'])->name('student.create');
        Route::post('student/update', [UserController::class, 'updateStudent'])->name('student.update');
    });


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Attendance
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendances/view', [AttendanceController::class, 'show'])->name('attendance.list.show');
    Route::get('/attendances/take', [AttendanceController::class, 'create'])->name('attendance.create.show');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('descargarReportePDF', [ProcedureController::class, 'descargarReportePDF'])->name('descargarReportePDF');
    Route::get('estudiantesPDF', [ProcedureController::class, 'estudiantesPDF'])->name('estudiantesPDF');
    Route::get('inscritosPDF', [ProcedureController::class, 'inscritosPDF'])->name('inscritosPDF');
    Route::get('certificatePDF', [ProcedureController::class, 'certificatePDF'])->name('certificatePDF');
    Route::get('entregatePDF', [ProcedureController::class, 'entregatePDF'])->name('entregatePDF');
    Route::get('preinscritosPDF', [ProcedureController::class, 'preinscritosPDF'])->name('preinscritosPDF');
    Route::get('listpre', [ProcedureController::class, 'listpre'])->name('listpre');
    Route::get('generatecertificate/{id}', [ProcedureController::class, 'generatecertificate'])->name('generatecertificate');
    Route::get('deleteandgenerate/{id}', [ProcedureController::class, 'deleteandgenerate'])->name('deleteandgenerate');

    // Classes and sections
    Route::get('/classes', [SchoolClassController::class, 'index']);

    Route::get('/class/edit/{id}', [SchoolClassController::class, 'edit'])->name('class.edit');
    Route::get('/sections', [SectionController::class, 'getByClassId'])->name('get.sections.courses.by.classId');
    Route::get('/section/edit/{id}', [SectionController::class, 'edit'])->name('section.edit');
    Route::resource('request', RequestController::class);
    Route::get('listrequest', [RequestController::class, 'index'])->name('listrequest');
    Route::put('filesupdate/{id}', [RequestController::class, 'filesupdate'])->name('filesupdate');

    Route::post('feedback', [RequestController::class, 'feedback'])->name('feedback');
    Route::get('history/{id}', [RequestController::class, 'history'])->name('history');
    Route::get('keys', [KeyController::class, 'index'])->name('keys');
    Route::post('feedback_direccion', [FirmasController::class, 'feedback_direccion'])->name('feedback_direccion');



    Route::post('tomar/{id}', [RequestController::class, 'take'])->name('tomar');

    Route::post('checklist/{id}', [RequestController::class, 'checklist'])->name('checklist');

    // Route::post('guardar-usuario-editado', [UsuarioController::class, 'guardar_usuario_editado'])->name('guardar-usuario-editado');

    Route::resource('inscription', InscriptionController::class);
    Route::resource('roluser', RolesController::class);
    Route::resource('permisos', PermisosController::class);
    Route::resource('firma', FirmasController::class);

    Route::get('dataview/{id}', [FirmasController::class, 'dataview'])->name('dataview');

    Route::put('mergePDFsAction/{id}', [FirmasController::class, 'mergePDFsAction'])->name('mergePDFsAction');
    Route::put('fileacademic/{id}', [InscriptionController::class, 'fileacademic'])->name('fileacademic');
    // Route::resource('procedure', ProcedureController::class);
    Route::get('viewprocedure', [ProcedureController::class, 'viewprocedure'])->name('viewprocedure');
    Route::get('informationrepor', [ProcedureController::class, 'informationrepor'])->name('informationrepor');


    // Teachers
    Route::get('/teachers/add', [UserController::class, 'createUser'])->name('teacher.create.show');
    Route::get('/student/add', [UserController::class, 'crearEstudiante'])->name('student.add');
    // Route::get('/teachers/add', function () {
    //     return view('teachers.add');
    // })->name('teacher.create.show');
    Route::get('/teachers/edit/{id}', [UserController::class, 'editTeacher'])->name('teacher.edit.show');
    Route::get('/teachers/view/list', [UserController::class, 'getTeacherList'])->name('teacher.list.show');
    Route::get('/teachers/view/profile/{id}', [UserController::class, 'showTeacherProfile'])->name('teacher.profile.show');
    Route::post('updatePassword/{id}', [UserController::class, 'updatePassword'])->name('updatePassword');

    //Students
    // Route::get('/students/add', [UserController::class, 'createStudent'])->name('student.create.show');
    // Route::get('/students/edit/{id}', [UserController::class, 'editStudent'])->name('student.edit.show');
    // Route::get('/students/view/list', [UserController::class, 'getStudentList'])->name('student.list.show');
    // Route::get('/students/view/profile/{id}', [UserController::class, 'showStudentProfile'])->name('student.profile.show');
    // Route::get('/students/view/attendance/{id}', [AttendanceController::class, 'showStudentAttendance'])->name('student.attendance.show');

    // Marks
    // Route::get('/marks/create', [MarkController::class, 'create'])->name('course.mark.create');
    // Route::post('/marks/store', [MarkController::class, 'store'])->name('course.mark.store');
    // Route::get('/marks/results', [MarkController::class, 'index'])->name('course.mark.list.show');
    // Route::get('/marks/view', function () {
    //     return view('marks.view');
    // });
    // Route::get('/marks/view', [MarkController::class, 'showCourseMark'])->name('course.mark.show');
    // Route::get('/marks/final/submit', [MarkController::class, 'showFinalMark'])->name('course.final.mark.submit.show');
    // Route::post('/marks/final/submit', [MarkController::class, 'storeFinalMark'])->name('course.final.mark.submit.store');

    // Exams
    // Route::get('/exams/view', [ExamController::class, 'index'])->name('exam.list.show');
    // Route::get('/exams/view/history', function () {
    //     return view('exams.history');
    // });
    // Route::post('/exams/create', [ExamController::class, 'store'])->name('exam.create');
    // Route::post('/exams/delete', [ExamController::class, 'delete'])->name('exam.delete');
    // Route::get('/exams/create', [ExamController::class, 'create'])->name('exam.create.show');
    // Route::get('/exams/add-rule', [ExamRuleController::class, 'create'])->name('exam.rule.create');
    // Route::post('/exams/add-rule', [ExamRuleController::class, 'store'])->name('exam.rule.store');
    // Route::get('/exams/edit-rule', [ExamRuleController::class, 'edit'])->name('exam.rule.edit');
    // Route::post('/exams/edit-rule', [ExamRuleController::class, 'update'])->name('exam.rule.update');
    // Route::get('/exams/view-rule', [ExamRuleController::class, 'index'])->name('exam.rule.show');
    // Route::get('/exams/grade/create', [GradingSystemController::class, 'create'])->name('exam.grade.system.create');
    // Route::post('/exams/grade/create', [GradingSystemController::class, 'store'])->name('exam.grade.system.store');
    // Route::get('/exams/grade/view', [GradingSystemController::class, 'index'])->name('exam.grade.system.index');
    // Route::get('/exams/grade/add-rule', [GradeRuleController::class, 'create'])->name('exam.grade.system.rule.create');
    // Route::post('/exams/grade/add-rule', [GradeRuleController::class, 'store'])->name('exam.grade.system.rule.store');
    // Route::get('/exams/grade/view-rules', [GradeRuleController::class, 'index'])->name('exam.grade.system.rule.show');
    // Route::post('/exams/grade/delete-rule', [GradeRuleController::class, 'destroy'])->name('exam.grade.system.rule.delete');

    // Promotions
    // Route::get('/promotions/index', [PromotionController::class, 'index'])->name('promotions.index');
    // Route::get('/promotions/promote', [PromotionController::class, 'create'])->name('promotions.create');
    // Route::post('/promotions/promote', [PromotionController::class, 'store'])->name('promotions.store');

    // Academic settings
    // Route::get('/academics/settings', [AcademicSettingController::class, 'index']);

    // Calendar events
    // Route::get('calendar-event', [EventController::class, 'index'])->name('events.show');
    // Route::post('calendar-crud-ajax', [EventController::class, 'calendarEvents'])->name('events.crud');

    // Routines
    // Route::get('/routine/create', [RoutineController::class, 'create'])->name('section.routine.create');
    // Route::get('/routine/view', [RoutineController::class, 'show'])->name('section.routine.show');
    // Route::post('/routine/store', [RoutineController::class, 'store'])->name('section.routine.store');

    // Syllabus
    // Route::get('/syllabus/create', [SyllabusController::class, 'create'])->name('class.syllabus.create');
    // Route::post('/syllabus/create', [SyllabusController::class, 'store'])->name('syllabus.store');
    // Route::get('/syllabus/index', [SyllabusController::class, 'index'])->name('course.syllabus.index');

    // Notices
    // Route::get('/', [NoticeController::class, 'create'])->name('notice.create');
    // Route::post('/notice/cnotice/createreate', [NoticeController::class, 'store'])->name('notice.store');

    // Courses
    // Route::get('courses/teacher/index', [AssignedTeacherController::class, 'getTeacherCourses'])->name('course.teacher.list.show');
    // Route::get('courses/student/index/{student_id}', [CourseController::class, 'getStudentCourses'])->name('course.student.list.show');
    Route::get('course/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');

    // Assignment
    // Route::get('courses/assignments/index', [AssignmentController::class, 'getCourseAssignments'])->name('assignment.list.show');
    // Route::get('courses/assignments/create', [AssignmentController::class, 'create'])->name('assignment.create');
    // Route::post('courses/assignments/create', [AssignmentController::class, 'store'])->name('assignment.store');

    // Update password
    Route::get('password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit');
    Route::post('password/edit', [UpdatePasswordController::class, 'update'])->name('password.update');
    Route::post('key/edit', [KeyController::class, 'update'])->name('key/edit');
});
