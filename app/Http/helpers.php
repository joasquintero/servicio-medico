<?php

function getUserId($name){
    $names = explode(', ', $name);
    $id = \DB::table('users')->where(['names' => $names[0], 'family_names' => $names[1]])->value('id');
    return $id;
}
function getUserName($id){
    $names = \DB::table('users')->where(['id' => $id])->value('names');
    $family_names = \DB::table('users')->where(['id' => $id])->value('family_names');
    return $names . ', ' . $family_names;
}
function getRolName($id){
    $rol = \DB::table('roles')->where(['id' => $id])->value('name');
    return $rol;
}
function getIllnessId($name){
    $id = \DB::table('illnesses')->where(['name' => $name])->value('id');
    return $id;
}
function getIllnessName($id){
    $name = \DB::table('illnesses')->where(['id' => $id])->value('name');
    return $name;
}
function getPatientName($id){
    $names = \DB::table('users')->where(['id' => $id])->value('names');
    $family_names = \DB::table('users')->where(['id' => $id])->value('family_names');
    return $names . ', ' . $family_names;
}
function getUserRol($user_id){
    $role = App\User::find($user_id)->roles()->first();
    return $role->name;
}
function checkDocTime($doctor_name, $time){
    $doctor_id = getUserId($doctor_name);
    $doctor = App\User::find($doctor_id);
    if ($time >= $doctor->entry_time && $time <= $doctor->exit_time) {
        return response()->json(true);
    }
    return response()->json(false);
}
function checkDocWorkdays($doctor_name, $day){
    $doctor_id = getUserId($doctor_name);
    $doctor = App\User::find($doctor_id);
    $workdays = explode(",", $doctor->workdays);
    for ($i=0; $i < count($workdays); $i++) { 
        if ($day == $workdays[$i]) {
            return response()->json(true);
        }
    }
    return response()->json(false);
}