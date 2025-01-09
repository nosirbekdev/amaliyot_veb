<?php
// app/Exports/ProjectsExport.php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Loyiha ma'lumotlarini olish (tanlangan ustunlar)
        return Project::select('name', 'start_date', 'end_date', 'organization', 'payment', 'payment_month')->get();
    }

    public function headings(): array
    {
        // Excel ustunlari sarlavhalarini ko‘rsatish
        return [
            'Project Name',
            'Start Date',
            'End Date',
            'Organization',
            'Payment',
            'Payment Month',
        ];
    }
}
