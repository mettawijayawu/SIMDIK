@props(['active'])

@php
    // Menggunakan warna hitam/abu-abu gelap (gray-900) untuk teks aktif
    $active_text_color = 'text-gray-900 dark:text-gray-900';
    // Menggunakan border hitam (gray-900) atau netral jika ingin ada garis bawah
    $active_border_color = 'border-gray-900 dark:border-gray-700';

    $classes =
        $active ?? false
            ? 'inline-flex items-center px-1 pt-1 border-b-2 ' .
                $active_border_color .
                ' text-sm font-medium leading-5 ' .
                $active_text_color .
                ' focus:outline-none focus:border-gray-900 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-900 dark:text-gray-900 hover:text-gray-900 dark:hover:text-gray-900 hover:border-gray-900 dark:hover:border-gray-900 focus:outline-none focus:text-gray-900 dark:focus:text-gray-900 focus:border-gray-900 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
