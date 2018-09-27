<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{	
    /**
     * Display form to input elements
     */
    public function index()
    {
        return view('test');
    }
	
	/**
     * Execute input elements and display subsets
     */
	public function execute(Request $request)
	{
		 if($request->has('_token')) {
			$sum = $request['sum'];  ; //sum
			$filterElements = preg_replace("/[^0-9,]/", "", $request['elements']);
			$elementsArr = explode("," ,$filterElements);
			
			// remove elements from array greater than sum
			$filtered = array_filter($elementsArr, function ($x) use($sum) { return $x < $sum; });
			
			if (!empty($filtered)) {
				// extract all unique subsets
				$list = extract_list($filtered);

				// filter subsets by sum = $sum
				$resultArray = array_filter($list,function($var) use ($sum) { return(array_sum($var) == $sum);});
				
				if (!empty($resultArray)) {
					array_walk($resultArray, function($value){		
					   echo implode($value, ' '). "<br/>";				
					});
				} else {
					echo "There are no subsets available!";
				}
				
			} else {
				echo "Input number below than sum!";
			}
			
		 } else {
			 return redirect('/test');
		 }	
		
	}
}
