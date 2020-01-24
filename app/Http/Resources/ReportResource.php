<?php

namespace App\Http\Resources;

use App\Article;
use App\Farmer;
use App\PalletLabel;
use App\SortType;
use Illuminate\Http\Resources\Json\JsonResource;
use Request as CookieRequest;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
        $article = article::all();
        $palletlabels = PalletLabel::where('farmer_id', $currentFarmer->id)->where('crop_date', '2020-01-22')->get();
        $sorts = SortType::all();
//        dd($article);


        $palletweight = 0;
        foreach ($palletlabels as $pallet) {

            $articleid = $pallet["article_id"];
            foreach ($article as $index => $art) {

                $artSortType = $art["sort_type_id"];
                foreach ($sorts as $sort) {

                    if ($articleid === $art["id"]) {
                        $indexes[] = $index;
                        $palletweight += ($art["inset_gram"] * $pallet["article_amount"]);

                        $sortid = $sort["id"];
                        if ($artSortType === $sortid) {
                            $sortDesc = $sort["description"];
                            if (!isset($uniqueSort[$sortDesc])) {
                                $uniqueSort[$sortDesc] = 0;
                            }
                            $uniqueSort[$sortDesc] += round(($art["inset_gram"] * $pallet["article_amount"]) / 1000, 2);

                        }

                    }

                }


            }

        }
        $totalpallets = sizeof($palletlabels);
        $avgpalletweight = round(($palletweight / sizeof($palletlabels)) / 1000, 2);
        $totalpalletweight = round(($palletweight) / 1000, 2);
        $sortChartArr = $uniqueSort;

        $totArr = [
            "totalpallets" => $totalpallets,
            "avgpalletweight" => $avgpalletweight,
            "totalpalletweight" => $totalpalletweight,
            "sortchartarr" => $sortChartArr,
        ];

        return $totArr;

    }

}
