<?php

namespace App\Traits;


trait DataTypeTrait
{
    public array $data_option = [
        'employees_federation' => [
            'position' => [
                'Президент ',
                'Перший віце-президент',
                'Генеральний секретар',
                'Головний секретар ',
                'Секретар',
                'Віце-президент',
                'Юрист',
                'Радник президента',
                'Голова суддівської комісії',
                'Голова медичної комісії',
                'Голова ревізійної комісії',
                'Суддя-рефері',
                'Юний спортивний суддя',
                'Спортивний суддя другої категорії',
                'Спортивний суддя першої категорії',
                'Спортивний суддя Національної категорії',
                'Головний тренер',
                'Тренер ',
                'Тренер-викладач',
                'Тренер - лікар',
                'Тренер - масажист',
                'Тренер - вихователь',
                'Старший тренер-викладач ',
                'Державний тренер збірної команди України з боксу',
                'Провідний тренер збірної команди України з боксу',
                'Начальник збірної команди України з боксу',
                'Старший тренер збірної команди України з боксу з науково- методичного забезпечення',
                'Головний тренер збірної команди України з боксу серед чоловіків',
                'Головний тренер збірної команди України з боксу серед жінок',
                'Старший тренер збірної команди України з боксу серед чоловіків до 22 років',
                'Старший тренер збірної команди України з боксу серед молоді (чоловіки)',
                'Старший тренер збірної команди України з боксу серед молоді (жінки)',
                'Старший тренер збірної команди України з боксу серед юніорів',
                'Старший тренер збірної команди України з боксу серед юніорок',
                'Старший тренер збірної команди України з боксу серед юнаків',
                'Старший тренер збірної команди України з боксу серед дівчат',
            ]
        ],
        'employees_sports_institutions' => [
            'position' => [
                'Директор ',
                'Заступник директора з навчально-тренувальної роботи ',
                'Заступник директора з адміністративно-господарської роботи ',
                'Завідувач спортивного комплексу ',
                'Завідувач господарства ',
                'Завідувач складу',
                'Головний тренер',
                'Тренер ',
                'Тренер-викладач',
                'Тренер-лікар',
                'Тренер-вихователь',
                'Тренер-масажист',
                'Старший тренер-викладач ',
                'Інструктор-методист ',
                'Старший інструктор-методист ',
                'Практичний психолог ',
                'Інструктор з фізичної культури ',
                'Перекладач жестової мови ',
                'Інженер з охорони праці ',
                'Головний бухгалтер ',
                'Заступник головного бухгалтера ',
                'Бухгалтер ',
                'Касир ',
                'Юрисконсульт ',
                'Старший інспектор з кадрів',
                'Інспектор з кадрів ',
                'Акомпаніатор ',
                'Кінооператор ',
                'Інженер ',
                'Інженер-електронник ',
                'Секретар-друкарка',
                'Друкарка ',
                'Діловод ',
                'Лікар ',
                'Лікар з функціональної діагностики ',
                'Фахівець з фізичної реабілітації ',
                'Сестра медична ',
                'Сестра медична з фізіотерапії ',
                'Сестра медична з масажу',
            ]
        ],
        'employees_insurances' => [
            'position' => [
                'Голова правління ',
                'Генеральний директор',
                'Директор',
                'Менеджер',
                'Адміністратор',
                'Страховий агент',
            ]
        ],
        'employees_school' => [
            'position' => [
                'Директор ',
                'Викладач',
                'Менеджер',
                'Адміністратор',
            ]
        ],
        'employees_medical' => [
            'position' => [
                'Директор',
                'Головний лікар',
                'Лікар',
                'Менеджер',
                'Адміністратор',
            ]
        ],
    ];
    public array $monthsUkrainian = [
        'Січень',
        'Лютий',
        'Березень',
        'Квітень',
        'Травень',
        'Червень',
        'Липень',
        'Серпень',
        'Вересень',
        'Жовтень',
        'Листопад',
        'Грудень'
    ];
    public  $city_arr = [
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
    public $DataTypeInputs = [
        'qualification' => [
            'name' => 'qualification',
            'tag' => 'select-box',
            'placeholder' => 'Кваліфікація',
            'option' => [
                'Заслужений тренер України',
                'Заслужений майстер спорту України',
                'Майстер спорту України міжнародного класу',
                'Майстер спорту України',
                'Кандидат у майстри спорту України',
                'Перший розряд',
                'Другий розряд',
                'Третій розряд',
                'Перший юнацький розряд',
                'Другий юнацький розряд',
                'Третій юнацький розряд'
            ]
            ,
        ],
        'federation' => [
            'name' => 'federation',
            'tag' => 'custom-select',
            'placeholder' => 'Моя федерація',
            'size' => 'fool',
        ],
        'sports_institution' => [
            'name' => 'sports_institution',
            'tag' => 'custom-select',
            'placeholder' => 'Спортивний заклад',
            'size' => 'fool',
        ],
        'insurance' => [
            'name' => 'insurance',
            'tag' => 'custom-select',
            'placeholder' => 'Страхова компанія',
            'size' => 'fool',
        ],
        'medical' => [
            'name' => 'medical',
            'tag' => 'custom-select',
            'placeholder' => 'Медичний заклад',
            'size' => 'fool',
        ],
        'school' => [
            'name' => 'school',
            'tag' => 'custom-select',
            'placeholder' => 'Мої навчальні заклади',
            'size' => 'fool',
            'option' => [
            ],
        ],
        'sports_institutions' => [
            'name' => 'sports_institutions',
            'tag' => 'custom-select',
            'placeholder' => 'Спортивний заклад',
            'size' => 'fool',
            'option' => [
            ],
        ],
        'sportsmen' => [
            'name' => 'sportsmen',
            'tag' => 'input',
            'placeholder' => 'Мої спортсмени',
            'size' => 'fool',
        ],
        'history_works' => [
            'title' => 'Історія місць роботи',
            'name' => 'history_works[]',
            'tag' => 'history_works',
            'type' => 'history_works',
            'class' => 'fool',
            'placeholder' => 'Історія місць роботи',
            'data' => [],
        ],
        'family' => [
            'title' => 'Сім’я',
            'name' => 'family[]',
            'tag' => 'family',
            'type' => 'family',
            'class' => 'fool',
            'button' => 'add_family',
            'checkbox_type' => 'revert',
            'placeholder' => 'Сім’я',
        ],
        'rank' => [
            'name' => 'rank',
            'tag' => 'select-box',
            'placeholder' => 'Державні, почесні звання, спортивні звання та розряди',
            'size' => 'fool',
            'class' => ' fool',
            'option' => [
                'Заслужений тренер України',
                'Заслужений майстер спорту України',
                'Майстер спорту України міжнародного класу',
                'Майстер спорту України',
                'Кандидат у майстри спорту України',
                'Перший розряд, Другий розряд',
                'Третій розряд',
                'Перший юнацький розряд',
                'Другий юнацький розряд',
                'Третій юнацький розряд',
            ],
        ],
        'sportsman_rank' => [
            'option' => [
                'Заслужений майстер спорту України',
                'Майстер спорту України міжнародного класу',
                'Майстер спорту України',
                'Кандидат у майстри спорту України',
                'Перший розряд',
                'Другий розряд',
                'Третій розряд',
                'Перший юнацький розряд',
                'Другий юнацький розряд',
                'Третій юнацький розряд',
            ],
        ],
        'gov' => [
            'name' => 'gov',
            'tag' => 'no-active',
            'placeholder' => 'Державні заохочення',
            'size' => 'fool',
        ],
        'birthday' => [
            'name' => 'birthday',
            'required' => true,
            'tag' => 'input',
            'type' => 'date',
            'placeholder' => 'Дата народження',
        ],
        'gender' => [
            'name' => 'gender',
            'tag' => 'select-box',
            'placeholder' => 'Стать',
            'option' => [
                'Чоловік',
                'Жінка',
            ],
        ],
        'position' => [
            'name' => 'position',
            'tag' => 'select-box',
            'required'=>true,
            'placeholder' => 'Посада',
        ],
        'arm_height' => [
            'name' => 'arm_height',
            'tag' => 'input',
            'type' => 'number',
            'placeholder' => 'Розмах рук',
        ],
        'weight' => [
            'name' => 'weight',
            'tag' => 'input',
            'type' => 'number',
            'placeholder' => 'Вага',
        ],
        'height' => [
            'name' => 'height',
            'tag' => 'input',
            'type' => 'number',
            'placeholder' => 'Ріст',
        ],
        'weight_category' => [
            'name' => 'weight_category',
            'tag' => 'select-box',
            'size' => 'fool',
            'placeholder' => 'Вагова категорія',
            'option' => [
//            'm'=>[]
                'Для чоловіків 19-40 років і підлітків 17-18 років (Еліта і Молодь)' => 'Title',

                'Перша вага (Light Fly) 46 - 49',
                'Найлегша вага (Fly) 49 - 52',
                'Найлегша (Bantam Weight)    52 - 56',
                'Легка вага (Light) 56 - 60',
                'Перша напівсередня (Light Welter)    60 - 64',
                'Напівсередня (Welter) 64 - 69',
                'Середня (Middle) 69 -75',
                'Перша важка (Light Heavy)    75 - 81',
                'Важка (Heavy) 81 - 91',
                'Супер важка (Super Heavy)    91 -',

                'Для хлопців і дівчат у віці 15-16 років' => 'Title',

                'Pin 44 - 46',
                'Перша найлегша (Light Fly)    46 - 48',
                'Найлегша (Fly) 48 - 50',
                'Перша легша вага (Light Bantam) 50 - 52',
                'Легша (Вага півня) 52 - 54',
                'Напівлегка вага (Feather weight) 54 - 57',
                'Легка (Light weight) 57 - 60',
                'Перша напівсередня (Light Welter)    60 - 63',
                'Напівсередня (Welter) 63 - 66',
                'Перша середня (Light Middle) 66 - 70',
                'Середня (Middle) 70 - 75',
                'Перша важка (Light Heavy)    75 - 80',
                'Важка (Heavy) 80 -',

                'Для жінок в групах "Еліта" та "Молодь"' => 'Title',


                'Перша найлегша вага (Light Fly) 45     - 48',
                'Найлегша вага (Fly) 48 - 51',
                'Легша (Bantam) 51 - 54',
                'Напівлегка (Feather)    54 - 57',
                'Легка (Light) 57 - 60',
                'Перша напівсередня (Light Welter)    60 - 64',
                'Напівсередня (Welter) 64 - 69',
                'Середня (Middle) 69 - 75',
                'Перша важка (Light Heavy)    75 - 81',
                'Важка (Heavy) 81 -',

                'Для професійного боксу' => 'Title',

                'Міні Вага Мухи (Mini Fly Weight) -    47.63',
                'Перша найлегша вага (Junior Fly Weight) 47.63 - 48.99',
                'Найлегша вага (Fly Weight)    48.99 - 50.8',
                'Перша легша вага (Junior Bantam Weight) 50.8 - 52.16',
                'Легша вага (Bantam Weight) 52.16 - 53.52',
                'Перша напівлегка вага (Junior Feather Weight) 53.52 - 55.34',
                'Напівлегка вага (Feather Weight) 55.34 - 57.15',
                'Перша легка вага (Junior Light Weight) 57.15 - 58.97',
                'Легка вага (Light Weight) 58.97 - 61.24',
                'Перша Напівсередня вага (Junior Welterweight) 61.24 - 63.5',
                'Напівсередня вага (Welterweight) 63.5 - 66.68',
                'Перша середня вага (Junior Middle Weight) 66.68 - 69.85',
                'Середня вага (Middle Weight) 69.85 - 72.58',
                'Друга Середня вага (Sup. Middle Weight) 72.58 - 76.2',
                'Перша важка вага (Light Heavy weight) 76.2 - 79.38',
                'Важка вага (Junior Heavy weight) 79.38 - 90.72',
                'Супер важка вага (Heavy Weight) 91.17 -',
            ],
        ],
        'judge_qualification' => [
            'option' => [
                'Юний спортивний суддя',
                'Спортивний суддя другої категорії',
                'Спортивний суддя першої категорії',
                'Спортивний суддя Національної категорії',
            ],
        ],

        'trainer_qualification' => [
            'option' => [
                'Вища категорія',
                'Перша категорія',
                'Друга категорія',
            ],
        ],
        'address_birth' => [
            'name' => 'address_birth',
            'tag' => 'input',
            'type' => 'fool',
            'class' => 'fool',
            'placeholder' => 'Місце народження',
        ],

        'passport' => [
            'name' => 'passport',
            'tag' => 'passport',
            'size' => 'fool',
            'placeholder' => 'Паспорт український, серія/номер',
            'name_seria' => '',
            'name_number' => '',
        ],

        'foreign_passport' => [
            'name' => 'foreign_passport',
            'name_seria' => '',
            'name_number' => '',
            'tag' => 'passport',
            'placeholder' => 'Паспорт закордоний, серія/номер',
        ],
        'trainer' => [
            'name' => 'trainer',
            'tag' => 'custom-select',
            'placeholder' => 'Мій тренер',
            'size' => 'fool',
            'option' => [
                'box' => 'Бокс',
                'school-box' => 'Школа бокса',
                'yoga' => 'Йога',
            ],

        ],

        'achievements' => [
            'name' => 'achievements',
            'tag' => 'input',
            'size' => 'fool',
            'placeholder' => 'Історія досягнень',
        ],
        'school_list' => [
            'name' => 'school_list',
            'tag' => 'input',
            'size' => 'fool',
            'placeholder' => 'Перелік навчальних закладів, які закінчив суддя',
        ],
        'director' => [
            'name' => 'director',
            'tag' => 'input',
            'placeholder' => 'Президент',
        ],
        'edrpou' => [
            'name' => 'edrpou',
            'tag' => 'input',
            'type' => 'number',
            'placeholder' => 'Код за ЄДРПОУ',
        ],
        'site' => [
            'name' => 'site',
            'tag' => 'input',
            'placeholder' => 'Вебсайт',
        ],
        'members' => [
            'name' => 'members',
            'tag' => 'custom-select',
            'size' => 'fool',
            'placeholder' => 'Учасники федерації',
        ],
        'employees' => [
            'title' => 'Працівники федерації',
            'checkbox_type' => 'revert',
            'name' => 'employees',
            'tag' => 'checkbox-list',
            'size' => 'fool',
            'placeholder' => 'Працівники федерації',
        ],
        'type' => [
            'name' => 'type',
            'tag' => 'select-box',
            'placeholder' => 'Тип закладу',
            'option' => [
                'Спеціалізована',
                'Олімпійська ',
                'Параолімпійська',
                'Середня загальноосвітня школа-інтернат/ліцей-інтернат спортивного профілю',
                'Училище спортивного профілю  ',
                'Спортивний ліцей',
                'Професійний коледж (коледж) спортивного профілю',
                'Фаховий коледж',

            ],
        ],
        'category' => [
            'name' => 'category',
            'tag' => 'select-box',
            'placeholder' => 'Категорія',
            'option' => [
                'Дитячо-юнацька спортивна школа',
                'Спеціалізована дитячо-юнацька спортивна школа олімпійського резерву',
                'Обласний центр олімпійської підготовки',
                'Центр олімпійської підготовки',
                'Школа вищої спортивної майстерності',
                'Спортивний клуб',

            ],
        ],
        'federation_members' => [
            'title' => 'Працівники федерації',
            'data_wrapper' => [
                [
                    'type' => 'todo_table',
                    'button_add' => '',
                    'data' => [
                        'thead' => ['ПІП', 'Телефон', 'Пошта', 'Посада'],
                        'body' => [],
                    ],
                ],
            ],
        ],
        'members_table' => [
            'title' => 'Працівники федерації',
            'data_wrapper' => [
                [
                    'type' => 'todo_table',
                    'button_add' => '',
                    'data' => [
                        'thead' => ['ПІП', 'Телефон', 'Пошта', 'Посада'],
                        'body' => [],
                    ],
                ],
            ],
        ],
    ];

    public function getDefaultArrayData($name_type = '', $data = []): array
    {
        $return = [];
        $return = array_merge($return, [
            'address' => [
                'name' => 'address',
                'tag' => 'input',
                'placeholder' => 'Адреса проживання',
                'autocomplete' => 'street-address',
                'size' => 'fool',

            ],
            'city' => [
                'required' => true,
                'name' => 'city',
                'tag' => 'select-box',
                'placeholder' => 'Місто',
                'size' => 'fool',
                'option' => $this->city_arr,

            ],
            'street' => [
                'name' => 'street',
                'size' => 'fool',
                'tag' => 'input',
                'placeholder' => 'Вулиця/провулок/проспект',

            ],
            'house_number' => [
                'name' => 'house_number',
                'tag' => 'input',
//                'type' => 'number',
                'placeholder' => 'Номер будинку',

            ],
            'apartment_number' => [
                'name' => 'apartment_number',
                'tag' => 'input',
                'placeholder' => 'Номер квартири',
            ],
            'email' => [
                'name' => 'email',
                'tag' => 'input',
                'type' => 'email',
                'placeholder' => 'E-mail',
                'logo' => 'img/mail.svg',
                'required' => true,
            ],
            'phone' => [
                'name' => 'phone',
                'tag' => 'input',
                'placeholder' => 'Номер телефону',
                'logo' => 'img/phone.svg',
                'required' => true,
            ],
        ]);
        if ($name_type === 'fool') {
            $return = array_merge($return, [
                'last_name' => [
                    'name' => 'last_name',
                    'tag' => 'input',
                    'placeholder' => 'Прізвище',
                ],
                'first_name' => [
                    'name' => 'first_name',
                    'tag' => 'input',
                    'placeholder' => 'Імя',
                ],
                'surname' => [
                    'name' => 'surname',
                    'tag' => 'input',
                    'placeholder' => 'По батькові',
                ],


            ]);
        } else {
            $return = array_merge($return, [
                'name' => [
                    'name' => 'name',
                    'tag' => 'input',
                    'placeholder' => 'Назва закладу',
                ],
            ]);
        }
        $merge = array_merge_recursive($return, $this->DataTypeInputs);

        foreach ($merge as $key => &$data_input) {
            foreach ($data_input as $key_opt => &$item_opt) {
                if (!isset($data[$key][$key_opt])) {
                    $data[$key][$key_opt] = $item_opt;
                }
            }
        }

        unset($data_input, $item_opt);

        return $data;
    }

}
