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
        Err::TITLE_INI_SIZE => ':attributeがサーバで許容されたサイズを超えています。',
        Err::TITLE_FORM_SIZE => ':attributeがフォームで許容されたサイズを超えています。',
        Err::TITLE_PARTIAL => ':attributeは一部のデータしか送信されませんでした。',
        Err::TITLE_NO_FILE => ':attributeが送信されていません。',
        Err::TITLE_CANT_WRITE => ':attributeのディスクへの書き込みに失敗しました。',
        Err::TITLE_NO_TMP_DIR => '一時保存用ディレクトリが存在しないため、:attributeのアップロードに失敗しました。',
        Err::TITLE_EXTENSION => 'PHPエクステンションにより、:attributeのアップロードが中断されました。',
        Err::TITLE_UNKNOWN => '不明なエラーにより、:attributeのアップロードに失敗しました。',
    ],

    /* ... */
];
