<?php
// app/Http/Requests/CreditApplicationRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Pharmacy information - Required fields
            'legal_name' => 'required|string|max:255',
            'bill_address' => 'required|string|max:255',
            'bill_city' => 'required|string|max:100',
            'bill_state' => 'required|string|max:50',
            'bill_zip' => 'required|string|max:20',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'dea_number' => 'required|string|max:100',
            'dea_expiry' => 'required|date',
            'state_license' => 'required|string|max:100',
            'license_expiry' => 'required|date',
            'tax_id' => 'required|string|max:50',
            'ownership_type' => 'required|in:Sole Proprietor,Partnership,Corporation,LLC',

            // Bank and reference information - Required fields
            'bank_name' => 'required|string|max:255',
            'bank_account' => 'required|string|max:255',

            // Optional fields
            'dba' => 'nullable|string|max:255',
            'ship_address' => 'nullable|string|max:255',
            'ship_city' => 'nullable|string|max:100',
            'ship_state' => 'nullable|string|max:50',
            'ship_zip' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:50',
            'npi_number' => 'nullable|string|max:50',
            'years_in_business' => 'nullable|integer|min:0',
            'ap_manager_name' => 'nullable|string|max:255',
            'ap_manager_email' => 'nullable|email|max:255',
            'buyer_name' => 'nullable|string|max:255',
            'buyer_email' => 'nullable|email|max:255',
            'primary_wholesaler' => 'nullable|string|max:255',
            'primary_wholesaler_account' => 'nullable|string|max:255',
            'bank_contact' => 'nullable|string|max:255',
            'duns_number' => 'nullable|string|max:50',
            'requested_credit_line' => 'nullable|in:5000,25000,50000,100000+',

            // JSON fields
            'owners_info' => 'sometimes|array',
            'owners_info.*.name' => 'required_with:owners_info|string|max:255',
            'owners_info.*.phone' => 'required_with:owners_info|string|max:50',

            'trade_references' => 'sometimes|array',
            'trade_references.*.name' => 'required_with:trade_references|string|max:255',
            'trade_references.*.account' => 'required_with:trade_references|string|max:255',
            'trade_references.*.phone' => 'required_with:trade_references|string|max:50',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'legal_name.required' => 'The legal business name is required.',
            'dea_number.required' => 'The DEA number is required.',
            'state_license.required' => 'The State License number is required.',
            'owners_info.*.name.required_with' => 'All owner names are required.',
            'owners_info.*.phone.required_with' => 'All owner phone numbers are required.',
            'trade_references.*.name.required_with' => 'All reference names are required.',
            'trade_references.*.account.required_with' => 'All reference account numbers are required.',
            'trade_references.*.phone.required_with' => 'All reference phone numbers are required.'
        ];
    }
}
