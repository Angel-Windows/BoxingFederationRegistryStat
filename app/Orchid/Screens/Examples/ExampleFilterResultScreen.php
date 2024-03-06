<?php

namespace App\Orchid\Screens\Examples;

use App\Models\Category\CategorySportsman;
use App\Models\Category\CategoryTrainer;
use App\Models\Class\BoxFederation;
use App\Models\Employees\EmployeesFederation;
use App\Orchid\Layouts\ChartsLayout;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ExampleElements;
use App\Orchid\Layouts\User\UserEditEddddLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
use Illuminate\Support\Facades\Session;

class ExampleFilterResultScreen extends Screen
{
    public function __construct()
    {

    }

    public function handle(Request $request, ...$arguments)
    {
        return parent::handle($request, ...$arguments);
//        if ($request->filled('find-federation')) {
//            return parent::handle($request, ...$arguments);
//        }
//
//        return Redirect::route('platform.example.filter');
    }

    private array $result_query = [];

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query()
    {
//        dump(Cache::get('request_filter'));
        if ($this->result_query) {
            return $this->result_query;
        }
        $return_data = [];
        $request = request();
        if (!count($request->input())) {
            $cached_data = Cache::get('request_filter');

            if ($cached_data !== null) {
                $request = new Request($cached_data);
            }
        } else {
            Cache::delete('request_filter');
            Cache::remember('request_filter', 10000, static function () use ($request) {
                return $request->input();
            });
        }

        $more_parameter = [
            'federation_sportsman_gender' => ['man' => 0, 'woman' => 0],
            'federation_sportsman_weight_category' => 0,
        ];

        if ($request->filled('find-federation') && $request->input('find-federation') === '1') {

            $federationQuery = BoxFederation::query();

            if ($request->filled('federation') && $request->input('federation') !== 'all') {
                $federationQuery->where('id', $request->input('federation'));
            }

            $federations = $federationQuery->get();
            $return_federation_all_data = ['sportsman' => 0, 'trainer' => 0, 'employees' => 0];

            foreach ($federations as $federation) {
                $sportsman = new CategorySportsman();
                if ($request->has('find-sportsman')) {

                    // Sportsman ID
                    if (($sportsman_id = $request->input('sportsman_id')) !== 'all') {
                        $sportsman = $sportsman->where('id', $sportsman_id);
                    }

                    // Birthday
                    if ($request->has('sportsman_birthday')) {
                        $sportsman_date = $request->input('sportsman_birthday');

                        $start_date = $sportsman_date['start'] ?? null;
                        $end_date = $sportsman_date['end'] ?? null;

                        if ($start_date && $end_date) {
                            $sportsman = $sportsman->whereBetween('birthday', [$start_date, $end_date]);
                        } elseif ($start_date) {
                            $sportsman = $sportsman->where('birthday', '>=', $start_date);
                        } elseif ($end_date) {
                            $sportsman = $sportsman->where('birthday', '<=', $end_date);
                        }
                    }

                    // Gender
                    if ($request->input('sportsman_gender') != null) {
                        if (($sportsman_gender = $request->input('sportsman_gender')) !== 'all') {
                            $sportsman = $sportsman->where('gender', $sportsman_gender);
                        } else {
                            $find_gender = true;
                            $count_man = (clone $sportsman)->where('federation', $federation->id)->where('gender', 0)->count();
                            $count_woman = (clone $sportsman)->where('federation', $federation->id)->where('gender', 1)->count();
                            $more_parameter['federation_sportsman_gender']['man'] += $count_man;
                            $more_parameter['federation_sportsman_gender']['woman'] += $count_woman;
                            $count_text_gender = $count_man . ' / ' . $count_woman;
                        }
                    }

                    // Weight Category
                    if ($request->input('sportsman_weight_category') != null) {
                        $sportsman = $sportsman->where('weight_category', $request->input('sportsman_weight_category'));
                        $count_weight_category = (clone $sportsman)->where('federation', $federation->id)->where('weight_category',  $request->input('sportsman_weight_category'))->count();
                        $more_parameter['federation_sportsman_weight_category'] += $count_weight_category;
                    }

                }

                $sportsmanCount = $find_gender ?? $sportsman->where('federation', $federation->id)->count();
                $trainerCount = CategoryTrainer::where('federation', $federation->id)->count();
                $employees = EmployeesFederation::where('federation_id', $federation->id)->count();

                if (!($request->has('find-sportsman') && $sportsmanCount === 0)) {
                    $return_data['federation'][] = new Repository([
                        'name' => $federation->name,
                        'sportsman' => $count_text_gender ?? $sportsmanCount,
                        'trainer' => $trainerCount,
                        'employees' => $employees
                    ]);

                    $return_federation_all_data['sportsman'] += $sportsmanCount;
                    $return_federation_all_data['trainer'] += $trainerCount;
                    $return_federation_all_data['employees'] += $employees;
                }
            }
            if ($request->has('sportsman_gender') && $request->input('sportsman_gender') === 'all') {
                $return_data['federation_sportsman_gender'] = [
                    [
                        'name' => 'federation_sportsman_gender',
                        'values' => [$more_parameter['federation_sportsman_gender']['man'], $more_parameter['federation_sportsman_gender']['woman']],
                        'labels' => ['Чоловіки', 'Жінки'],
                    ],
                ];
            }
            $return_data['federation_all'] = [
                [
                    'name' => 'federation_all',
                    'values' => [$return_federation_all_data['sportsman'], $return_federation_all_data['trainer'], $return_federation_all_data['employees']],
                    'labels' => ['Спортсмени', 'Тренери', 'Працівники'],
                ],
            ];
        }
//        dd($more_parameter, $request->input('sportsman_weight_category'));

        return $this->result_query = $return_data;
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
    public function layout(): iterable
    {

        $query = $this->query();
        $return_data = [];


        if (array_key_exists('federation', $query)) {

            if (array_key_exists('federation_sportsman_gender', $query)) {
                $return_data[] =
                    Layout::block([
                        Layout::split([
                            ChartBarExample::make('federation_all', 'Загальна інформація'),
                            ChartsLayout::make('federation_sportsman_gender', 'Стать'),
                        ]),

                        Layout::accordion([
                            'Розгорнути' => Layout::table('federation', [
                                TD::make('name', 'Федерація')
                                    ->width('auto'),
                                TD::make('sportsman', 'Спортсмени (Ч/Ж)')
                                    ->width('auto'),
                                TD::make('trainer', 'Тренери')
                                    ->width('auto'),
                                TD::make('employees', 'Учасники')
                                    ->width('auto'),
                            ])]),
                    ])->vertical()->title('Федерації');

            } else {

                $return_data[] =
                    Layout::block([
                        ChartsLayout::make('federation_all', 'Загальна інформація'),
                        Layout::accordion([
                            'Розгорнути' => Layout::table('federation', [
                                TD::make('name', 'Федерація')
                                    ->width('auto'),
                                TD::make('sportsman', 'Спортсмени')
                                    ->width('auto'),
                                TD::make('trainer', 'Тренери')
                                    ->width('auto'),
                                TD::make('employees', 'Учасники')
                                    ->width('auto'),
                            ])]),
                    ])->vertical()->title('Федерації');
            }

        }
        return $return_data;
    }
}
