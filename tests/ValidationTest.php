<?php

namespace Mpyw\LaravelFileErrors\Tests;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Mpyw\LaravelFileErrors\ValidationServiceProvider;
use Orchestra\Testbench\TestCase;

class ValidationTest extends TestCase
{
    /**
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ValidationServiceProvider::class,
        ];
    }

    public function testPass(): void
    {
        $file = UploadedFile::fake()->create('test');

        $file = new UploadedFile(
            $file->getPathname(),
            $file->getClientOriginalName(),
            $file->getClientMimeType(),
            UPLOAD_ERR_OK,
            true
        );

        $validator = Validator::make(compact('file'), ['file' => 'file']);

        $this->assertSame([], $validator->errors()->toArray());
    }

    public function testFailure(): void
    {
        $file = UploadedFile::fake()->create('test');

        $file = new UploadedFile(
            $file->getPathname(),
            $file->getClientOriginalName(),
            $file->getClientMimeType(),
            UPLOAD_ERR_NO_FILE,
            true
        );

        $validator = Validator::make(compact('file'), ['file' => 'file']);

        $this->assertSame(['file' => ['validation.uploaded.no_file']], $validator->errors()->toArray());
    }

    public function testTranslatedFailure(): void
    {
        $this->app->instance('path.lang', __DIR__ . '/../resources/lang');

        $file = UploadedFile::fake()->create('test');

        $file = new UploadedFile(
            $file->getPathname(),
            $file->getClientOriginalName(),
            $file->getClientMimeType(),
            UPLOAD_ERR_INI_SIZE,
            true
        );

        $validator = Validator::make(compact('file'), ['file' => 'file']);

        $this->assertSame(['file' => ['The file exceeds the maximum filesize defined in the server.']], $validator->errors()->toArray());
    }
}
