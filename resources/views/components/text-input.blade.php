@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
// Perubahan ada di sini: dark:bg-gray-900 dihilangkan dan ditambahkan bg-white
'class' => 'border-gray-300 dark:border-gray-700 bg-white dark:text-gray-900 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'
]) !!}>