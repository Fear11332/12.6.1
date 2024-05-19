<?php
    $example_persons_array = [
        [
            'fullname' => 'Иванов Иван Иванович',
            'job' => 'tester',
        ],
        [
            'fullname' => 'Степанова Наталья Степановна',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Пащенко Владимир Александрович',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Громов Александр Иванович',
            'job' => 'fullstack-developer',
        ],
        [
            'fullname' => 'Славин Семён Сергеевич',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Цой Владимир Антонович',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Быстрая Юлия Сергеевна',
            'job' => 'PR-manager',
        ],
        [
            'fullname' => 'Шматко Антонина Сергеевна',
            'job' => 'HR-manager',
        ],
        [
            'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Бардо Жаклин Фёдоровна',
            'job' => 'android-developer',
        ],
        [
            'fullname' => 'Шварцнегер Арнольд Густавович',
            'job' => 'babysitter',
        ],
    ];

    function getPartsFromFullname($surname, $name, $patronomyc)
    {
        return $name." ".$surname." ".$patronomyc;
    }

    function getFullnameFromParts($stringInitials)
    {
        $initialsArray = explode(' ', $stringInitials);
        return ['surname'=>$initialsArray[0],'name'=>$initialsArray[1],'patronomyc'=>$initialsArray[2]];
    }

    function getShortName($stringInitials)
    {
        $initialsArray = getFullnameFromParts($stringInitials);
        return $initialsArray['name'].' '.mb_substr($initialsArray['surname'], 0, 1).'.';
    }

    echo getShortName('Иванов Иван Иванович');