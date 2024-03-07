<?php

namespace App\Orchid\Screens\Examples;

use App\Models\Category\CategoryJudge;
use App\Models\Category\CategorySportsman;
use App\Models\Category\CategoryTrainer;
use App\Models\Class\BoxFederation;
use App\Orchid\Layouts\Examples\ExampleElements;
use App\Orchid\Layouts\User\UserEditEddddLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use App\Traits\DataTypeTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ExampleFilterScreen extends Screen
{
    use DataTypeTrait;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'name' => 'Hello! We collected all the fields in one place',
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Вибірка';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Введіть фільтри для вибірки';
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
     * @return \Orchid\Screen\Layout[]|string[]
     */
    private function combinedArray($all_array): array
    {
        $options = ['all' => 'Всі'];
        foreach ($all_array as $id => $name) {
            $options[$id] = $name;
        }
        return $options;
    }

    public function layout(): iterable
    {
        $weight_category = [];
        foreach ($this->DataTypeInputs['weight_category']['option'] as $key=>$dataTypeInput) {
            if ($dataTypeInput != 'Title'){
                $weight_category[$key] = $dataTypeInput;
            }
        }

        $all_federations = BoxFederation::pluck('name', 'id')->toArray();
        $all_sportsman = CategorySportsman::pluck('name', 'id')->toArray();
        $all_trainer = CategoryTrainer::pluck('name', 'id')->toArray();
        $all_judge = CategoryJudge::pluck('name', 'id');


        return [

            //Federation

            Layout::rows([
                Switcher::make('find-federation')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у федераціях'),
                Select::make('federation')
                    ->options(
                        $this->combinedArray($all_federations)
                    )
                    ->title('Федерація')
                    ->help('Виберіть із списку федерацію'),

            ])->title('Федерації'),

            //Sportsman

            Layout::rows([
                Switcher::make('find-sportsman')
                    ->placeholder('Шукати у спортсменах'),
                Select::make('sportsman_id')
                    ->options($this->combinedArray($all_sportsman))
                    ->title('Спортсмени')
                    ->help('Allow search bots to index'),

                DateRange::make('sportsman_birthday')
                    ->title('Дата народження'),

                Select::make('sportsman_gender')
                    ->options([
                            null => 'Без фільтру',
                            'all' => 'Всі',
                            '0' => 'Чоловіки',
                            '1' => 'Жінки',
                        ]
                    )
                    ->title('Фільтр по статі')
                    ->help('Виберіть із списку параметр'),
                Select::make('sportsman_weight_category')
                    ->options([
                            'all' => 'Всі',
                            ...$weight_category
                        ]
                    )
                    ->empty('Без фільтру')
                    ->title('Фільтр по ваговій категорії')
                    ->help('Виберіть із списку параметр'),
            ])->title('Спортсмени'),

            // Trainer

            Layout::rows([
                Switcher::make('find-trainer')
                    ->placeholder('Шукати у тренерах'),
                Select::make('trainer_id')
                    ->options($this->combinedArray($all_trainer))
                    ->title('Тренер')
                    ->help('Виберіть зі списку тренера'),
                Select::make('trainer_qualification')
                    ->options($this->combinedArray($this->DataTypeInputs['trainer_qualification']['option']))
                    ->title('Кваліфікація')
                    ->help('Виберіть зі списку кваліфікацію'),
            ])->title('Тренери'),

            // Judge
            Layout::rows([
                Switcher::make('find-judge')
                    ->placeholder('Шукати у суддях'),

                Select::make('judge-select_qualification')
                    ->options(
                        $this->combinedArray($this->DataTypeInputs['judge_qualification']['option'])
                    )
                    ->empty('Без фільтру')
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
            ])->title('Судді'),

            // Sports Institutions
            Layout::rows([
                Switcher::make('find-sports_institution')
                    ->placeholder('Шукати у спортивних закладах'),

            ])->title('Спортивні заклади'),

            Layout::rows([
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у страхових компаніях'),

                Select::make('Адреса')
                    ->options([
                        '' => 'Всі',
                        '2' => 'Житомир',
                        '1' => 'Львів',
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
            ])->title('Страхові компанії'),


            Layout::rows([
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у медичних закладах'),

                Select::make('Адреса')
                    ->options([
                        '2' => 'Всі',
                        '2' => '3',
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
            ])->title('Медичні заклади'),


            Layout::rows([

                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у навчальних закладах'),

                Select::make('Адреса')
                    ->options([
                        '' => 'Всі',
                        '2' => 'Житомир',
                        '1' => 'Львів',
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
            ])->title('Навчальні заклади'),


            Layout::rows([
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у фанах'),

                Select::make('Адреса')
                    ->options([
                        '' => 'Всі',
                        '2' => 'Житомир',
                        '1' => 'Львів',
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
            ])->title('Фани'),


            Layout::rows([
                Switcher::make('find-city')
                    ->placeholder('Шукати по адресі'),
                Select::make('city-id')
                    ->options($this->combinedArray($this->city_arr))
                    ->title('Select tags')
                    ->help('Виберіть адесу із списку'),
            ])->title('Адреса'),

            Layout::rows([

                Button::make(__('Дізнатись'))
                    ->type(Color::BASIC())
                    ->turbo(false)
                    ->icon('bs.check-circle')
                    ->method('filter-result'),
            ]),
        ];
    }



//    public function buttonClickTest(Request $request)
//    {
//        dd($request->input());
//
////        $request->validate([
////            'user.name'  => 'required|string',
////            'user.email' => [
////                'required',
////                Rule::unique(User::class, 'email')->ignore($request->user()),
////            ],
////        ]);
////        Route::screen('/examples/filter', ExampleFilterScreen::class)->name('platform.example.filter');
//        return view('welcome');
////        Alert::info('Судді: 13, \n ');
////        Toast::info(__('Profile updated.'));
//
//    }

}
