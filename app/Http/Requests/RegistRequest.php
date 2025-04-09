<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:90',
            'email' => 'required|email|max:290',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:freelancer,client',
            'profile_foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Ограничение на изображение
            'agree_policy' => 'required|accepted', // Пользователь должен согласиться с политикой
        ];
    }

    /**
     * Атрибуты для более красивых сообщений
     */
    public function attributes()
    {
        return [
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'profile_foto' => 'Фотография профиля',
            'agree_policy' => 'Политика конфиденциальности',
        ];
    }

    /**
     * Сообщения для ошибок валидации
     */
    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста, введите своё имя.',
            'name.min' => 'Имя должно быть не менее 3 символов.',
            'name.max' => 'Имя не должно превышать 90 символов.',
            'email.required' => 'Введите вашу электронную почту.',
            'email.email' => 'Введите корректный email.',
            'email.max' => 'Email не должен превышать 290 символов.',
            'password.required' => 'Введите пароль.',
            'password.min' => 'Пароль должен быть минимум 6 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
            'role.required' => 'Пожалуйста, выберите свою роль.',
            'role.in' => 'Выберите правильную роль (freelancer или client).',
            'profile_foto.image' => 'Файл должен быть изображением (jpg, png, jpeg).',
            'profile_foto.mimes' => 'Изображение должно быть одного из форматов: jpg, jpeg, png.',
            'profile_foto.max' => 'Максимальный размер изображения: 2 МБ.',
            'agree_policy.required' => 'Необходимо согласиться с политикой конфиденциальности.',
            'agree_policy.accepted' => 'Вы должны согласиться с политикой конфиденциальности.',
        ];
    }
}
