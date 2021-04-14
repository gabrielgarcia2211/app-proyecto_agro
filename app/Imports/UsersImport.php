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
            'celular' => $row['celular'],
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

        $estudiante = new Estudiante();

        $estudiante->documento=$row['cedula'];
        $estudiante->egresado=0;
        $estudiante->semestrecursado=$row['semestre_cursado'];
        $estudiante->materiasaprobadas=$row['materias_aprobadas'];
        $estudiante->promedio=$row['promedio'];
        $estudiante->fechaingreso =\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_ingreso']);
        $estudiante->fechaegreso =(isset($row['fecha_egreso']))?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_egreso']):null;
        $estudiante->id_historial=null;
        $estudiante->save();



        Saber11::create([
            'idsaber11' => $row['id_icfes11'],
            'lectura_critica' => $row['lectura_11'],
            'matematicas' => $row['matematicas'],
            'sociales_ciudadanas' => $row['sociales_11'],
            'naturales' => $row['naturales'],
            'ingles' => $row['ingles_11'],
            'fecha' => (isset($row['fecha_11']))?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_11']):null
        ]);

        SaberPro::create([
            'idsaberpro' => $row['id_icfespro'],
            'lectura_critica' => $row['lectura'],
            'razonamiento_cuantitativo' => $row['razonamiento'],
            'competencias_ciudadana' => $row['sociales'],
            'comunicacion_escrita' => $row['comunicacion'],
            'ingles' => $row['ingles'],
            'fecha' => (isset($row['fecha_pro']))?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_pro']):null
        ]);

        Historial::create([
            'idsaberpro' => $row['id_icfespro'],
            'idsaber11' => $row['id_icfes11'],
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
            'id_icfespro' => 'required|unique:saber_pros,idsaberpro',
            'lectura' => 'required|integer',
            'razonamiento' => 'required|integer',
            'sociales' => 'required|integer',
            'comunicacion' => 'required|integer',
            'ingles' => 'required|integer',
            'id_icfes11' => 'required|unique:saber11s,idsaber11',
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
