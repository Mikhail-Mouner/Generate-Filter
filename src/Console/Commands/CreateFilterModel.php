<?php

namespace MikhailMouner\GenerateFilter\Console\Commands;

use Illuminate\Console\Command;
use MikhailMouner\GenerateFilter\Console\Commands\Generator\FilterModel;

class CreateFilterModel extends Command
{
    protected $signature = 'filter:model {model}  {--filters=*}';

    protected $description = 'Create Model Filter';

    protected $type = 'Filter Model';

    private FilterModel $pipeline;

    /**
     * Create a new command instance.
     *
     */
    public function __construct(FilterModel $pipeline)
    {
        parent::__construct();
        $this->pipeline = $pipeline;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $model = $this->argument('model');
        $filter = $this->hasOption('filters') ? implode('::class,', $this->option('filters')) : '';

        list($type, $message) = $this->pipeline->execute($model, $filter);
        $this->$type($message);
        $this->createFilters();
    }

    private function createFilters()
    {
        if ($this->hasOption('filters')) {
            foreach ($this->option('filters') as $filter) {
                $this->call('filter:class', ['filter' => $filter, 'model' => $this->argument('model')]);
            }
        }
    }


}
