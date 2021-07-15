<?php


class Operation
{
    protected string $description;

    protected ?DateTime $executionDateTime;

    public function __construct(string $description)
    {
        $this->description = $description;
        $this->executionDateTime = null;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getExecutionDateTime(): DateTime
    {
        return $this->executionDateTime;
    }

    public function execute(): void
    {
        if(!is_null($this->executionDateTime)){
            echo 'cannot execute already executed operation';
        }

        $this->executionDateTime = new DateTime();
    }
}