@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-book"></i> Cursos</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">cursos</li>
                        </ol>
                    </nav>
                    <div class="row">


                            @php
                                $total_sections = 0;
                            @endphp
                                <div class="col-12">
                                    <div class="card my-3">
                                        <div class="card-header bg-transparent">
                                        @include('session-messages')
                                            <ul class="nav nav-tabs card-header-tabs">
                                                <!-- <li class="nav-item">
                                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#class" role="tab" aria-current="true"><i class="bi bi-diagram-3"></i> </button>
                                                </li> -->
                                                <!-- <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#class{{1}}-syllabus" role="tab" aria-current="false"><i class="bi bi-journal-text"></i> Syllabus</button>
                                                </li> -->
                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#class12-courses" role="tab" aria-current="false"><i class="bi bi-journal-medical"></i> Cursos</button>
                                                </li>
                                                 <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#class-1-cursos" role="tab" aria-current="false"><i class="bi bi-journal-text"></i> Añadir curso</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body text-dark">
                                            <div class="tab-content">

                                                <div class="tab-pane fade" id="class-1-cursos" role="tabpanel">
                                                    <div class="mb-4">
                                                        <form class="row g-3" action="{{route('school.courseregister')}}" method="POST">
                                                            @csrf
                                                            <div class="col-md-3">
                                                                <label for="inputFirstName" class="form-label">Nombre curso<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                                                <input type="text" class="form-control" id="inputFirstName" name="course_name" placeholder="Ingrese su nombre" required >
                                                            </div>
                                                             <div class="col-md-3">
                                                                <label for="inputFirstName" class="form-label">Carga Horaria<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                                                <input type="text" class="form-control" id="horaria" name="horaria" placeholder="Ingrese la carga horaria" required >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="inputFirstName" class="form-label">Método<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                                                <input type="text" class="form-control" id="metodo" name="metodo" placeholder="Ingrese el metodo de estudio" required >
                                                            </div>
                                                            <!-- <div class="col-md-12">
                                                                <label for="course_type" class="form-label">Tipo <sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                                                <select id="course_type" class="form-select" name="course_type" required>
                                                                    <option value="General">General</option>
                                                                    <option value="Seccion">Seccion</option>


                                                                </select>
                                                            </div> -->
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-person-plus"></i> Guardar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="class12-courses" role="tabpanel">

                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">Nombre Curso</th>
                                                                <th scope="col">Acciones</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cursos as $course)
                                                            <tr>
                                                                <td>{{$course->nombre_curso}}</td>
                                                                <td>
                                                                    @can('editar curso')
                                                                    <a href="{{route('course.edit', ['id' => $course->id])}}" class="btn btn-sm btn-outline-primary" role="button"><i class="bi bi-pencil"></i> Editar</a>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
