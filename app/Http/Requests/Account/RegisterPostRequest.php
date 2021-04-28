<?php
/**
 * RegisterPostRequest Class File
 *
 * PHP version 7.2
 *
 * @category  Account
 * @package   Account
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 Braviara Technologies LLP (ABN 77 084 670 600)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      https://www.thetechthing.com/
 */
namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
/**
 * This class validate account signup request
 *
 * @category Account
 * @package  Account
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class RegisterPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'emailid'   => ['required', 'string', 'email', 'max:255'],
            'name'      => ['required', 'string', 'min:6'],
            'mobile_no' => ['nullable', 'string', 'min:10'],
            'document'  => ['required', 'max:20000', 'mimes:doc,docx,pdf,png,jpeg,jpg'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator validator
     *
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(
            function ($validator) {
                $name = $validator->validated()['name'];
                if (isset($name) && $name != '') {
                    $tName = explode(' ', $name);
                    if (!isset($tName[1])) {
                        $msg = Lang::get('account.full_name_null');
                        $validator->errors()->add('field', $msg);
                    }
                }
            }
        );
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'emailid.required' => Lang::get('account.invalid_email_id'),
            'password.required' => Lang::get('account.invalid_password'),
            'document.required' => Lang::get('account.document_empty'),
            'document.mimes'=> Lang::get('account.invalid_document_format')
        ];
    }
}
