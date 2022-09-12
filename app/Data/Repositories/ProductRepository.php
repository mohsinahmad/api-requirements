<?php

namespace App\Data\Repositories;

use App\Data\Models\ProductModel;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException as ValidatorExceptionAlias;

/**
 * Class SampleRepository
 * @package App\Data\Repositories
 */
class ProductRepository extends BaseRepository
{
    /**
     * @return string
     */
    function model()
    {
        return ProductModel::class;
    }

    /**
     * @param $data
     * @return mixed
     * @throws ValidatorExceptionAlias
     */
    public function createRecord($data)
    {
        $sample = $this->create($data);
        return $sample;
    }

    /**
     * @param $data
     * @param $model
     * @return mixed
     * @throws ValidatorExceptionAlias
     */
    public function updateRecord($data)
    {
        $this->update($data, (int)$data['id']);
        return $data;
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteRecord($id)
    {
        return $this->model->find($id)->delete();
    }
}
