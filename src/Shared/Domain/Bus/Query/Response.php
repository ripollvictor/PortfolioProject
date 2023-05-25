<?php


namespace App\Shared\Domain\Bus\Query;

interface Response
{
    public function json();
    public function status();
}
