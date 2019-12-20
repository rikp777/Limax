<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingLabelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        'certificates' => $this->certificateFarmerCode()->with('certificate')->get(),
//        dd(parent::toArray($request));
        $totarray = [];
        $totarray["shippinglabelID"] = parent::toArray($request);

        foreach ($this as $this2) {
//            dd($this2);

            foreach ($this2 as $article) {
//                dd($article);
                $totarray["detail"][] = [
                    'palletlabel_id' => $article["id"],
                    'article_id' => $article["article_id"],
                    'amount' => $article["article_amount"],
                ];
                if (isset($totarray["total"][$article["article_id"]])) {
                    $totarray["total"][$article["article_id"]]['amount'] += $article["article_amount"];
                } else {
                    $totarray["total"][$article["article_id"]] = [
                        'article_id' => $article["article_id"],
                        'amount' => $article["article_amount"],
                    ];
                }
            }

        }

        return $totarray;


//        dd($request);
//        dd(parent::toArray($request));
//        return parent::toArray($request);
//        dd($this);

//        $dataArray = [
//            'total' => array(
//            'article_id' => 'ID VAN ARTICLE',
//            'amount' => 'AMMOUNT TOTAL',
//            ),
//            'detail' => array(
//            'article_id' => 'ARTICLE ID VAN GROUPED ARTICLE',
//            'amount' => 'AMOUNT VAN GROUPED ARTICLE',
//            ),
//         ];
////
//        dd($dataArray);
//        return $dataArray;

//            'amount' => $this->article_amount,
//            'crop_date' => $this->crop_date,
//            'delivery_date' => $this->delivery_date,
//            'note' => $this->note,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at
//        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
        ];
    }
}
