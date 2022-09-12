<?php

namespace App\Http\Controllers\api;

use App\Criteria\ProductFilterCriteria;
use App\Data\Repositories\ProductRepository;
use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;

class ProductController extends BaseApiController
{

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param ProductRepository $productRepo
     */
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws RepositoryException
     */
    public function index(Request $request)
    {
        $data = $this->productRepository->resetCriteria()->pushCriteria(new ProductFilterCriteria($request))->paginate($request->limit);
        return $this->sendResponse($data, __('messages.responses.success'));
    }
}
