<?php


namespace App\Filters;


use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;
    /** @var Builder */
    protected $builder;
    /** @var array  */
    protected $filters = ['by'];


    /**
     * ThreadsFilter constructor.
     * @param \Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }

}
