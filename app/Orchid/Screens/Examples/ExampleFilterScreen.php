<?php

namespace App\Orchid\Screens\Examples;

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
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        $all_federations = BoxFederation::pluck('name', 'id');
        return [

            //Federation

            Layout::rows([
                Switcher::make('find-federation')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у федераціях'),
                Select::make('federation')
                    ->options([
                        'all' => 'Всі',
                        ...$all_federations
                    ])
                    ->title('Федерація')
                    ->help('Виберіть із списку федерацію'),

            ])->title('Федерації'),

            //Sportsman

            Layout::rows([
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у спортсменах'),
                Select::make('Спортсмени')
                    ->options([
                        'index' => 'Всі',
                        'noindex' => 'аібва віа іі',
                    ])
                    ->title('Спортсмени')
                    ->help('Allow search bots to index'), // radio


                DateRange::make('rangeDate')
                    ->name('test')
                    ->title('Дата народження'),

            ])->title('Спортсмени'),
            Layout::rows([
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у тренерах'),
                Select::make('select')
                    ->options([
                        'index' => 'Всі',
                        'noindex' => 'аібва віа іі',
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
            ])->title('Тренери'),

            Layout::rows([
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у суддях'),
                DateRange::make('rangeDate')
                    ->name('test')
                    ->title('Дата народження'),
                Select::make('select')
                    ->options([
                        'index' => 'Всі',
                        'noindex' => 'аібва віа іі',
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
            ])->title('Судді'),

            Layout::rows([
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати у спортивних закладах'),

                Select::make('Адреса')
                    ->options([
                        '' => 'Всі',
                        '2' => 'Житомир',
                        '1' => 'Львів',
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
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
                Switcher::make('free-switch')
                    ->sendTrueOrFalse()
                    ->placeholder('Шукати по адресі'),
                Select::make('Адреса')
                    ->options([
                        '' => 'Всі',
                        ...$this->city_arr
                    ])
                    ->title('Select tags')
                    ->help('Allow search bots to index'),
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
