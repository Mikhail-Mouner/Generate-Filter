<?php

namespace MikhailMouner\GenerateFilter\Container;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class AbstractFilter
{
    /**
     * @param $request
     * @param Closure $next
     * @return Builder
     */
    public function handle($request, Closure $next): Builder
    {
        if (is_null(request()->input($this->filterName()))) {
            return $next($request);
        }
        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    /**
     * @return string
     */
    protected function filterName(): string
    {
        return Str::snake(class_basename($this));
    }

    /**
     * @return mixed
     */
    protected function filterValue()
    {
        return request()->input($this->filterName());
    }

    abstract protected function applyFilter(Builder $builder): Builder;
}
