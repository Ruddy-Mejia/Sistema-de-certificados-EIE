@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-journal-medical"></i> Editar Curso</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Cursos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Curso</li>
                        </ol>
                    </nav>
                    @include('session-messages')
                    <div class="row">
                        <form class="col-6" action="{{route('school.course.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                            <input type="hidden" name="course_id" value="{{$course_id}}">
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Nombre Curso</label>
                                <input class="form-control" id="nombre_curso" name="nombre_curso" type="text" value="{{$course->nombre_curso}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Carga Horaria</label>
                                <input class="form-control" id="carga_horaria" name="carga_horaria" type="text" value="{{$course->carga_horaria}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Metodo de estudio</label>
                                <input class="form-control" id="metodo_estudio" name="metodo_estudio" type="text" value="{{$course->metodo_estudio}}" required>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="course_type" class="form-label">Tipo de Curso</label>
                                <select class="form-select" id="course_type" name="course_type" aria-label="Course type">
                                    <option value="Core" {{($course->course_type == 'Core')? 'selected' : ''}}>Centro</option>
                                    <option value="General" {{($course->course_type == 'General')? 'selected' : ''}}>General</option>
                                    <option value="Elective" {{($course->course_type == 'Elective')? 'selected' : ''}}>Efectivo</option>
                                    <option value="Optional" {{($course->course_type == 'Optional')? 'selected' : ''}}>Opcional</option>
                                </select>
                            </div> -->
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-check2"></i> Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
