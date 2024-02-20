<?php

namespace App\Services;

use Symfony\Component\HttpKernel\KernelInterface;

class Export
{
    protected KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function exportNews(array $list): string
    {
        $lines = [];
        foreach ($list as $v) {
            $lines[] = implode(",", $v);
        }
        $string = implode("\n", $lines);

        $filename = tempnam($this->kernel->getProjectDir() . '/var',
            'export-csv-'
        );
        file_put_contents($filename, $string);
        return $filename;

    }
}