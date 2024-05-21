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

    function getPartsFromFullname($stringInitials)
    {      
        $initialsArray = explode(' ', $stringInitials);
        return ['surname'=>$initialsArray[0],'name'=>$initialsArray[1],'patronomyc'=>$initialsArray[2]];
    }

    function getFullnameFromParts($surname, $name, $patronomyc)
    {
        return $surname." ".$name." ".$patronomyc;
    }

    function getShortName($stringInitials)
    {
        $initialsArray = getPartsFromFullname($stringInitials);
        return $initialsArray['name'].' '.mb_substr($initialsArray['surname'], 0, 1).'.';
    }

    function getGenderFromName($stringInitials)
    {
        $initials = getPartsFromFullname($stringInitials);
        $genderSign = 0;
        if (mb_substr($initials['patronomyc'], -3, 3) === 'вна') {
            $genderSign--;
        }
        if (mb_substr($initials['name'], -1, 1) === 'а') {
            $genderSign--;
        }
        if (mb_substr($initials['surname'], -2, 2) === 'ва') {
            $genderSign--;
        }
        if (mb_substr($initials['patronomyc'], -2, 2) === 'ич') {
            $genderSign++;
        }
        if($initials['name'][-1]=='й' || $initials['name'][-1]=='н') {
            $genderSign++;
        }
        if (mb_substr($initials['surname'], -1, 1) === 'в') {
            $genderSign++;
        }
        return $genderSign<=>0;
    }

    function getGenderDescription($arrayPersons)
    {
        $male=0;
        $female = 0;
        $undefined = 0;
        foreach($arrayPersons as $key){
            if(getGenderFromName($key['fullname'])==1) {
                $male++;
            }
            else if(getGenderFromName($key['fullname'])==-1) {
                $female++;
            }
            else{
                $undefined++;
            }
        }
        $total = count($arrayPersons);
        $malePercentage = round($male / $total * 100, 1);
        $femalePercentage = round($female / $total * 100, 1);
        $undefinedPercentage = round($undefined / $total * 100, 1);
        $str= <<<ANSWER
        <br>
        <span style="color:#800;font-weight:700;">Гендерный состав аудитории:<br>
        ----------------------------------------</span>
        <br>Мужчин - $malePercentage%
        <br>Женщины - $femalePercentage%
        <br>Не удалось определить - $undefinedPercentage%
        <br>
        ANSWER;
        return $str;
    }

    function getPerfectPartner($surname, $name, $patronomyc, $arrayPersons)
    {
        $surname = mb_strtoupper(mb_substr($surname, 0, 1)) . mb_strtolower(mb_substr($surname, 1));
        $name = mb_strtoupper(mb_substr($name, 0, 1)) . mb_strtolower(mb_substr($name, 1));
        $patronomyc = mb_strtoupper(mb_substr($patronomyc, 0, 1)) . mb_strtolower(mb_substr($patronomyc, 1));
        $initials = getFullnameFromParts($surname, $name, $patronomyc);
        $randomPair=null;
        do{
            $randomPair=$arrayPersons[rand(0, count($arrayPersons)-1)]['fullname'];
        }while(getGenderFromName($randomPair)===getGenderFromName($initials));
        $answer  = getShortName(getFullnameFromParts($surname, $name, $patronomyc))." + ".getShortName($randomPair)." =<br>♡ Идеально на ".number_format(rand(5000, 10000)/100, 2)."% ♡";
        return $answer;
    }

    // Тестирование функции getPartsFromFullname
    echo "Тестирование функции getPartsFromFullname:<br>";
    echo "<pre>";
    print_r(getPartsFromFullname('Иванов Иван Иванович'));
    echo "</pre>";

    // Тестирование функции getFullnameFromParts
    echo "Тестирование функции getFullnameFromParts:<br>";
    echo getFullnameFromParts('Иванов', 'Иван', 'Иванович') . "<br>";

    // Тестирование функции getShortName
    echo "Тестирование функции getShortName:<br>";
    echo getShortName('Иванов Иван Иванович') . "<br>";

    // Тестирование функции getGenderFromName
    echo "Тестирование функции getGenderFromName:<br>";
    echo "Пол: " . getGenderFromName('Иванов Иван Иванович') . "<br>";

    // Тестирование функции getGenderDescription
    echo "Тестирование функции getGenderDescription:<br>";
    echo getGenderDescription($example_persons_array);

    // Тестирование функции getPerfectPartner
    echo "<br>Тестирование функции getPerfectPartner:<br>";
    echo getPerfectPartner('Иванов', 'Иван', 'Иванович', $example_persons_array);