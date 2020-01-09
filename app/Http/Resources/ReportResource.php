<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        $totarray = [];
        $totarray["data"] = parent::toArray($request);

        foreach ($this as $this2) {
//            dd($this2);

            foreach ($this2 as $report) {
//                dd($article);
                $totarray["detail"][] = [
                    'palletlabel_id' => $report["id"],
                    'article_id' => $report["article_id"],
                    'amount' => $report["article_amount"],
                ];
                if (isset($totarray["total"][$report["article_id"]])) {
                    $totarray["total"][$report["article_id"]]['amount'] += $report["article_amount"];
                } else {
                    $totarray["total"][$report["article_id"]] = [
                        'article_id' => $report["article_id"],
                        'amount' => $report["article_amount"],
                    ];
                }
            }

        }

        return $totarray;
    }

}
