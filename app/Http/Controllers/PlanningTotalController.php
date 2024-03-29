<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Http\Resources\PlanningTotalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanningTotalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();

        $planningTotal = DB::select( DB::raw("
        WITH DesiredDates AS
            (SELECT CAST(GETDATE() as DATE) AS DesiredDate UNION ALL
             SELECT CAST(DATEADD(dd,1,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,2,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,3,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,4,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,5,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,6,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,7,GETDATE()) as DATE)
            ), DesiredDatesAndSortTypes AS (
            SELECT * FROM DesiredDates CROSS JOIN (SELECT distinct z.sort_type_id as id
              FROM farmer_sort_type z
              where z.farmer_id = '$currentFarmer->id') t
            )
            SELECT SUM(ISNULL(Amount,0)) as Amount, DesiredDate, c.Description
            FROM planning_amounts b
            join (select * from plannings where farmer_id = '$currentFarmer->id' AND deleted_at IS NULL) a ON b.planning_id = a.id
            right join DesiredDatesAndSortTypes ddst ON CAST(a.date as DATE)=ddst.DesiredDate and b.sort_type_id=ddst.id
            join sort_types c ON ddst.id = c.id
			where b.deleted_at IS NULL
            GROUP BY ddst.DesiredDate,c.Description
            ORDER BY DesiredDate,Description"
        ) );

        $totalArr = [];
        $sorts = [];
        $datesArr = [];
        $totalperDate = [];

        if (!sizeof($planningTotal)) {
            return [];
        }

        foreach ($planningTotal as $total){

            if (!isset($totalArr[$total->DesiredDate])) {
                $totalArr[$total->DesiredDate] = [];
            }

            if (!isset($totalArr[$total->Description])) {
                $totalArr[$total->DesiredDate][$total->Description] = 0;
            }
            $totalArr[$total->DesiredDate][$total->Description] += $total->Amount;

            if (!isset($totalArr[$total->DesiredDate]["total"])) {
                $totalArr[$total->DesiredDate]["total"] = 0;
            }
            $totalArr[$total->DesiredDate]["total"] += $total->Amount;

            $totalArr[$total->DesiredDate] += array_splice($totalArr[$total->DesiredDate],array_search('total',array_keys($totalArr[$total->DesiredDate])),1);

            if (!isset($sorts[$total->Description])) {
                $sorts[$total->Description] = $total->Description;
            }

        }
        $totArr = [
            "sorts" => $sorts,
            "planningTotal" => $totalArr
        ];

        return $totArr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array[]
     */
    public function show(Request $request, $id)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();

        $planningTotal = DB::select( DB::raw("
        WITH DesiredDates AS
            (SELECT CAST(GETDATE() as DATE) AS DesiredDate UNION ALL
             SELECT CAST(DATEADD(dd,1,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,2,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,3,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,4,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,5,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,6,GETDATE()) as DATE) UNION ALL
             SELECT CAST(DATEADD(dd,7,GETDATE()) as DATE)
            ), DesiredDatesAndSortTypes AS (
            SELECT * FROM DesiredDates CROSS JOIN (SELECT distinct z.sort_type_id as id
              FROM farmer_sort_type z
              where z.farmer_id = '$id') t
            )
            SELECT SUM(ISNULL(Amount,0)) as Amount, DesiredDate, c.Description
            FROM planning_amounts b
            join (select * from plannings where farmer_id = '$id' AND deleted_at IS NULL) a ON b.planning_id = a.id
            right join DesiredDatesAndSortTypes ddst ON CAST(a.date as DATE)=ddst.DesiredDate and b.sort_type_id=ddst.id
            join sort_types c ON ddst.id = c.id
			where b.deleted_at IS NULL
            GROUP BY ddst.DesiredDate,c.Description
            ORDER BY DesiredDate,Description"
        ) );

        $totalArr = [];
        $sorts = [];
        $datesArr = [];
        $totalperDate = [];

        if (!sizeof($planningTotal)) {
            return [];
        }

        foreach ($planningTotal as $total){

            if (!isset($totalArr[$total->DesiredDate])) {
                $totalArr[$total->DesiredDate] = [];
            }

            if (!isset($totalArr[$total->Description])) {
                $totalArr[$total->DesiredDate][$total->Description] = 0;
            }
            $totalArr[$total->DesiredDate][$total->Description] += $total->Amount;

            if (!isset($totalArr[$total->DesiredDate]["total"])) {
                $totalArr[$total->DesiredDate]["total"] = 0;
            }
            $totalArr[$total->DesiredDate]["total"] += $total->Amount;

            $totalArr[$total->DesiredDate] += array_splice($totalArr[$total->DesiredDate],array_search('total',array_keys($totalArr[$total->DesiredDate])),1);

            if (!isset($sorts[$total->Description])) {
                $sorts[$total->Description] = $total->Description;
            }

        }
        $totArr = [
            "sortsFarmer" => $sorts,
            "planningTotalFarmer" => $totalArr,
            "lastupdate" => date("d-m-Y h:i:s")
        ];

        return $totArr;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
