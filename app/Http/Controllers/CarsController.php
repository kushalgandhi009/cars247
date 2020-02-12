<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cases;
use App\Car;
use Cookie;

class CarsController extends Controller
{

    public function get_created_data(Request $request){
        $car = new Car();
        $get_all_cars = $car->pluck('make','id')->toArray();
        //print_r($get_all_cars);
        $get_all_cars_name = array_unique($get_all_cars);

        return json_encode($get_all_cars_name);
    }
    public function get_changed_data(Request $request){
        $car = new Car();

        $case = new Cases();

        if ($request->session()->has('get_the_id')) {
            $get_the_id = session('get_the_id');
            $case->where('id', $get_the_id)->update([
                'case' => $request->getCase,
                'make'=> $request->selectedCarCompany,
                'model' => $request->selectedCarModel,
                'mileage' => $request->getMileage,
                'buying_date'=>$request->getDate,
                'color' => $request->selectedCarColor,
                'drivetrain' => $request->selectedCarDrivetrain]);
        }
        else{
            $case->case = $request->getCase;
            $case->make = $request->selectedCarCompany;
            $case->model = $request->selectedCarCompany;
            $case->mileage = $request->getMileage;
            $case->buying_date = $request->getDate;
            $case->color = $request->selectedCarColor;
            $case->drivetrain = $request->selectedCarDrivetrain;
            $case->save();
            session(['get_the_id' => $case->id]);
            $get_the_id = session('get_the_id');
        }

        $get_car_company_id = $request->selectedCarCompany;
        $get_all_car_model_val = $car->where('make',$get_car_company_id)->pluck('model')->toArray();
        $get_all_car_model = array_unique($get_all_car_model_val);
        $get_car_company_model = $request->selectedCarModel;
        $get_all_car_color_val = $car->where('model',$get_car_company_model)->pluck('color')->toArray();
        $get_all_car_color = array_unique($get_all_car_color_val);
        $result_array['get_all_car_model'] = $get_all_car_model;
        $result_array['get_all_car_color'] = $get_all_car_color;

        if($get_car_company_model == 'Grand Cherokee'){
            $get_all_car_drivetrain_val = $car->where('model',$get_car_company_model)->where('color',$request->selectedCarColor)->pluck('drivetrain')->toArray();
            $get_all_car_drivetrain = array_unique($get_all_car_drivetrain_val);
            $result_array['get_car_drivetrain'] = $get_all_car_drivetrain;
        }
        return json_encode($result_array);
    }

}
