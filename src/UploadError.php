<?php

namespace Mpyw\LaravelFileErrors;

use Illuminate\Http\UploadedFile;

/**
 * Class UploadedError
 */
class UploadError
{
    // errors
    public const ERR_OK = UPLOAD_ERR_OK;
    public const ERR_INI_SIZE = UPLOAD_ERR_INI_SIZE;
    public const ERR_FORM_SIZE = UPLOAD_ERR_FORM_SIZE;
    public const ERR_PARTIAL = UPLOAD_ERR_PARTIAL;
    public const ERR_NO_FILE = UPLOAD_ERR_NO_FILE;
    public const ERR_NO_TMP_DIR = UPLOAD_ERR_NO_TMP_DIR;
    public const ERR_CANT_WRITE = UPLOAD_ERR_CANT_WRITE;
    public const ERR_EXTENSION = UPLOAD_ERR_EXTENSION;
    public const ERR_UNKNOWN = -1;

    // titles
    public const TITLE_OK = '';
    public const TITLE_INI_SIZE = 'ini_size';
    public const TITLE_FORM_SIZE = 'form_size';
    public const TITLE_PARTIAL = 'partial';
    public const TITLE_NO_FILE = 'no_file';
    public const TITLE_NO_TMP_DIR = 'no_tmp_dir';
    public const TITLE_CANT_WRITE = 'cant_write';
    public const TITLE_EXTENSION = 'extension';
    public const TITLE_UNKNOWN = 'unknown';

    public const MAP = [
        self::ERR_OK => self::TITLE_OK,
        self::ERR_INI_SIZE => self::TITLE_INI_SIZE,
        self::ERR_FORM_SIZE => self::TITLE_FORM_SIZE,
        self::ERR_PARTIAL => self::TITLE_PARTIAL,
        self::ERR_NO_FILE => self::TITLE_NO_FILE,
        self::ERR_NO_TMP_DIR => self::TITLE_NO_TMP_DIR,
        self::ERR_CANT_WRITE => self::TITLE_CANT_WRITE,
        self::ERR_EXTENSION => self::TITLE_EXTENSION,
        self::ERR_UNKNOWN => self::TITLE_UNKNOWN,
    ];

    /**
     * UploadedFileError constructor.
     */
    public function __construct(protected int $code, protected string $title)
    {
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public static function fromCode(int $code): static
    {
        return isset(static::MAP[$code])
            ? new static($code, static::MAP[$code])
            : static::unknown();
    }

    public static function fromTitle(string $title): static
    {
        static $map;

        if (!$map) {
            $map = array_flip(static::MAP);
        }

        return isset($map[$title])
            ? new static($map[$title], $title)
            : static::unknown();
    }

    public static function fromFile(UploadedFile $file): static
    {
        return static::fromCode($file->getError());
    }

    public static function unknown(): static
    {
        return new static(static::ERR_UNKNOWN, static::TITLE_UNKNOWN);
    }
}
