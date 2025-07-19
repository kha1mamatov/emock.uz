<?php

namespace App\Enums;

enum WritingType: string
{
    case Opinion = 'Opinion';
    case Discussion = 'Discussion';
    case ProblemSolution = 'Problem-Solution';
    case AdvantageDisadvantage = 'Advantage-Disadvantage';
    case TwoPart = 'Two-Part';
    case BarChart = 'Bar Chart';
    case LineGraph = 'Line Graph';
    case PieChart = 'Pie Chart';
    case Table = 'Table';
    case Map = 'Map';
    case Process = 'Process';
    case Mixed = 'Mixed';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
