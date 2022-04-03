<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


/**
 ***************************************************
 * Controller 勤務条件
 ***************************************************
*/
class WorkingConditionController extends Controller
{
    /**
     * 勤務条件一覧(list)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function list()
    {
        /*
         # 勤務地
         $location_radions[0]->todohukens[0]->shichosons[0]->kus[0] ('地域'->'都道府県'->'市町村'->'区')
        */
        $location_radions =\App\Models\WorkingConditionLocation01Redion::all();

        /*
         # 職種
         $occupation_group01s[0]->group02s[0]->items[0]
        */
        $occupation_group01s = \App\Models\WorkingConditionOccupation01Group01::all();

        /*
         # 業種
         $industry_groups[0]->items[0]
        */
        $industry_groups = \App\Models\WorkingConditionIndustry01Group::all();

        /*
         # 駅(路線)
         $train_companies[0]->lines[0]->stations
        */
        $train_companies =
        \App\Models\WorkingConditionTrain01Company::where('todohuken_code','00')->get();

        /*
         # その他条件
         $other_groups[0]->items[0]
        */
        $other_groups = \App\Models\WorkingConditionOther01Group::all();



        # Viewの表示
        return view('working_condition.list',compact(
            'location_radions','occupation_group01s','industry_groups','train_companies','other_groups'
        ));
    }



    /**
     * ----------------------------------------------------
     *  勤務条件API
     * ----------------------------------------------------
     * @return Json
    */
    # 勤務地API(location_api)
    public function location_api()
    {
        return response()->json([
            'location_api' => 'ok',
            'location_radions' => \App\Models\WorkingConditionLocation01Redion::forApi(),
        ]);
    }

    # 職種API(occupation_api)
    public function occupation_api()
    {
        return response()->json([
            'occupation_api' => 'ok',
            'occupation_group01s' => \App\Models\WorkingConditionOccupation01Group01::forApi(),
        ]);
    }

    # 業種API(industry_api)
    public function industry_api()
    {
        return response()->json([
            'industry_api' => 'ok',
            'industry_groups' => \App\Models\WorkingConditionIndustry01Group::forApi(),
        ]);
    }

    # 駅API(train_api)
    public function train_api()
    {
        return response()->json([
            'train_api' => 'ok',
            'location_radions' => \App\Models\WorkingConditionLocation01Redion::forTrainApi(),
            // 'train_companys' => \App\Models\WorkingConditionTrain01Company::forApi('00'),
        ]);

    }

    # その他条件API(other_api)
    public function other_api()
    {
        return response()->json([
            'other_api' => 'ok',
            'other_groups' => \App\Models\WorkingConditionOther01Group::forApi(),
        ]);
    }


}
