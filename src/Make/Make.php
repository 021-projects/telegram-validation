<?php

namespace TelegramWebApp\Validation\Make;

use Carbon\Carbon;
use ReflectionNamedType;
use ReflectionProperty;
use TelegramWebApp\Validation\Support\Arrayable;

abstract class Make extends Arrayable
{
    /**
     * @param array<string, int|string|bool> $props
     */
    public function __construct(array $props = [])
    {
        foreach ($props as $prop => $value) {
            $value = match ($prop) {
                'auth_date' => Carbon::createFromTimestamp((int) $value),
                default     => $value
            };
            $this->setProperty(camelize($prop), $value);
        }
    }

    protected function setProperty(string $property, mixed $value): void
    {
        if(!property_exists(get_class($this), $property)) {
            return;
        }

        $reflection = new ReflectionProperty(get_class($this), $property);

        $type = $reflection->getType();

        if(!($type instanceof ReflectionNamedType) || $type->isBuiltin()) {
            $this->$property = $value;
            return;
        }

        $class = $type->getName();

        $this->$property = is_subclass_of($class, self::class)
            ? new $class($this->tryParseJSON($value))
            : $value;
    }

    /**
     * @return array<string, int|string|bool>
     */
    protected function tryParseJSON(mixed $data): array
    {
        if(is_string($data)) {
            /** @var array<string, int|string|bool> $assoc */
            $assoc = json_decode($data, true);
            return $assoc;
        }
        return [];
    }
}
