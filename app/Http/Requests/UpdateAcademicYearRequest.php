<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAcademicYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'term_name'  => 'required|max:50|unique:academic_years,term_name,' . $this->academic_year->id,
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
             'status' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'term_name.required' => 'Tên kỳ không được để trống',
            'term_name.unique'   => 'Tên kỳ đã tồn tại',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',
        ];
    }
}
