<?php

class Seeder
{
    public function call($seeder)
    {
        $seederInstance = new $seeder();
        $seederInstance->run();
    }
}
?>