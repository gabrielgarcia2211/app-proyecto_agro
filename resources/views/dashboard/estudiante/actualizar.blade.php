
@extends('layouts.estudiante')

@section('contentEstudiante')

    @include('dashboard.estudiante.nav.nav')
    <!-- Page content -->
    <div class="container-fluid mt--6" id="contenedor">

    <div class="card">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Actualizar</h6>
                    <h5 class="h3 mb-0">Actualizacion de datos</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h1>Actualizar Datos</h1>
            <div id="hojav" style="border-top: 3px solid #3c8dbc; background-color: white;">
                <form method="POST" action="{{ route('estudiante.actualizar') }}">
                    @csrf
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="number" class="form-control {{ $errors->has('celular') ? ' is-invalid' : '' }}"  id="celular" value="{{$dataEstudiante[0]->celular}}" name="celular" required>
                        @if ($errors->has('celular'))
                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('celular') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="number" class="form-control {{ $errors->has('celular') ? ' is-invalid' : '' }}" id="telefono" value="{{$dataEstudiante[0]->telefono}}" name="telefono"  required>
                        @if ($errors->has('telefono'))
                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="direccion" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" id="direccion" value="{{$dataEstudiante[0]->direccion}}" name="direccion"  required>
                        @if ($errors->has('direccion'))
                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('direccion') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Personal</label>
                        <input type="email" class="form-control {{ $errors->has('correo') ? ' is-invalid' : '' }}" id="correo" value="{{$dataEstudiante[0]->correo}}" name="correo" aria-describedby="emailHelp">
                        @if ($errors->has('correo'))
                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('correo') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label id="id1" for="exampleFormControlSelect2">Empresa</label>
                        <select onchange="return Capempresa()" class="form-control" id="exampleFormControlSelect2" name="emp">
                            <option value="0">no asignada</option>
                            @foreach($name as $m)
                            <option value="{{$m->nit}}">{{$m->nit . " - " . $m->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="empresaCaja form-group">
                        <label for="empresa">Nit Empresa Actual</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" value="{{isset($empresa[0]->nitemprea)?$empresa[0]->nitemprea:""}}" readonly>
                    </div>

                    <button type="submit"  class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39;">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('js/estudiante/main.js')}}"></script>
@endsection
