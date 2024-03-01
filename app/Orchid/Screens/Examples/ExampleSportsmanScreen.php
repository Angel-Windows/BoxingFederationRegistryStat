<?php

namespace App\Orchid\Screens\Examples;

use App\Models\Category\CategorySportsman;
use App\Orchid\Layouts\ChartsLayout;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use App\Orchid\Layouts\Examples\ChartPercentageExample;
use App\Orchid\Layouts\Examples\ChartPieExample;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ExampleSportsmanScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $sportsmen_gender = CategorySportsman::select('gender', DB::raw('count(*) as total'))->groupBy('gender')->pluck('total', 'gender')->toArray();$sportsmen_age = CategorySportsman::select(
        DB::raw('YEAR(CURRENT_DATE) - YEAR(birthday) - (DATE_FORMAT(CURRENT_DATE, "%m%d") < DATE_FORMAT(birthday, "%m%d")) as age')
    )
        ->orderBy('birthday', 'desc')
        ->get();

        $grouped_by_age = $sportsmen_age->groupBy(function ($item) {
            $age = $item->age;
            if ($age >= 0 && $age <= 6) {
                return '0-6';
            } elseif ($age <= 15) {
                return '7-15';
            } elseif ($age <= 25) {
                return '16-25';
            } elseif ($age <= 45) {
                return '26-45';
            }elseif ($age <= 55) {
                return '46-55';
            }elseif ($age <= 65) {
                return '56-65';
            } else {
                return '45+';
            }
        })->map(function ($group) {
            return $group->count();
        });


        return [
            'gender' => [
                [
                    'name' => 'gender',
                    'values' => $sportsmen_gender,
                    'labels' => ['Чоловіки', 'Жінки'],
                ],
            ],

            'age' => [[
                'values' => $grouped_by_age->values()->toArray(), // Получаем только значения (количество спортсменов)
                'labels' => $grouped_by_age->keys()->toArray(), // Получаем только метки (группы возрастов)
            ]],
            'charts' => [
                [
                    'name' => 'Some Data',
                    'values' => [25, 40, 30, 35, 8, 52, 17],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name' => 'Another Set',
                    'values' => [25, 50, -10, 15, 18, 32, 27],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name' => 'Yet Another',
                    'values' => [15, 20, -3, -15, 58, 12, -17],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name' => 'And Last',
                    'values' => [10, 33, -8, -3, 70, 20, -34],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Charts';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'A comprehensive guide to creating and customizing various types of charts, including bar, line, and pie charts.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     * @throws \Throwable
     *
     */
    public function layout(): iterable
    {
        return [
            Layout::split([
                ChartsLayout::make('gender', 'Стать'),
                ChartBarExample::make('age', 'Графік віку'),
            ])->ratio('40/60'),



            ChartLineExample::make('charts', 'Actions with a Tweet')
                ->description('The total number of interactions a user has with a tweet. This includes all clicks on any links in the tweet (including hashtags, links, avatar, username, and expand button), retweets, replies, likes, and additions to the read list.'),

            Layout::columns([
                ChartLineExample::make('charts', 'Line Chart')
                    ->description('Visualize data trends with multi-colored line graphs.'),
                ChartBarExample::make('charts', 'Bar Chart')
                    ->description('Compare data sets with colorful bar graphs.'),
            ]),

            Layout::columns([
                ChartPercentageExample::make('charts', 'Percentage Chart')
                    ->description('Display data as visually appealing and modern percentage graphs.'),

                ChartPieExample::make('charts', 'Pie Chart')
                    ->description('Break down data into easy-to-understand pie graphs with modern design.'),
            ]),
        ];
    }
}
