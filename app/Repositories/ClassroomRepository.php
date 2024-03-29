<?php

namespace App\Repositories;

use App\Models\Classroom;


class ClassroomRepository implements ClassroomRepositoryInterface
{ 
    public function create(array $data)
    {
        if(isset( $data["student_ids"])){
        $students = $data["student_ids"];
        unset($data["students"]);
        $classroom = Classroom::create($data);
    
        
        $classroom->students()->attach($students);
        }else   $classroom = Classroom::create($data);
       
        $classroom->load(["promo","grade","teacher","students"]);
        
        return $classroom;
    }
    public function update(Classroom $Classroom, array $data)
    {   
        $students = $data["student_ids"];
        unset($data["student_ids"]);
        $Classroom->update($data);
        $Classroom->students()->sync($students);
        $Classroom->load(["promo","grade","teacher","students"]);
        return $Classroom;
    } 
    public function delete(Classroom $Classroom)
    {
        return $Classroom->delete();
    }
    public function getById(int $id)
    {
        return Classroom::find($id);
    }
    public function getAll()
    {
        return Classroom::with(['students', 'teacher', 'grade','promo'])->get();
    }
    public function paginate(int $Nrows){
        return Classroom::with(['students', 'teacher', 'grade','promo'])->paginate($Nrows);
    }
}
