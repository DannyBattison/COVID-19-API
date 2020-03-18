<?php

namespace App\Command;

use App\Service\DataImporter;
use DirectoryIterator;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportData extends Command
{
    public const DATA_DIR = './data/csse_covid_19_data/csse_covid_19_daily_reports/';

    protected static $defaultName = 'app:import-data';

    private DataImporter $dataImporter;

    public function __construct(DataImporter $dataImporter)
    {
        parent::__construct();
        $this->dataImporter = $dataImporter;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $directory = new DirectoryIterator(self::DATA_DIR);
        foreach ($directory as $file) {
            if ($file->isDot() || substr($file->getRealPath(), -3, 3) !== 'csv') {
                continue;
            }

            $this->dataImporter->importFile($file->getRealPath());
        }
    }
}
