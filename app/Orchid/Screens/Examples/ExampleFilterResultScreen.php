<?php

namespace App\Orchid\Screens\Examples;

use App\Models\Category\CategorySportsman;
use App\Models\Class\BoxFederation;
use App\Orchid\Layouts\ChartsLayout;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ExampleElements;
use App\Orchid\Layouts\User\UserEditEddddLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\NoReturn;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ExampleFilterResultScreen extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $sportsmen_city = CategorySportsman::select('address')->get();

        $city_arr = [
            "Київ",
            "Харків",
            "Одеса",
            "Дніпро",
            "Донецьк",
            "Запоріжжя",
            "Львів",
            "Кривий Ріг",
            "Миколаїв",
            "Маріуполь",
            "Вінниця",
            "Полтава",
            "Чернігів",
            "Черкаси",
            "Житомир",
            "Суми",
            "Рівне",
            "Кам'янець-Подільський",
            "Луцьк",
            "Кременчук",
            "Івано-Франківськ",
            "Тернопіль",
            "Херсон",
            "Чернівці",
            "Кропивницький",
            "Мелітополь",
            "Бердянськ",
        ];
        $table_city = [];
        $grouped_by_city = $sportsmen_city->map(function ($item) use ($city_arr, &$table_city) {
            $cityId = json_decode($item->address)->city;
            if (isset($city_arr[$cityId])) {
                return $city_arr[$cityId];
            } else {
                return "Unknown";
            }
        })->groupBy(function ($cityName) {
            return $cityName;
        })->map(function ($group) {
            return $group->count();
        })->toArray();
        foreach ($grouped_by_city as $key => $item) {

            $table_city[] = new Repository(['city' => $key, 'name' => $item]);

        }
//        dd($data, $grouped_by_city, $city_arr);
        $sportsmen_gender = CategorySportsman::select('gender', DB::raw('count(*) as total'))->groupBy('gender')->pluck('total', 'gender')->toArray();
        $sportsmen_age = CategorySportsman::select(
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
            } elseif ($age <= 55) {
                return '46-55';
            } elseif ($age <= 65) {
                return '56-65';
            } else {
                return '45+';
            }
        })->map(function ($group) {
            return $group->count();
        });
//
        return [
            'city' => [
                [
                    'name' => 'city',
                    'values' => array_values($grouped_by_city),
                    'labels' => array_keys($grouped_by_city),
                ],
            ],
            'gender' => [
                [
                    'name' => 'gender',
                    'values' => $sportsmen_gender,
                    'labels' => ['Чоловіки', 'Жінки'],
                ],
            ],

            'age' => [[
                'values' => $grouped_by_age->values()->toArray(),
                'labels' => $grouped_by_age->keys()->toArray(),
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
            'table' => $table_city,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Результати вибірки';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Тут показані результати по параметрам які передали на попередній сторінці';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    #[NoReturn] public function layout(): iterable
    {
        $request = request();
        if ($request->has('find-federation') && $request->input('find-federation') === '1') {
            $federation = new BoxFederation();
            if ($request->has('federation') && $federation_id = $request->input('federation') !== 'all') {
                $federation = $federation->where('id', $federation_id);
            }
        }
        dd($request->input());
        return [

            Layout::split([
                ChartsLayout::make('gender', 'Стать'),
                ChartBarExample::make('age', 'Графік віку'),
            ])->ratio('40/60'),


            ChartBarExample::make('city', 'Графік городів'),

            Layout::table('table', [
                TD::make('city', 'Город')
                    ->width('450'),
                TD::make('name', 'Кількість')
                    ->width('450'),
            ]),
        ];
    }
}
