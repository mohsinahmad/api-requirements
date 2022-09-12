<?php

namespace App\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProductFilterCriteria.
 *
 * @package namespace App\Criteria;
 */
class ProductFilterCriteria implements CriteriaInterface
{
    protected $request;

    /**
     * UnitFilterCriteria constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $category = $this->request->get('category','');
        $model = $model->when(($category != ''),function ($query) use ($category) {
            return $query->where('category', $category);
        });

        $price = $this->request->get('price','');
        $model = $model->when(($price != ''),function ($query) use ($price) {
            return $query->where('price', $price);
        });

        $sku = $this->request->get('sku','');
        $model = $model->when(($sku != ''),function ($query) use ($sku) {
            return $query->where('sku', $sku);
        });

        return $model->orderBy('id','ASC');
    }
}
