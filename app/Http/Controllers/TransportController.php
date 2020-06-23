<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransportResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TransportResource
     */
    public function index()
    {
        //

        $shippinglabels = DB::select(DB::raw(
            "SELECT id, created_at, (select (first_name + ' ' + last_name) from users where id = transport_driver) as driver FROM shipping_labels WHERE created_at >= DATEADD(day, -1, GETDATE()) AND deleted_at IS NULL ORDER BY id DESC"
        ));

        return new TransportResource($shippinglabels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $shippinglabelinfo = DB::select(DB::raw(
            "select b.article_amount,
(SELECT CONCAT((select name from article_groups where id = articles.article_group_id), ' ', inset_limit, ' ', 'x', ' ', inset_gram, ' ', (select name from sort_types where id = articles.sort_type_id), ' ', (select color from insets where id = articles.inset_id), ' ', '(',  excel_code, ')') as article_name
              FROM articles
              WHERE id = b.article_id) as article,
(select name from farmers where id = b.farmer_id) as farmer, b.id
from pallet_label_shipping_label a
JOIN pallet_labels b ON a.pallet_label_id = b.id
where shipping_label_id = '$id' AND deleted_at IS NULL"
        ));

        $shippinglabeldetail = DB::select(DB::raw(
            "select SUM(b.article_amount) as article_amount,
(SELECT CONCAT((select name from article_groups where id = articles.article_group_id), ' ', inset_limit, ' ', 'x', ' ', inset_gram, ' ', (select name from sort_types where id = articles.sort_type_id), ' ', (select color from insets where id = articles.inset_id), ' ', '(',  excel_code, ')') as article_name
              FROM articles
              WHERE id = b.article_id) as article,
(select name from farmers where id = b.farmer_id) as farmer
from pallet_label_shipping_label a
JOIN pallet_labels b ON a.pallet_label_id = b.id
where shipping_label_id = '$id' AND deleted_at IS NULL
group by article_id, farmer_id"
        ));

        $totArr = [
            "totalLabels" => $shippinglabelinfo,
            "detailLabels" => $shippinglabeldetail,
        ];

        return new TransportResource($totArr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
