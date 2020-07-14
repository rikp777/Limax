<?php

namespace App\Http\Resources;

use App\Article;
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
//        dd($this->id);
//        $totarray["shippinglabelID"] = [
//            'id' => $this->id,
//            'transport_date' => $this->transport_date->format('Y-m-d'),
//            'transport_delivery_date' => $this->transport_delivery_date->format('Y-m-d'),
//            'transport_driver' => $this->transport_driver,
//            'created_at' => $this->created_at->toDateTimeString(),
//            'updated_at' => $this->updated_at->toDateTimeString(),
////            'deleted_at' => $this->deleted_at->toDateTimeString(),
//            'user_id' => $this->user_id,
//            'status_id' => $this->status_id,
//            'farmer_id' => $this->farmer_id,
//            'truck_id' =>$this->truck_id,
//            'transport_driver_user_id' =>$this->transport_driver_user_id,
//        ];

        $totarray["shippinglabelID"] = parent::toArray($request);
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
//        $total = ShippingLabel::where('farmer_id', $currentFarmer->id)->latest('id')->get();
        $paginated = ShippingLabel::where('farmer_id', $currentFarmer->id)->latest('id')->paginate(10);

        foreach ($this as $this2) {
//            dd($this2);

            foreach ($this2 as $article) {
//                dd($article);
                foreach ($pallettype as $pallet){
                    if((int)$article["pallet_type_id"] === (int)$pallet["id"]){
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
                } else if ($article["article_id"]){
                    $totarray["total"][$article["article_id"]] = [
                        'article_id' => $article["article_id"],
                        'amount' => $article["article_amount"],
                        'article' => Article::fullName(new ArticleResource(Article::find($article["article_id"])))
                    ];

                }
            }

        }
        if (isset($ptype)){
            $totarray["pallet_types"] = $ptype;
        }
        $totarray["total"] = collect($totarray["total"])->sortBy('article')->reverse()->toArray();
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
