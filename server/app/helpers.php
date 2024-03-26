<?php
function page_image($value = null)
{
    if (!str_starts_with($value, 'http') && substr($value, 0, 1) !== '/') {
        $value = config('book.uploads.webpath') . '/' . $value;
    }
    return $value;
}