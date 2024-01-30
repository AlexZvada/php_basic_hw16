<?php

trait Validation
{
    /**
     * @param string $name
     * @return bool
     */
    private function length(string $name): bool
    {
        if (strlen($name) < 2) {
            return false;
        }
        return true;
    }

    private function min(int $value, int $min): bool
    {
        if ($value < $min) {
            return false;
        }
        return true;
    }

    private function max(int $value, int $max): bool
    {
        if ($value > $max) {
            return false;
        }
        return true;
    }
}