<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\User;
use Validator;
use App\Models\Consultation;
use App\Models\Meeting;
use App\Models\Illness;
use Illuminate\Http\Request;

class ConsultationController extends Controller{
    
    public function index(){
        if (\Auth::check()) {
            $patients = User::whereHas('roles', function($query){
                $query->where('slug', 'patient');
            })->get();
            $illnesses = Illness::where('available', true)->get();
            $currentUser = \Auth::user();
            $consultations = Consultation::where(['available' => true])->get();
            $consultationsDoc = Consultation::where(['available' => true, 'doctor_id' => \Auth::user()->id])->get();
            return view('consultations.index')->with([
                'consultations' => $consultations,
                'consultationsDoc' => $consultationsDoc,
                'patients' => $patients,
                'illnesses' => $illnesses
            ]);
        } else {
            $consultations = Consultation::where(['available' => true])->get();
            return view('consultations.index')->with('consultations', $consultations);
        }
    }

    public function indexFromMeeting($doctor, $patient){
        if (\Auth::check()) {
            $patients = User::whereHas('roles', function($query){
                $query->where('slug', 'patient');
            })->get();
            $illnesses = Illness::where('available', true)->get();
            $currentUser = \Auth::user();
            $consultations = Consultation::where(['available' => true])->get();
            $consultationsDoc = Consultation::where(['available' => true, 'doctor_id' => \Auth::user()->id])->get();
            return view('consultations.indexFromMeeting')->with([
                'doctor' => $doctor,
                'patient' => $patient,
                'consultations' => $consultations,
                'consultationsDoc' => $consultationsDoc,
                'illnesses' => $illnesses,
                'patients' => $patients,
            ]);
        } else {
            $consultations = Consultation::where(['available' => true])->get();
            return view('consultations.indexFromMeeting')->with('consultations', $consultations);
        }
    }

