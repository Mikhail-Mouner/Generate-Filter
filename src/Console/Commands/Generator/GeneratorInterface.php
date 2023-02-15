<?php

namespace MikhailMouner\GenerateFilter\Console\Commands\Generator;

interface GeneratorInterface
{
    public function getFilePath(string $name, string $filter): string;

    public function getStubVariables(string $model, string $filter): array;

    public function getStubPath(): string;

}
