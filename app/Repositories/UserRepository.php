<?php

namespace App\Repositories;

use App\Http\Controllers\MailController;
use App\Models\User;
use App\Models\Persona;
use App\Traits\Base64ToFile;
use App\Interfaces\UserInterface;
use App\Models\Role as ModelsRole;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\PromotionRepository;
use App\Repositories\StudentParentInfoRepository;
use App\Repositories\StudentAcademicInfoRepository;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    use Base64ToFile;

    /**
     * @param mixed $request
     * @return string
     */
    public function createTeacher($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $persona = Persona::create([
                    'nombre'    => $request['nombre'],
                    'apellidos'     => $request['apellidos'],
                    'genero'        => $request['genero'],
                    'telefono'         => $request['telefono'],
                    'direccion'       => $request['direccion'],
                    'ciudad'          => $request['ciudad'],
                ]);
                $user = User::create([
                    'email'         => $request['email'],
                    'rol'          => $request['rol_id'],
                    'password'      => Hash::make($request['email'] . substr($request['nombre'], 0, 1) . substr($request['apellidos'], 0, 1)),
                    'persona_id' => $persona->id,
                    'mail'          => $request['mail'],
                ]);
                $password = $request['email'] . substr($request['nombre'], 0, 1) . substr($request['apellidos'], 0, 1);
                $mailController = new MailController();
                // $mailController->notice($request['mail'], 'Cuenta creada exitosamente', "Su cuenta fue registrada en el sistema de Oficina Virtual de Trámites de la Escuela de Idiomas del Ejercito " . PHP_EOL . "Su contraseña es: $password ". PHP_EOL . "Se le sugiere cambiarla por cuestiones de seguridad");
                $mailController->notice(
                    $request['mail'],
                    'Cuenta creada exitosamente',
                    $password
                );

                $user->roles()->attach($request['rol_id'], ['model_type' => 'App\\Models\\User']);
            });
        } catch (\Exception $e) {
            throw new \Exception('Error al crear usuario. ' . $e->getMessage());
        }
    }

    /**
     * @param mixed $request
     * @return string
     */
    public function createStudent($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $student = User::create([
                    'nombre'    => $request['nombre'],
                    'apellidos'     => $request['apellidos'],
                    'email'         => $request['email'],
                    'genero'        => $request['genero'],
                    'telefono'         => $request['telefono'],
                    'direccion'       => $request['direccion'],
                    'ciudad'          => $request['ciudad'],
                    'rol'          => 'student',
                    'password'      => Hash::make($request['email'] . substr($request['nombre'], 0, 1) . substr($request['apellidos'], 0, 1)),
                ]);

                // Store Parents' information
                $studentParentInfoRepository = new StudentParentInfoRepository();
                $studentParentInfoRepository->store($request, $student->id);

                // Store Academic information
                $studentAcademicInfoRepository = new StudentAcademicInfoRepository();
                $studentAcademicInfoRepository->store($request, $student->id);

                // Assign student to a Class and a Section


                $student->givePermissionTo(
                    'view attendances',
                    'view assignments',
                    'submit assignments',
                    'view exams',
                    'view marks',
                    'view users',
                    'view routines',
                    'view syllabi',
                    'view events',
                    'view notices',
                );
            });
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Student. ' . $e->getMessage());
        }
    }

    public function updateStudent($request)
    {
        try {
            DB::transaction(function () use ($request) {
                User::where('id', $request['student_id'])->update([
                    'nombre'    => $request['nombre'],
                    'apellidos'     => $request['apellidos'],
                    'email'         => $request['email'],
                    'genero'        => $request['genero'],
                    'telefono'         => $request['telefono'],
                    'direccion'       => $request['direccion'],
                    'ciudad'          => $request['ciudad'],
                ]);

                // Update Parents' information
                $studentParentInfoRepository = new StudentParentInfoRepository();
                $studentParentInfoRepository->update($request, $request['student_id']);

                // Update Student's ID card number

            });
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Student. ' . $e->getMessage());
        }
    }

    public function updateTeacher($request)
    {
        try {
            // if ($request['estado'] == 0) {
            //     $request['email'] = $request['email'];
            // }
            if ($request['persona_id'] != 7) {
                DB::transaction(function () use ($request) {
                    Persona::where('id', $request['persona_id'])->update([
                        'nombre' => $request['nombre'],
                        'apellidos' => $request['apellidos'],
                        'genero' => $request['genero'],
                        'telefono' => $request['telefono'],
                        'direccion' => $request['direccion'],
                        'ciudad' => $request['ciudad'],
                        // 'estado' => $request['estado'],
                    ]);
                    $persona = Persona::find($request['persona_id']);
                    User::where('id', $request['teacher_id'])->update([
                        'email' => $request['email'],
                        // 'estado' => $request['estado'],
                    ]);
                    if (isset($request['cambiar']) && $request['cambiar'] == 1) {

                        $user = User::create([
                            'email'         => $request['email'],
                            'rol'          => "admin",
                            'password'      => Hash::make($request['email'] . substr($request['nombre'], 0, 1) . substr($request['apellidos'], 0, 1)),
                            'persona_id' => $persona->id,
                        ]);
                        $user->roles()->attach($request['rol_id']);
                    }
                });
            }
        } catch (\Exception $e) {
            throw new \Exception('Revise todos los campos');
        }
    }


    public function getAllStudents($session_id, $class_id, $section_id)
    {
        if ($class_id == 0 || $section_id == 0) {
            $schoolClass = SchoolClass::where('session_id', $session_id)
                ->first();

            if ($schoolClass == null) {
                throw new \Exception('There is no class and section');
            } else {
                $class_id = $schoolClass->id;
            }
        }
    }




    public function findStudent($id)
    {
        try {
            return User::with('parent_info', 'academic_info')->where('id', $id)->first();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get Student. ' . $e->getMessage());
        }
    }

    public function findTeacher($id)
    {
        try {
            // return User::where('id', $id)->where('role', 'teacher')->first();

            // return User::with('person')->where('id', $id)->first();
            return User::join('persona', 'usuario.persona_id', '=', 'persona.id')
                ->join('ciudades', 'persona.ciudad', '=', 'ciudades.id')
                ->where('usuario.id', $id)
                ->select('usuario.*', 'persona.*', 'ciudades.nombre as ciudad_nombre')
                ->first();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get Teacher. ' . $e->getMessage());
        }
    }

    public function getAllTeachers()
    {
        try {
            return User::with('person')->get();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get all Teachers. ' . $e->getMessage());
        }
    }

    public function changePassword($new_password)
    {
        try {
            return User::where('id', auth()->user()->id)->update([
                'password'  => Hash::make($new_password)
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Error al cambiar contraseña');
        }
    }
}
