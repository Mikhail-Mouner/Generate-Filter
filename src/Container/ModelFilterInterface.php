<?php

namespace MikhailMouner\GenerateFilter\Container;

interface ModelFilterInterface
{
    public static function apply();

    public function execute();

    public function setupModelQuery();

    public function addPipelines();

    public function handle();

    public function setupPerPage();
}
