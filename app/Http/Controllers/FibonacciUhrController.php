<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class FibonacciUhrController extends Controller
{
    private $squares = [1, 1, 2, 3, 5];
    private int $currentCombinationIndex = 0;

    public function showTimeView(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $time = $this->getCurrentTime();
        $representation = $this->getFibonacciRepresentation($time['hours'], $time['minutes']);
        return view('fibonacci_uhr', compact('time', 'representation'));
    }

    public function getCurrentTime(): array
    {
        date_default_timezone_set('Europe/Berlin');
        $currentTime = new DateTime();
        $hours = (int)$currentTime->format('h');
        $minutes = (int)$currentTime->format('i');

        $minutes = floor($minutes / 5) * 5;

        return ['hours' => $hours, 'minutes' => $minutes];
    }

    public function getFibonacciRepresentation($hours, $minutes): array
    {
        $minuteBlocks = $minutes / 5;
        $hourCombinations = $this->getCombinations($hours);
        $minuteCombinations = $this->getCombinations($minuteBlocks);

        $hourCombination = $hourCombinations[$this->currentCombinationIndex % count($hourCombinations)];
        $minuteCombination = $minuteCombinations[$this->currentCombinationIndex % count($minuteCombinations)];
        $this->currentCombinationIndex++;

        $grid = [1 => 'white', 1 => 'white', 2 => 'white', 3 => 'white', 5 => 'white'];

        foreach ($hourCombination as $value) {
            $grid[$value] = 'red';
        }
        foreach ($minuteCombination as $value) {
            if ($grid[$value] === 'red') {
                $grid[$value] = 'blue';
            } else {
                $grid[$value] = 'green';
            }
        }

        return $grid;
    }

    private function getCombinations($number)
    {
        $result = [];
        $this->findCombinations($number, count($this->squares) - 1, [], $result);
        return $result;
    }

    private function findCombinations($sum, $index, $path, &$result)
    {
        if ($sum == 0) {
            $result[] = $path;
            return;
        }
        if ($sum < 0 || $index < 0) {
            return;
        }

        $this->findCombinations($sum - $this->squares[$index], $index - 1, array_merge($path, [$this->squares[$index]]), $result);
        $this->findCombinations($sum, $index - 1, $path, $result);
    }
}