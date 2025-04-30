
@extends('layouts.empresa')

@section('contentEmpresa')

    @include('dashboard.empresa.nav.nav')
        <!-- Page content -->
    <div class="container-fluid mt--6" id="contenedor">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Ofertas</h6>
                            <h5 class="h3 mb-0">Oferta Publicadas</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="box box-primary cajaO" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">

                        <form action="{{route('empresa.oferta.guardar')}}" method="POST">
                            @csrf

                            <div class=" form-row">
                                <div class="form-group col-md-6">
                                    <label for="empleo">Empleo</label>
                                    <input type="text" class="form-control {{ $errors->has('empleo') ? ' is-invalid' : '' }}" value="{{ old('empleo') }}"  id="empleo" name="empleo" required>
                                    @if ($errors->has('empleo'))
                                        <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('empleo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label style="margin-top:2%; display:block" for="">Jornada</label>
                                    <p style="display:inline-block; margin-right:10px">Inicio Jornada: </p><input style="width:25%; display:inline-block"  type="time" onchange="onTimeChange()" id="horaInicio" name="horaInicio" required>
                                    <p style="display:inline-block ; margin-right:10px" >Fin  Jornada: </p><input style="width:25%; display:inline-block" type="time" onchange="onTimeChange2()" id="horaFin" name="horaFin" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="salario">Salario</label>
                                    <input onkeyup="capturarDinero(event)" type="text" class="form-control {{ $errors->has('salario') ? ' is-invalid' : '' }}" value="{{ old('salario') }}" id="salario" name="salario" placeholder="$" required>
                                    @if ($errors->has('salario'))
                                        <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('salario') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefono">Telefono</label>
                                    <input type="number"  class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{ old('telefono') }}" id="telefono" name="telefono" required>
                                    @if ($errors->has('telefono'))
                                        <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea class="form-control"  class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : '' }}" value="{{ old('descripcion') }}" id="descripcion" name="descripcion" rows="3" style="height:300px; resize: none;" required></textarea>
                                    @if ($errors->has('descripcion'))
                                        <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="requerimientos">Requerimientos</label>
                                    <textarea class="form-control"  class="form-control {{ $errors->has('requerimientos') ? ' is-invalid' : '' }}" value="{{ old('requerimientos') }}" id="requerimientos" name="requerimientos" rows="3" style="height:300px; resize: none;" required></textarea>
                                    @if ($errors->has('requerimientos'))
                                        <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('requerimientos') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39;">Publicar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection

@section('script')
    <script src="{{asset('js/empresa/main.js')}}"></script>
@endsection

