<?php

namespace App\Jobs;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ImportGroupsWithStudentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const FIELDS_MAP = [
        '﻿Фамилия'       => 'last_name',
        'Имя'            => 'first_name',
        'Отчество'       => 'surname',
        'Дата рождения'  => 'birth_date',
        'Телефон'        => 'phone',
        'Email'          => 'email',
        'Гражданство'    => 'citizenship',
        'Учебная группа' => 'group_name',
    ];

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $fieldIds = array_shift($this->data);

        foreach ($fieldIds as $key => $fieldTitle) {
            $fieldIds[$key] = self::FIELDS_MAP[$fieldTitle] ?? null;
        }

        $fieldIds = array_filter($fieldIds);
        $students = collect();

        foreach ($this->data as $studentFields) {
            $student = [];

            foreach ($studentFields as $key => $value) {
                if (!($fieldIds[$key] ?? null)) {
                    continue;
                }

                $student[$fieldIds[$key]] = $value;
            }

            $students->push($student);
        }

        $groupsWithStudents = $students->groupBy('group_name');

        foreach ($groupsWithStudents as $groupName => $students) {
            $group = Group::query()->firstOrCreate(['title' => $groupName]);

            foreach ($students as $student) {
                $student['group_id'] = $group->id;
                Student::query()->updateOrCreate(Arr::only($student, ['first_name', 'last_name', 'surname']), $student);
            }
        }
    }
}
