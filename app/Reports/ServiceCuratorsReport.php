<?php

namespace App\Reports;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ServiceCuratorsReport
{
    private $activities;
    private $date;
    private $textStyle     = ['name' => 'TimesNewRoman', 'size' => 14];
    private $headTextStyle = ['name' => 'TimesNewRoman', 'size' => 14, 'bold' => true];

    private const MONTH_NAMES = [
        1  => 'Январе',
        2  => 'Феврале',
        3  => 'Марте',
        4  => 'Апреле',
        5  => 'Мае',
        6  => 'Июне',
        7  => 'Июле',
        8  => 'Августе',
        9  => 'Сентябре',
        10 => 'Октябре',
        11 => 'Ноябре',
        12 => 'Декабре',
    ];

    public function __construct(Collection $activities, Carbon $date)
    {
        $activities->load('groups');
        $this->activities = $activities->groupBy('user.fullName')->map(function (Collection $activities, $curatorName) {
            $groups = $activities->pluck('groups')->flatten()->unique();

            return [
                'curator'     => $curatorName,
                'groupsCount' => $groups->count(),
                'groupNames'  => $groups->pluck('title')->filter()->implode(', '),
                'sum'         => 2000 * $groups->count(),
            ];
        })->values();

        $this->date = $date;
    }

    public function buildAndSave(string $fileName): void
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection(['align' => 'right']);

        $section->addText('Ректору УлГТУ', $this->textStyle, ['align' => 'right']);
        $section->addText('Ярушкиной Н.Г.', $this->textStyle, ['align' => 'right']);
        $section->addText('Декана ФИСТ', $this->textStyle, ['align' => 'right']);
        $section->addText('Святова К.В.', $this->textStyle, ['align' => 'right']);
        $section->addText("\n\n");

        $section->addText("СЛУЖЕБНАЯ ЗАПИСКА \n", $this->textStyle, ['align' => 'center']);
        $section->addText(
            "\t Прошу назначить надбавку (фиксированную сумму) за дополнительный объем работы, не связанный  с основными обязанностями  сотрудника, кураторам групп по ФИСТ за выполненную кураторскую работу в "
            . self::MONTH_NAMES[$this->date->month] . ' месяце '
            . $this->date->year . ' года.',
            $this->textStyle
        );

        $table = $section->addTable(['borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing' => 0, 'cellMargin' => 0]);
        $table->addRow(-0.5, array('exactHeight' => -5));
        $table->addCell(800)->addText('№', $this->headTextStyle, ['align' => 'center']);
        $table->addCell(5000)->addText('ФИО куратора', $this->headTextStyle, ['align' => 'center']);
        $table->addCell(4000)->addText('Группа', $this->headTextStyle, ['align' => 'center']);
        $table->addCell(2700)->addText('Кол-во групп', $this->headTextStyle, ['align' => 'center']);
        $table->addCell(3500)->addText('Сумма доплаты', $this->headTextStyle, ['align' => 'center']);

        foreach ($this->activities as $key => $activity) {
            $table->addRow(-0.5, array('exactHeight' => -5));
            $table->addCell(800)->addText($key + 1, $this->textStyle, ['align' => 'center']);
            $table->addCell(5000)->addText(data_get($activity, 'curator'), $this->textStyle, ['align' => 'center']);
            $table->addCell(4000)->addText(data_get($activity, 'groupNames'), $this->textStyle, ['align' => 'center']);
            $table->addCell(2700)->addText(data_get($activity, 'groupsCount'), $this->textStyle, ['align' => 'center']);
            $table->addCell(3500)->addText(data_get($activity, 'sum'), $this->textStyle, ['align' => 'center']);
        }

        $table->addRow(-0.5, array('exactHeight' => -5));
        $table->addCell(800)->addText('');
        $table->addCell(5000)->addText('');
        $table->addCell(4000)->addText('ИТОГО:', $this->headTextStyle, ['align' => 'left']);
        $table->addCell(2700)->addText($this->activities->sum('groupsCount'), $this->headTextStyle, ['align' => 'center']);
        $table->addCell(3500)->addText($this->activities->sum('sum'), $this->headTextStyle, ['align' => 'center']);

        $section->addText('');
        $section->addText("\t\t Декан  ФИСТ \t\t\t К.В. Святов", $this->textStyle);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(Storage::path($fileName));
    }
}
