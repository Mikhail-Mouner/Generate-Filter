<?php

namespace MikhailMouner\GenerateFilter\Console\Commands\Generator;

class FilterModel extends Generator
{
    /**
     * Execute the console command.
     *
     * @param string $name
     * @param string $filter
     * @return array
     */
    public function execute(string $name, string $filter): array
    {

        $filePath = $this->getFilePath($name, $filter);
        $this->makeDirectory(dirname($filePath));

        $contents = $this->getSourceFile($name, $filter);

        return $this->generateFile($filePath, $contents);
    }

    /**
     * Get the stub path and the stub variables
     *
     * @param string $name
     * @param string $filter
     * @return bool|mixed|string
     */
    public function getSourceFile(string $name, string $filter)
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables($name, $filter));
    }

    /**
     * Get the full path of model file
     *
     * @param string $name
     * @param string $filter
     * @return string
     */
    public function getFilePath(string $name, string $filter): string
    {
        return 'app\\Http\\Filters\\' . $this->getClassName($name) . '\\' . $this->getClassName($name) . 'Filter.php';
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @param string $model
     * @param string $filter
     * @return array
     */
    public function getStubVariables(string $model, string $filter): array
    {
        return [
            'MODEL_NAME' => $this->getClassName($model),
            'FILTER_NAME' => $this->getClassName($filter),
        ];
    }

    /**
     * Return the stub file path
     * @return string
     */
    public function getStubPath(): string
    {
        return $this->getStubRootPath() . '/model-filter.stub';
    }
}
