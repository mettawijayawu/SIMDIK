<a
    {{ $attributes->merge([
        'class' => 'block w-full px-4 py-2 text-left text-sm leading-5 
                text-gray-900 dark:text-gray-900 
                
                /* KOREKSI BACKGROUND UTAMA MENJADI PUTIH */
                bg-white dark:bg-white 
                
                /* KOREKSI HOVER BACKGROUND */
                hover:bg-gray-100 dark:hover:bg-gray-100 
                
                /* KOREKSI FOCUS BACKGROUND */
                focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-100 
                
                transition duration-150 ease-in-out',
    ]) }}>{{ $slot }}</a>
