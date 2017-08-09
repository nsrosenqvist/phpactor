<?php

namespace Phpactor\UserInterface\Console\Dumper;

final class DumperRegistry
{
    private $default;
    private $dumpers = [];

    public function __construct(array $dumpers, string $default)
    {
        foreach ($dumpers as $name => $dumper) {
            $this->add($name, $dumper);
        }
        $this->default = $default;
    }

    public function get(string $name = null): Dumper
    {
        $name = $name ?: $this->default;
        if (!isset($this->dumpers[$name])) {
            throw new \InvalidArgumentException(sprintf(
                'Unknown dumper "%s", known dumpers: "%s"',
                $name,
                implode('", "', array_keys($this->dumpers))
            ));
        }

        return $this->dumpers[$name];
    }

    private function add(string $name, Dumper $dumper)
    {
        $this->dumpers[$name] = $dumper;
    }
}
