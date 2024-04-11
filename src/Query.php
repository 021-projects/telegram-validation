<?php

namespace Telegram\Validation;

class Query
{
    public array $data = [];

    public function __construct(array|string $data)
    {
        $this->data = is_string($data) ? self::unpack($data) : $data;
    }

    public function pack(bool $ridHash = false): string
    {
        $data = $this->data;
        if ($ridHash) {
            unset($data['hash']);
        }

        $joined = $this->join($data);
        sort($joined);
        return $this->implode($joined);
    }

    public function get(string $name, $default = null): mixed
    {
        return data_get($this->data, $name, $default);
    }

    /**
     * @param  array<string, int|string|bool>  $data
     * @return array<int, string>
     */
    protected function join(array $data): array
    {
        return array_map(
            static fn($value, $key) => $key.'='.$value,
            $data,
            array_keys($data)
        );
    }

    /**
     * @param  array<int, string>  $data
     */
    protected function implode(array $data): string
    {
        return implode("\n", $data);
    }

    protected static function unpack(string $str): array
    {
        $rawData = explode('&', rawurldecode($str));

        return array_merge(...array_map(
            static function ($item) {
                if (! str_contains($item, '=')) {
                    return [];
                }
                [$prop, $value] = explode('=', $item);
                return [$prop => $value];
            },
            $rawData
        ));
    }
}
