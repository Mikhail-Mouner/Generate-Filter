<?php

namespace MikhailMouner\GenerateFilter\Container;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

abstract class HandlePipelines implements ModelFilterInterface
{
    protected Builder $model_query;
    protected array $pipelines;
    private int $per_page = 0;
    protected int $default_per_page = 15;

    public function __construct()
    {
        $this->setupModelQuery();
        $this->addPipelines();
    }

    public function execute()
    {
        return $this->setupPerPage()->handle();
    }

    public function handle()
    {
        $result = app(Pipeline::class)
            ->send($this->model_query)
            ->through($this->pipelines)
            ->thenReturn();

        if ($this->per_page > 0) {
            return $result->paginate($this->per_page, ['*'], 'page', request('page'))->withQueryString();
        }

        return $result->get();
    }

    public function setupPerPage(): ModelFilterInterface
    {
        $this->per_page = (int)request()->input('per_page', $this->default_per_page);
        return $this;
    }

    abstract public static function apply();

    abstract public function setupModelQuery();

    abstract public function addPipelines();
}
