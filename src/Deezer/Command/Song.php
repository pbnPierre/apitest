<?php
namespace Deezer\DIC;

class SimpleDIC {
    private $shareItems = [],
        $calls = [];

    public function share(string $name, callable $callable)
    {
        $this->calls[$name] = $callable;
    }

    public function __get($name)
    {
        if (!isset($this->shareItems[$name])) {
            if (!isset($this->calls[$name])) {
                throw new \UnexpectedValueException(sprintf(
                    '%s is not set in container check your bootstrap process'
                ));
            }

            $this->shareItems[$name] = $this->calls[$name]();
        }

        return $this->shareItems[$name];
    }
}

