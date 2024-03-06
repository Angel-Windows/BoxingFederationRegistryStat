<?php

namespace App\Orchid\Screens\Examples;

use App\Models\Category\CategoryJudge;
use App\Models\Category\CategorySportsman;
use App\Models\Category\CategoryTrainer;
use App\Models\Category\Operations\TransactionCategory;
use App\Models\Class\BoxFederation;
use App\Models\Employees\EmployeesFederation;
use App\Orchid\Layouts\ChartsLayout;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ExampleElements;
use App\Orchid\Layouts\User\UserEditEddddLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use App\Traits\DataTypeTrait;
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
    use DataTypeTrait;

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
    private function get_sportsman (){

    }

    private array $result_query = [];

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
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

        $more_parameter = [];

        if ($request->filled('find-federation') && $request->input('find-federation') === '1') {

            $federationQuery = BoxFederation::query();

            if ($request->filled('federation') && $request->input('federation') !== 'all') {
                $federationQuery->where('id', $request->input('federation'));
            }

            $federations = $federationQuery->get();
            $return_federation_all_data = ['sportsman' => 0, 'trainer' => 0, 'employees' => 0];

            foreach ($federations as $federation) {
                $sportsman = (new CategorySportsman())->where('federation', $federation->id);
                $trainer = (new CategoryTrainer())->where('federation', $federation->id);
                $employees = (new EmployeesFederation())->where('federation_id', $federation->id);

                //find_sportsman
                if ($request->has('find-sportsman')) {

                    // ID
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
                    if (($request->input('sportsman_gender') != null) && ($sportsman_gender = $request->input('sportsman_gender')) !== 'all') {
                        $sportsman = $sportsman->where('gender', $sportsman_gender);
                    }

                    // Weight Category
                    if (($request->input('sportsman_weight_category') != null) && ($sportsman_weight_category = $request->input('sportsman_weight_category')) !== 'all') {
                        $sportsman = $sportsman->where('weight_category', $sportsman_weight_category);
                    }
                    $sportsman = $sportsman->get();
                    foreach ($sportsman as $item) {

                        //sportsman_weight_category
                        if ($request->input('sportsman_weight_category') === 'all') {
                            if (!array_key_exists('federation_sportsman_weight_category', $more_parameter)) {
                                $more_parameter['federation_sportsman_weight_category'] = [];
                            }
                            if (!array_key_exists($this->DataTypeInputs['weight_category']['option'][$item->weight_category], $more_parameter['federation_sportsman_weight_category'])) {
                                $more_parameter['federation_sportsman_weight_category'][$this->DataTypeInputs['weight_category']['option'][$item->weight_category]] = 0;
                            }
                            ++$more_parameter['federation_sportsman_weight_category'][$this->DataTypeInputs['weight_category']['option'][$item->weight_category]];
                        }

                        //sportsman_gender
                        if ($request->input('sportsman_gender') === 'all') {
                            if (!array_key_exists('federation_sportsman_gender', $more_parameter)) {
                                $more_parameter['federation_sportsman_gender'] = [
                                    'man' => 0,
                                    'woman' => 0,
                                ];
                            }
                            if ($item->gender === 0) {
                                ++$more_parameter['federation_sportsman_gender']['man'];
                            } else {
                                ++$more_parameter['federation_sportsman_gender']['woman'];
                            }
                        }
                    }
                    if (array_key_exists('federation_sportsman_gender', $more_parameter)) {
                        $return_data['federation_sportsman_gender'] = [
                            [
                                'name' => 'federation_sportsman_gender',
                                'values' => [$more_parameter['federation_sportsman_gender']['man'], $more_parameter['federation_sportsman_gender']['woman']],
                                'labels' => ['Чоловіки', 'Жінки'],
                            ],
                        ];
                    }

                    if (array_key_exists('federation_sportsman_weight_category', $more_parameter)) {
                        foreach ($more_parameter['federation_sportsman_weight_category'] as $key => $item) {
                            $return_data['federation_sportsman_weight_category'][] = new Repository([
                                'name' => $key,
                                'value' => $item,
                            ]);
                        }

                    }
                    $sportsmanCount = count($sportsman);
                } else {
                    $sportsmanCount = $sportsman->count();
                }

                // Trainer
                if ($request->has('find-trainer')) {
                    // ID
                    if (($trainer_id = $request->input('trainer_id')) !== 'all') {
                        $trainer = $trainer->where('id', $trainer_id);
                    }

                }
                $trainerCount = $trainer->count();

                $employees = $employees->count();

                if (!$request->has('find-sportsman') && !$request->has('find-trainer') && !$request->has('find-judge')) {
                    $return_data['federation'][] = new Repository([
                        'name' => $federation->name,
                        'sportsman' => $sportsmanCount,
                        'trainer' => $trainerCount,
                        'employees' => $employees
                    ]);

                    $return_federation_all_data['sportsman'] += $sportsmanCount;
                    $return_federation_all_data['trainer'] += $trainerCount;
                    $return_federation_all_data['employees'] += $employees;
                } else {
                    $is_add = true;
                    if ($request->has('find-sportsman') && $sportsmanCount === 0) {
                        $is_add = false;
                    }
                    if ($request->has('find-trainer') && $trainerCount === 0) {
                        $is_add = false;
                    }

                    if ($is_add) {
                        $return_data['federation'][] = new Repository([
                            'name' => $federation->name,
                            'sportsman' => $sportsmanCount,
                            'trainer' => $trainerCount,
                            'employees' => $employees
                        ]);

                        $return_federation_all_data['sportsman'] += $sportsmanCount;
                        $return_federation_all_data['trainer'] += $trainerCount;
                        $return_federation_all_data['employees'] += $employees;
                    }
                }
                $return_data['federation_all'] = [
                    [
                        'name' => 'federation_all',
                        'values' => [$return_federation_all_data['sportsman'], $return_federation_all_data['trainer'], $return_federation_all_data['employees']],
                        'labels' => ['Спортсмени', 'Тренери', 'Працівники'],
                    ],
                ];
            }

        }
        // Judge
        if ($request->filled('find-judge') && $request->input('find-judge') === 'on') {
            $judge = new CategoryJudge;

            if ($request->filled('judge-select_qualification')) {
                if ($request->input('judge-select_qualification') == 'all') {
                    $groupedCategories = $judge->select('qualification', DB::raw('count(*) as total'))
                        ->groupBy('qualification')
                        ->pluck('total', 'qualification');

                    $data = [];
                    foreach ($groupedCategories as $key => $item) {
                        $data[$this->DataTypeInputs['judge_qualification']['option'][$key]] = $item;
                    }

                    $return_data['judge_qualification'] = [
                        [
                            'name' => 'judge_qualification',
                            'values' => array_values($data),
                            'labels' => array_keys($data),
                        ],
                    ];
                } else {
                    $judge = $judge->where('qualification', $request->input('judge-select_qualification'))->get();

                    foreach ($judge as $item) {
                        $return_data['judge'][] = new Repository([
                            'name' => $item->name,
                        ]);
                    }
                }
            } else {
                $judge = $judge->where('qualification', $request->input('judge-select_qualification'))->get();

                foreach ($judge as $item) {
                    $return_data['judge'][] = new Repository([
                        'name' => $item->name,
                    ]);
                }
            }
        }


        return $this->result_query = $return_data;
    }

    /**
     * The name of the screen displayed in the header.
     */
    public
    function name(): ?string
    {
        return 'Результати вибірки';
    }

    /**
     * Display header description.
     */
    public
    function description(): ?string
    {
        return 'Тут показані результати по параметрам які передали на попередній сторінці';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public
    function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public
    function layout(): iterable
    {

        $query = $this->query();
        $return_data = [];

        if (array_key_exists('federation', $query)) {
            $data_add = [
                'top' => [],
                'middle' => [],
                'table' => [],

            ];
            if (array_key_exists('federation_sportsman_gender', $query)) {
                $data_add['top'][] = ChartsLayout::make('federation_sportsman_gender', 'Стать');
            }
            if (array_key_exists('federation_sportsman_weight_category', $query)) {
                $data_add['middle'][] = Layout::accordion([
                    'Вагові категорії' => Layout::table('federation_sportsman_weight_category', [
                        TD::make('name', 'Назва')
                            ->width('auto'),

                        TD::make('value', 'Учасники')
                            ->width('auto'),
                        ...$data_add['table']
                    ])]);
            }
            $return_data[] = Layout::block([
                Layout::split([
                    ChartBarExample::make('federation_all', 'Загальна інформація'),
                    ...$data_add['top']
                ]),
                ...$data_add['middle'],


                Layout::accordion([
                    'Спортсмени' => Layout::table('federation', [
                        TD::make('name', 'Федерація')
                            ->width('auto'),
                        TD::make('sportsman', 'Спортсмени (Ч/Ж)')
                            ->width('auto'),
                        TD::make('trainer', 'Тренери')
                            ->width('auto'),
                        TD::make('employees', 'Учасники')
                            ->width('auto'),
                        ...$data_add['table']
                    ])]),
            ])->vertical()->title('Федерації');
        }

        if (array_key_exists('judge_qualification', $query)) {
            $return_data[] = Layout::block([
                ChartBarExample::make('judge_qualification', 'Список кваліфікацій'),
            ])->vertical()->title('Судді');
        }
        if (array_key_exists('judge', $query)) {
            $return_data[] = Layout::block([
                Layout::accordion([
                    'Судді' => Layout::table('judge', [
                        TD::make('name', 'Федерація')
                            ->width('auto'),
                    ])]),
            ])->vertical()->title('Судді');
        }

        return $return_data;
    }
}
