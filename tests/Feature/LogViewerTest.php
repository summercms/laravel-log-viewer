<?php

use Opcodes\LogViewer\Facades\LogViewer;
use function Pest\Laravel\get;

beforeEach(function () {
    generateLogFiles(['laravel.log', 'other.log']);
});

afterEach(fn () => clearGeneratedLogFiles());

it('properly includes log files', function () {
    get(route('blv.index'))->assertSeeText('laravel.log')
        ->assertSeeText('other.log');
});

it('properly excludes log files', function () {
    config()->set('log-viewer.exclude_files', ['*other*']);

    get(route('blv.index'))->assertSeeText('laravel.log')
        ->assertDontSee('other.log');
});
