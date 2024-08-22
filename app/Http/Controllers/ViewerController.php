<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewerController extends Controller
{
    // stores the columns for automated generation of data for viewing
    public static array $columns = [
        "brgys" => ["name", "city.name"],
        "city" => ["name"],
        "patient" => ["name", "brgys.name", "number", "email", "case_type", "coronavirus_status"]
    ];
    // stores the associated labels
    public static array $labels = [
        "brgys" => ["name" => "Name", "city.name" => "City"],
        "city" => ["name" => "Name"],
        "patient" => ["name" => "Name", "brgys.name" => "Baranggay", "number" => "Number", 
                        "email" => "Email", "case_type" => "Case Type", 
                        "coronavirus_status" => "Corona Virus Status"]
    ];


    // prints the data according to the type
    public static function index(string $type, string $title, $data){
        return view('view', [
            "data" => $data,
            "title"=>$title,
            "labels" => self::$labels[$type],
            "cols" => self::$columns[$type]
        ]);  
    }
}
