<?php
/**
 * Created by PhpStorm.
 * User: ansilva
 * Date: 17/08/2016
 * Time: 13:24
 */

namespace Andersonef\AvalonAdmin\Abstracts;


use Illuminate\Database\Eloquent\Model;

abstract class ServiceAbstract
{
    protected $model;

    /**
     * Abstract service constructor.
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /** Return a querybuilder representing a query searching for all the models, order by id desc. You can use all items from the querybuilder
     * by calling the get method or paginate them using the paginate method.
     * Usage:
     *  $items = Avalon\ThisFacade::getLastOnes()->paginate(10); //will return 10 items in a paginate object native from laravel.
     *  $items = Avalon\ThisFacade::getLastOnes()->get(); //will return a collection containing all items from this query.
     * @return QueryBuilder
     */
    public function getLastOnes()
    {
        return $this->model->orderBy('id', 'desc');
    }


    /** Return a querybuilder representing a query searching for all the models, order by id asc. You can use all items from the querybuilder
     * by calling the get method or paginate them using the paginate method.
     * Usage:
     *  $items = Avalon\ThisFacade::getFirstOnes()->paginate(10); //will return 10 items in a paginate object native from laravel.
     *  $items = Avalon\ThisFacade::getFirstOnes()->get(); //will return a collection containing all items from this query.
     * @return QueryBuilder
     */
    public function getFirstOnes()
    {
        return $this->model->newQuery()->orderBy('id', 'asc');
    }


    /** Return one model matching the parameter $name.
     * @param $name
     * @return Model|null
     */
    public function find($name)
    {
        return $this->model->newQuery()->where('id','=',$name)->first();
    }


    /**Try to get the first model with all the matched attributes. If it fails, then it will try to create a new one.
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->newQuery()->firstOrCreate($attributes);
    }


    /** Delete a record using its id.
     * @param $id
     * @return bool|mixed|null
     */
    public function destroy($id)
    {
        return $this->model->newQuery()->where('id','=',$id)->first()->delete();
    }


    /** Update a record using its id and an associative array
     * @param $id
     * @param array $data
     * @return int
     */
    public function update($id, array $data)
    {
        return $this->model->newQuery()->where('id','=',$id)->update($data);
    }
}