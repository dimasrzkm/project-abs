@if ($field != $this->sortByField)
    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor"
        viewBox="0 0 320 512">
        <path
            d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
    </svg>
@elseif ($this->sortDirection == 'asc')
    <svg class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="-96 0 512 512"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M279 224H41c-21.4 0-32.1-25.9-17-41L143 64c9.4-9.4 24.6-9.4 33.9 0l119 119c15.2 15.1 4.5 41-16.9 41z" />
    </svg>
@else
    <svg class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="-96 0 512 512"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z" />
    </svg>
@endif