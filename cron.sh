#!/bin/bash

cd data
git pull
cd ..
php bin/console app:import-data
