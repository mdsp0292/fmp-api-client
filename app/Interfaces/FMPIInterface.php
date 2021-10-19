<?php

namespace App\Interfaces;

interface FMPIInterface
{
    public function getProfile(string $companyKey);

    public function getQuote(string $companyKey);

    public function request(string $method, string $companyKey);

    public function getApiUrl(string $method, string $companyKey);
}