    /**
     * Método para guardar la consulta
     */
    public function store(Request $request){
        $header = json_decode($request['header'])[0];
        $reference = $header->reference ? $header->reference : '';
        $motives = $header->motives ? $header->motives : '';
        $cih = $header->cih ? $header->cih : '';
        $date = $header->date ? $header->date : '';
        $id_creator = $header->id_creator ? $header->id_creator : '';
        $phisic_test = $header->phisic_test ? $header->phisic_test : '';
        $doctor_id = $header->doctor ? getUserId($header->doctor) : false;
        $patient_id = $header->patient ? getUserId($header->patient) : false;
        $data = [
            'reference' => $reference,
            'motives'   => $motives,
            'doctor_id' => $doctor_id,
            'patient_id'=> $patient_id,
            'cih'       => $cih,
            'date'       => $date,
            'phisic_test' => $phisic_test,
            'id_creator'  => $id_creator

        ];
        if(!empty($header->meeting)){
            $meeting_id = $header->meeting;
            $data['meeting_id'] = $meeting_id;
        }
        $validator = Validator::make($data, [
            'patient_id'=> 'required',
            'motives'=> 'required',
            'doctor_id'=> 'required',
            'cih'=> 'required',
            'date'=> 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([500, 'save', $errors]);
        } else {
            $consultation = Consultation::create($data);
        }
        $this->saveTableRows($request, 'diagnosisTable', $consultation);
        $this->saveTableRows($request, 'backgroundTable', $consultation);
        $this->saveTableRows($request, 'paraclinicTable', $consultation);
        $this->saveTableRows($request, 'treatmentTable', $consultation);

        /* Borrar cita lugo de creada la consulta */
        $cita = Meeting::where(['doctor_id' => $doctor_id, 'patient_id' => $patient_id])->first();
        if ($cita) {
            $cita->available = false;
            $cita->save();
        }

        return response()->json([200, 'save', $consultation]);
    }

    /**
     * Método para actualizar la consulta
     */
    public function update(Request $request){
        $header = json_decode($request['header'])[0];
        $id = $header->id ? $header->id : '';
        $reference = $header->reference ? $header->reference : '';
        $motives = $header->motives ? $header->motives : '';
        $cih = $header->cih ? $header->cih : '';
        $date = $header->date ? $header->date : '';
        $phisic_test = $header->phisic_test ? $header->phisic_test : '';
        $doctor_id = $header->doctor ? getUserId($header->doctor) : false;
        $patient_id = $header->patient ? getUserId($header->patient) : false;
        $data = [
            'id'        => $id,
            'reference' => $reference,
            'motives'   => $motives,
            'doctor_id' => $doctor_id,
            'patient_id'=> $patient_id,
            'cih'       => $cih,
            'date'       => $date,
            'phisic_test' => $phisic_test

        ];
        if(!empty($header->meeting)){
            $meeting_id = $header->meeting;
            $data['meeting_id'] = $meeting_id;
        }
        $validator = Validator::make($data, [
            'id'=> 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([500, 'update', $errors]);
        } else {
            $consultation = Consultation::find($data['id']);
            $consultation->update($data);
        }
        $this->updateTableRows($request, 'diagnosisTable', $consultation);
        $this->updateTableRows($request, 'backgroundTable', $consultation);
        $this->updateTableRows($request, 'paraclinicTable', $consultation);
        $this->updateTableRows($request, 'treatmentTable', $consultation);

        /* TODO:$pdf = PDF::loadView('pdf.consultation', $consultation);
        $pdf->download('consultation.pdf'); */

        return response()->json([200, 'update', $consultation]);
    }

    private function saveTableRows($request, $table, $consultation){
        $obj = json_decode($request[$table]);
        switch ($table) {
            case 'diagnosisTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->illness_id = $obj[$i]->Enfermedad;
                    $obj[$i]->description = $obj[$i]->Descripción;
                    unset($obj[$i]->Enfermedad);
                    unset($obj[$i]->Descripción);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $diagnosis = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                DB::table('diagnosis')->insert($diagnosis);
                break;
            case 'backgroundTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->relative = $obj[$i]->Familiar;
                    $obj[$i]->illness_id = $obj[$i]->Enfermedad;
                    unset($obj[$i]->Familiar);
                    unset($obj[$i]->Enfermedad);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $background = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                DB::table('background')->insert($background);
                break;
            case 'paraclinicTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->name = $obj[$i]->Exámen;
                    $obj[$i]->file = $obj[$i]->Archivo;
                    unset($obj[$i]->Exámen);
                    unset($obj[$i]->Archivo);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $tests = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                DB::table('tests')->insert($tests);
                break;
            case 'treatmentTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->type = $obj[$i]->Tipo;
                    $obj[$i]->name = $obj[$i]->Tratamiento;
                    $obj[$i]->description = $obj[$i]->Descripción;
                    unset($obj[$i]->Tipo);
                    unset($obj[$i]->Tratamiento);
                    unset($obj[$i]->Descripción);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $treatments = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                DB::table('treatments')->insert($treatments);
                break;
        }
    }

    /**
     * Actualiza las relaciones
     */
    private function updateTableRows($request, $table, $consultation){
        $obj = json_decode($request[$table]);
        switch ($table) {
            case 'diagnosisTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->illness_id = $obj[$i]->Enfermedad;
                    $obj[$i]->description = $obj[$i]->Descripción;
                    unset($obj[$i]->Enfermedad);
                    unset($obj[$i]->Descripción);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $diagnosis = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                $consultation->diagnosis()->delete();
                $consultation->diagnosis()->insert($diagnosis);
                break;
            case 'backgroundTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->relative = $obj[$i]->Familiar;
                    $obj[$i]->illness_id = $obj[$i]->Enfermedad;
                    unset($obj[$i]->Familiar);
                    unset($obj[$i]->Enfermedad);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $background = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                $consultation->backgrounds()->delete();
                $consultation->backgrounds()->insert($background);
                break;
            case 'paraclinicTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->name = $obj[$i]->Exámen;
                    $obj[$i]->file = $obj[$i]->Archivo;
                    unset($obj[$i]->Exámen);
                    unset($obj[$i]->Archivo);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $tests = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                $consultation->tests()->delete();
                $consultation->tests()->insert($tests);
                break;
            case 'treatmentTable':
                for ($i=0; $i < count($obj); $i++) { 
                    $obj[$i]->type = $obj[$i]->Tipo;
                    $obj[$i]->name = $obj[$i]->Tratamiento;
                    $obj[$i]->description = $obj[$i]->Descripción;
                    unset($obj[$i]->Tipo);
                    unset($obj[$i]->Tratamiento);
                    unset($obj[$i]->Descripción);
                    $obj[$i]->consultation_id = $consultation->id;
                }
                $treatments = array_map(function ($item){
                    return (array) $item;
                }, $obj);
                $consultation->treatments()->delete();
                $consultation->treatments()->insert($treatments);
                break;
        }
    }

    /**
     * Obtiene los datos de un sólo registro
     */
    public function getRecordFullInfo(Request $request){
        $header = Consultation::find($request->id);
        $backgrounds = $header->backgrounds;
        $diagnosis = $header->diagnosis;
        $tests = $header->tests;
        $treatments = $header->treatments;
        $consultation = [
            'header'      => $header,
            'backgrounds' => $backgrounds,
            'diagnosis'   => $diagnosis,
            'tests'       => $tests,
            'treatments'  => $treatments
        ];
        // dump($consultation);
        return response()->json([200, 'consultationInfo', $consultation]);
    }

    public function destroy(Request $request){
        $consultation = Consultation::find($request->id);
        if($consultation) {
            $consultation->available = false;
            $consultation->save();
            return response()->json([200, 'delete']);
        } else {
            return response()->json([500, 'delete']);
        }
    }
}
