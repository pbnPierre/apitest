<?php
namespace Deezer\Command;

interface Command {
    public function execute(): bool;
}

