<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Car;

class CarController extends Controller {
    public function index () {
        $datas = DB::select( 'SELECT id, name FROM cars' );
        return view( 'select', compact( 'datas' ) );
    }

    public function fetchYears( Request $request ) {
        $car_id = $request->get( 'car_id' );
        $carsYears = DB::table( 'cars_years' )
        ->select( 'year' )
        ->groupBy( 'year' )
        ->orderBy( 'year', 'DESC' )
        ->get();

        $options = '';
        foreach ( $carsYears as $item ) {
            $options .= '<option value="' . $item->year . '">' . $item->year . '</option>';
        }
        return response( $options );
    }

    public function fetchModels( Request $request ) {
        $carId = $request->input( 'car_id' );
        $year = $request->input( 'year' );

        if ( empty( $carId ) ) {
            return response()->json( [ 'error' => 'Invalid car ID' ], 400 );
        }
        $query = DB::table( 'cars_model as a' )
        ->leftJoin( 'cars_years as b', 'a.year_id', '=', 'b.id' )
        ->select( 'a.id', 'a.model', 'a.variant' )
        ->where( 'a.car_id', $carId )
        ->where( 'b.year', $year );

        $data = $query->get();

        foreach ( $data as $k => $v ) {
            echo '<option value="' . $v->id . '">' . $v->model . ' - ' . $v->variant . '</option>';
        }

    }

    public function fetchType( Request $request ) {
        $type = $request->input( 'type' );
        return $type;
    }

    public function fetchPositions( Request $request ) {
        $carId = request()->get( 'car_id' );
        $year = request()->get( 'year' );
        $model = request()->get( 'model' );

        $data = DB::table( 'cars_position as a' )
        ->select( 'a.usename', 'a.id' )
        ->distinct()
        ->leftJoin( 'cars_years as b', 'a.year_id', '=', 'b.id' )
        ->where( 'a.car_id', $carId )
        ->where( 'b.year', $year )
        ->where( 'a.model_id', $model )
        ->get();

        foreach ( $data as $key => $value ) {
            echo "<button class='tech-button' data-tech-id='" . $value->id . "'>" . $value->usename . '</button>\n';
        }

    }

    public function fetchTechnologies( Request $request ) {
        $carId = request()->get( 'car_id' );
        $year = request()->get( 'year' );
        $model = request()->get( 'model' );
        $positionId = request()->get( 'position_id' );

        $data = DB::table( 'technologies' )
        ->select( 'id', 'tech_name' )
        ->where( 'position_id', $positionId )
        ->get();

        foreach ( $data as $key => $value ) {
            echo "<button class='tech-button' data-tech-id='" . $value->id . "'>" . $value->tech_name . '</button>\n';
        }
    }

    public function fetchPillars( Request $request ) {
        $technologyId = request()->get( 'id' );

        $query = 'SELECT id, ece FROM pillars WHERE technologies_id = ? ';
        $data = DB::select( $query, array( $technologyId ) );

        if ( !empty( $data ) ) {
            echo '<table border="1" id="pillarTable">';
            echo '<tr><th>ID</th><th>ECE</th><th>linecard_name</th></tr>';
            foreach ( $data as $row ) {
                echo '<tr>';
                echo '<td>' . $row->id . '</td>';
                echo '<td>' . $row->ece . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<script>';
            echo 'var pillarData = ' . json_encode( $data ) . ';';
            echo 'console.log(pillarData);';
            echo '</script>';
        } else {
            echo 'No data found.';
        }
    }

}
