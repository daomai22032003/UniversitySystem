<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request
    }

        public function rules(): array
            {
                return [
                'term_name'  => 'required|unique:academic_years,term_name|max:50',
                'start_date' => 'nullable|date',
                'end_date'   => 'nullable|date|after_or_equal:start_date',
            ];
        }

        public function messages(): array
        {
            return [
                'term_name.required' => 'Tên năm học không được để trống',
                'term_name.unique'   => 'Tên năm học đã tồn tại',
                'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',
            ];
            }
}
