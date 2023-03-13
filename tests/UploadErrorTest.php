<?php

namespace Mpyw\LaravelFileErrors\Tests;

use Mpyw\LaravelFileErrors\UploadError;
use Orchestra\Testbench\TestCase;

class UploadErrorTest extends TestCase
{
    /**
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [];
    }

    public function testToString(): void
    {
        $error = new UploadError(UploadError::ERR_INI_SIZE, UploadError::TITLE_INI_SIZE);
        $this->assertSame(UploadError::TITLE_INI_SIZE, (string)$error);
    }

    public function testFromCode(): void
    {
        $error = UploadError::fromCode(UPloadError::ERR_INI_SIZE);
        $this->assertSame(UploadError::ERR_INI_SIZE, $error->getCode());
        $this->assertSame(UploadError::TITLE_INI_SIZE, $error->getTitle());
    }

    public function testFromTitle(): void
    {
        $error = UploadError::fromTitle(UPloadError::TITLE_INI_SIZE);
        $this->assertSame(UploadError::ERR_INI_SIZE, $error->getCode());
        $this->assertSame(UploadError::TITLE_INI_SIZE, $error->getTitle());
    }

    public function testCreatingUnknown(): void
    {
        $error = UploadError::unknown();
        $this->assertSame(UploadError::ERR_UNKNOWN, $error->getCode());
        $this->assertSame(UploadError::TITLE_UNKNOWN, $error->getTitle());
    }

    public function testFromUnknownCode(): void
    {
        $error = UploadError::fromCode(-123);
        $this->assertSame(UploadError::ERR_UNKNOWN, $error->getCode());
        $this->assertSame(UploadError::TITLE_UNKNOWN, $error->getTitle());
    }

    public function testFromUnknownTitle(): void
    {
        $error = UploadError::fromTitle('FooBarBaz');
        $this->assertSame(UploadError::ERR_UNKNOWN, $error->getCode());
        $this->assertSame(UploadError::TITLE_UNKNOWN, $error->getTitle());
    }
}
