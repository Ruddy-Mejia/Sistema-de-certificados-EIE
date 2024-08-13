<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Semester;
use App\Interfaces\CourseInterface;

class CourseRepository implements CourseInterface {
    public function create($request) {
        try {
            Course::create($request);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create School Course. '.$e->getMessage());
        }
    }

    public function getAll($session_id) {
        return Course::where('sesion_id', $session_id)->get();
    }

    public function getByClassId($class_id) {
        return Course::where('clase_id', $class_id)->get();
    }

    public function findById($course_id) {
        return Course::find($course_id);
    }

    public function update($request) {
        try {
            Course::find($request->course_id)->update([
                'nombre_curso'  => $request->nombre_curso,
                'carga_horaria'  => $request->carga_horaria,
                'metodo_estudio'  => $request->metodo_estudio,

            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Course. '.$e->getMessage());
        }
    }
}
