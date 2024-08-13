<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\UserInterface;
use App\Interfaces\SectionInterface;
use App\Interfaces\SchoolClassInterface;
use App\Repositories\PromotionRepository;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\TeacherStoreRequest;
use App\Interfaces\SchoolSessionInterface;
use App\Repositories\StudentParentInfoRepository;
use App\Models\User;
use App\Models\Course;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\MailController;

class UserController extends Controller
{
    use SchoolSession;
    protected $userRepository;
    protected $schoolSessionRepository;
    protected $schoolClassRepository;
    protected $schoolSectionRepository;

    public function __construct(UserInterface $userRepository, SchoolSessionInterface $schoolSessionRepository,
    SchoolClassInterface $schoolClassRepository,
    SectionInterface $schoolSectionRepository)
    {
        $this->userRepository = $userRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TeacherStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeTeacher(TeacherStoreRequest $request)
    {
        if (!auth()->user()->can('crear usuario')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        try {
            $this->userRepository->createTeacher($request->validated());

            return back()->with('status', 'Usuario creado exitosamente!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function getStudentList(Request $request) {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $class_id = $request->query('class_id', 0);
        $section_id = $request->query('section_id', 0);

        try{

            $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

            $studentList = $this->userRepository->getAllStudents($current_school_session_id, $class_id, $section_id);

            $data = [
                'studentList'       => $studentList,
                'school_classes'    => $school_classes,
            ];

            return view('students.list', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


    public function showStudentProfile($id) {
        $student = $this->userRepository->findStudent($id);

        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotionRepository = new PromotionRepository();
        $promotion_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $id);

        $data = [
            'student'           => $student,
            'promotion_info'    => $promotion_info,
        ];

        return view('students.profile', $data);
    }

    public function showTeacherProfile($id) {
        if (!auth()->user()->can('ver usuario')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        $teacher = $this->userRepository->findTeacher($id);
        // $teacher = User::find($id);
        $data = [
            'teacher'   => $teacher,
        ];
        return view('teachers.profile', $data);
    }


    public function createStudent() {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);
        $courses = Course::all();
        $data = [
            'current_school_session_id' => $current_school_session_id,
            'school_classes'            => $school_classes,
            'courses'                   => $courses,
        ];

        return view('students.add', $data);
    }
    public function createUser() {
        if (!auth()->user()->can('crear usuario')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        $courses = Course::all();
        $roles = Role::all();
        $cities = Cities::all();
        $data = [

            'courses'     => $courses,
            'roles'       => $roles,
            'cities'=> $cities,
        ];

        return view('teachers.add', $data);
    }

    public function crearEstudiante() {
        if (!auth()->user()->can('crear usuario')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        $courses = Course::all();
        $roles = Role::all();
        $cities = Cities::all();
        $data = [

            'courses'     => $courses,
            'roles'       => $roles,
            'cities'=> $cities,
        ];

        return view('teachers.add-student', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeStudent(StudentStoreRequest $request)
    {
        try {
            $this->userRepository->createStudent($request->validated());

            return back()->with('status', 'Student creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function editStudent($student_id) {
        $student = $this->userRepository->findStudent($student_id);
        $studentParentInfoRepository = new StudentParentInfoRepository();
        $parent_info = $studentParentInfoRepository->getParentInfo($student_id);
        $promotionRepository = new PromotionRepository();
        $current_school_session_id = $this->getSchoolCurrentSession();
        $promotion_info = $promotionRepository->getPromotionInfoById($current_school_session_id, $student_id);

        $data = [
            'student'       => $student,
            'parent_info'   => $parent_info,
            'promotion_info'=> $promotion_info,
        ];
        return view('students.edit', $data);
    }

    public function updateStudent(Request $request) {
        try {
            $this->userRepository->updateStudent($request->toArray());

            return back()->with('status', 'Student update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function editTeacher($teacher_id) {
        if (!auth()->user()->can('editar usuario')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        $teacher = $this->userRepository->findTeacher($teacher_id);
        $rols = Role::all();
        $course = Course::all();
        $cities = Cities::all();
        $data = [
            'teacher'   => $teacher,
            'userRoles' => $teacher->roles,
            'rols' => $rols,
            'course' => $course,
            'cities'=> $cities,
        ];

        return view('teachers.edit', $data);
    }
    public function updateTeacher(Request $request) {
        try {
            $this->userRepository->updateTeacher($request->toArray());

            return back()->with('status', 'Actualizacion de Usuario con exito!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function getTeacherList(){
        if (!auth()->user()->can('ver usuario')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        $teachers = $this->userRepository->getAllTeachers();
        $data = [
            'teachers' => $teachers,
        ];
        return view('teachers.list', $data);
    }
    public function updatePassword(Request $request, $id) {
        try {

            if ($request->password !== $request->confirm_password) {
                return back()->withInput()->withErrors(['confirm_password' => 'Las contraseñas no coinciden.']);
            }
            User::where('id', $id)->update([
                'password'  => Hash::make($request->password)
            ]);
            return back()->with('status', 'Contraseña cambiado exitosamente!');
        } catch (\Exception $e) {
            throw new \Exception('Failed to change password. '.$e->getMessage());
        }
    }
}
