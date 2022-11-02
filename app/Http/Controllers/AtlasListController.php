<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class AtlasListController extends Controller
{
    public function atlasLift(Request $request) {
        try {
            $input = $request->all();
            $input = preg_split('/\r\n|\r|\n/', $input['info']);
            $numberOfContestants = (int)$input[0];
            $contestantsLiftData = array_map('intval', explode(' ', $input[1]));

            if($numberOfContestants != count($contestantsLiftData)) {
                return response()->json([
                    'status' => 0,
                    'msg' => "Number of contestants not same!!"
                ]);
            }
            
            $result = [];
            array_push($result, count($contestantsLiftData));
            sort($contestantsLiftData);
            $contestantsLiftData = array_unique($contestantsLiftData);

            foreach($contestantsLiftData as $key => $value) {
                unset($contestantsLiftData[$key]);
                array_push($result, count(array_unique($contestantsLiftData)));

            }
            return response()->json([
                'status' => 1,
                'response' => $result
            ]);
            
        } catch(Exception $e) {
            return $e;
        }
    }
}
