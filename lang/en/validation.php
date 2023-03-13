<?php

use Mpyw\LaravelFileErrors\UploadError as Err;

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    /* ... */

    // 'uploaded' => 'The :attribute failed to upload.',
    'uploaded' => [
        Err::TITLE_INI_SIZE => 'The :attribute exceeds the maximum filesize defined in the server.',
        Err::TITLE_FORM_SIZE => 'The :attribute exceeds the maximum filesize defined in the form.',
        Err::TITLE_PARTIAL => 'The :attribute was only partially uploaded.',
        Err::TITLE_NO_FILE => 'The :attribute was not uploaded.',
        Err::TITLE_CANT_WRITE => 'The :attribute could not be written on disk.',
        Err::TITLE_NO_TMP_DIR => 'The :attribute could not be uploaded; missing temporary directory.',
        Err::TITLE_EXTENSION => 'The :attribute upload was stopped by a PHP extension.',
        Err::TITLE_UNKNOWN => 'The :attribute could not be uploaded due to an unknown error.',
    ],

    /* ... */
];
