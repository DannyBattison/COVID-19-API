<?php

namespace App\Service;

use App\Hydrator\StatisticHydrator;
use App\Repository\RegionRepository;
use App\Repository\StatisticRepository;
use DateTime;

class SearchService
{
    private RegionRepository $regionRepository;
    private StatisticRepository $statisticRepository;
    private StatisticHydrator $statisticHydrator;

    public function __construct(
        RegionRepository $regionRepository,
        StatisticRepository $statisticRepository,
        StatisticHydrator $statisticHydrator
    ) {
        $this->regionRepository = $regionRepository;
        $this->statisticRepository = $statisticRepository;
        $this->statisticHydrator = $statisticHydrator;
    }

    public function retrieveData(?DateTime $datetime = null)
    {
        if (!$datetime) {
            $datetime = $this->statisticRepository->getLatestDataDate();
        }

        $statistics = $this->regionRepository->getStatisticsForDate($datetime);

        return array_map(function (array $statistic) {
            return $this->statisticHydrator->hydrate($statistic);
        }, $statistics);
    }
}
