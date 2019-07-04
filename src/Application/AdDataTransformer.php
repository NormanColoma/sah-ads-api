<?php


namespace App\Application;


interface AdDataTransformer
{
    public function write(array $ads): void;
    public function read() : array;
}