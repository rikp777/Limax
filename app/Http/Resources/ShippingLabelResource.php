<?php

namespace App\Http\Resources;

use App\Farmer;
use App\ShippingLabel;
use Illuminate\Http\Resources\Json\JsonResource;
use App\PalletType;
use Request as CookieRequest;

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
        $pallettype = pallettype::all();

        $totarray = [];
        $totarray["palletlabelCount"] = sizeof(parent::toArray($request));
        $totarray["shippinglabelID"] = parent::toArray($request);
        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
//        $total = ShippingLabel::where('farmer_id', $currentFarmer->id)->latest('id')->get();
        $paginated = ShippingLabel::where('farmer_id', $currentFarmer->id)->latest('id')->paginate(10);

        foreach ($this as $this2) {
//            dd($this2);

            foreach ($this2 as $article) {
//                dd($article);
                foreach ($pallettype as $pallet){
                    if($article["pallet_type_id"] === $pallet["id"]){
                        if(!isset($ptype[$pallet["description"]])){
                            $ptype[$pallet["description"]] = 0;
                        }
                        $ptype[$pallet["description"]]++;
                    }
                }

                $totarray["detail"][] = [
                    'palletlabel_id' => $article["id"],
                    'palletlabelfarmer_id' => $article["pallet_label_farmer_id"],
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
        if (isset($ptype)){
            $totarray["pallet_types"] = $ptype;
        }

        return $totarray;
//
//        $collectionReturn = [
//            "all" => $totarray,
//            "paginated" => $paginated,
//        ];
//        return $collectionReturn;

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
