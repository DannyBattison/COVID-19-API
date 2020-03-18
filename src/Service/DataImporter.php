<?php

namespace App\Service;

use App\Dto\CsvRow;
use App\Hydrator\CsvRowHydrator;
use App\Repository\CountryRepository;
use App\Repository\ImportLogRepository;
use App\Repository\RegionRepository;
use App\Repository\StatisticRepository;
use League\Csv\Reader;
use League\Csv\Statement;

class DataImporter
{
    private CsvRowHydrator $csvRowHydrator;
    private CountryRepository $countryRepository;
    private RegionRepository $regionRepository;
    private StatisticRepository $statisticRepository;
    private ImportLogRepository $importLogRepository;

    public function __construct(
        CsvRowHydrator $csvRowHydrator,
        CountryRepository $countryRepository,
        RegionRepository $regionRepository,
        StatisticRepository $statisticRepository,
        ImportLogRepository $importLogRepository
    )
    {
        $this->csvRowHydrator = $csvRowHydrator;
        $this->countryRepository = $countryRepository;
        $this->regionRepository = $regionRepository;
        $this->statisticRepository = $statisticRepository;
        $this->importLogRepository = $importLogRepository;
    }
    public function importFile(string $path): void
    {
        if ($this->importLogRepository->findOneBy(['name' => basename($path)])) {
            return;
        }

        $statistics = $this->getRecords($path);

        foreach ($statistics as $statistic) {
            $this->importStatistic($statistic);
        }

        $this->recordFileImported($path);
    }

    private function getRecords(string $path): array
    {
        $reader = Reader::createFromPath($path);

        $reader->setHeaderOffset(0);
        $records = Statement::create()->process($reader);

        $rows = [];
        foreach($records as $record) {
            $rows[] = $this->csvRowHydrator->hydrate($record);
        }

        return $rows;
    }

    private function importStatistic(CsvRow $csvRow): void
    {
        $country = $this->countryRepository->findOrCreate($csvRow->getCountry());

        $region = $this->regionRepository->findOrCreate(
            $country,
            $csvRow->getRegion(),
            $csvRow->getLatitude(),
            $csvRow->getLongitude()
        );

        $this->statisticRepository->create(
            $region,
            $csvRow->getDatetime(),
            $csvRow->getConfirmed(),
            $csvRow->getDeaths(),
            $csvRow->getRecovered()
        );
    }

    private function recordFileImported(string $path)
    {
        $this->importLogRepository->create(basename($path));
    }
}
