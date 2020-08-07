<?php

namespace App\Http\Controllers;

use PDF;
use App\User;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ReportController extends Controller{
    
    public function index(){
        $consultations = Consultation::all();
        return view('reports.index')->with([
            'consultations' => $consultations
        ]);
    }

    /* TODO: Reporte de consulra por el modulo de reportes */
    public function generateConsultationReport($consultation_id){
        $consultation = Consultation::find($consultation_id);
        $patient = User::find($consultation->patient_id);
        $backgrounds = $consultation->backgrounds()->get();
        $diagnosis = $consultation->diagnosis()->get();
        $tests = $consultation->tests()->get();
        $treatments = $consultation->treatments()->get();
        $pdf = PDF::loadView('reports.pdf.consultation', [
            'consultation' => $consultation,
            'patient' => $patient,
            'backgrounds' => $backgrounds,
            'diagnosis' => $diagnosis,
            'tests' => $tests,
            'treatments' => $treatments
            ]);
        $pdf->download('consultation-'. getUserName($consultation->patient_id) . '-' . $consultation->date .'.pdf');
        return $pdf;
    }
 
}
