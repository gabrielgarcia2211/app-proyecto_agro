<?php
namespace App\Imports;

use App\Historial;
use App\Persona;
use App\User;
use App\Estudiante;
use App\Saber11;
use App\SaberPro;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;


class UsersImport implements ToModel,WithHeadingRow,WithValidation,SkipsOnFailure,WithChunkReading,WithBatchInserts
{
    use Importable,SkipsFailures, SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        Persona::create([
            'documento' => $row['cedula'],
            'nombres' => $row['nombre'],
            'apellidos' => $row['apellido'],
            'ceular' => $row['celular'],
            'correo' => $row['correo'],
            'telefono' => $row['telefono'],
            'tipo_documento' => $row['tipo_documento'],
            'direccion' => $row['direccion'],
        ]);


        User::create([
            'codigo' => $row['codigo'],
            'documento' => $row['cedula'],
            'email' => $row['correo_institucional'],
            'email_verified_at' => now(),
            'password' => md5($row['contrasena']),
            'remember_token' => Str::random(10),
            'rol' => 2,
        ]);


        Estudiante::create([
            'documento' => $row['cedula'],
            'egresado' => 0,
            'semestreCursado' => $row['semestre_cursado'],
            'materiasAprobadas' => $row['materias_aprobadas'],
            'promedio' => $row['promedio'],
            'fechaIngreso' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_ingreso']),
            'fechaEgreso' => (isset($row['fecha_egreso']))?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_egreso']):null,
            'idHistorial' => null,
        ]);



        Saber11::create([
            'idSaber11' => $row['id_icfes11'],
            'lectura_critica' => $row['lectura_11'],
            'matematicas' => $row['matematicas'],
            'sociales_ciudadanas' => $row['sociales_11'],
            'naturales' => $row['naturales'],
            'ingles' => $row['ingles_11'],
        ]);

        SaberPro::create([
            'idSaberPro' => $row['id_icfespro'],
            'lectura_critica' => $row['lectura'],
            'razonamiento_cuantitativo' => $row['razonamiento'],
            'competencias_ciudadana' => $row['sociales'],
            'comunicacion_escrita' => $row['comunicacion'],
            'ingles' => $row['ingles'],
        ]);

        Historial::create([
            'idSaberPro' => $row['id_icfespro'],
            'idSaber11' => $row['id_icfes11'],
            'documento' => $row['cedula'],
        ]);

    }

    public function rules(): array
    {
        return [
            'codigo' => 'unique:users',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cedula' => 'required|unique:users,documento',
            'celular' => 'required|digits:10',
            'correo' => 'required|email|unique:users,email',
            'telefono' => 'required|digits:7',
            'direccion' => 'required',
            'tipo_documento' => 'required',
            'correo_institucional' => 'required|email|unique:users,email',
            'semestre_cursado' => 'required|integer',
            'fecha_ingreso' => 'required',
            'contrasena' => 'required',
            'materias_aprobadas' => 'required|integer',
            'promedio' => 'required',
            'id_icfespro' => 'required|unique:saber_pros,idSaberPro',
            'lectura' => 'required|integer',
            'razonamiento' => 'required|integer',
            'sociales' => 'required|integer',
            'comunicacion' => 'required|integer',
            'ingles' => 'required|integer',
            'id_icfes11' => 'required|unique:saber11s,idSaber11',
            'lectura_11' => 'required|integer',
            'matematicas' => 'required|integer',
            'naturales' => 'required|integer',
            'ingles_11' => 'required|integer',
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 2;
    }



}
