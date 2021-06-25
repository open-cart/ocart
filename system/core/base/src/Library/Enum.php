<?php


namespace Ocart\Core\Library;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use ReflectionClass;
use ReflectionException;
use UnexpectedValueException;

class Enum implements CastsAttributes, \JsonSerializable, \Stringable
{

    /**
     * @var string
     */
    protected $value;

    /**
     * Store existing constants in a static cache per object.
     *
     * @var array
     */
    protected static $cache = [];

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    protected function init($value)
    {
        if (!$this->isValid($value)) {
            throw new UnexpectedValueException('Value ' . $value . ' is not part of the enum ' . get_called_class());
        }

        $this->value = $value;
    }

    /**
     * Check if is valid enum value
     *
     * @param $value
     *
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, static::toArray(), true);
    }

    public function __toString()
    {
        return (string) $this->value;
    }

    public function jsonSerialize()
    {
        return (string) $this->value;
    }

    public function toHtml()
    {
        return "<label>{$this->value}</label>";
    }

    /**
     * Transform the attribute from the underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $this->init($value);
        return $this;
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof static) {
            $this->value = $value->getValue();
        } else {
            $this->value = $value;
        }

        return $this->getValue();
    }

    /**
     * @param bool $includeDefault
     * @return array
     */
    public static function toArray(bool $includeDefault = false): array
    {
        $class = get_called_class();
        if (!isset(static::$cache[$class])) {
            try {
                $reflection = new ReflectionClass($class);
                static::$cache[$class] = $reflection->getConstants();
            } catch (ReflectionException $error) {
                info($error->getMessage());
            }
        }

        $result = static::$cache[$class];

        if (isset($result['__default']) && !$includeDefault) {
            unset($result['__default']);
        }

        return apply_filters(BASE_FILTER_ENUM_ARRAY, $result, get_called_class());;
    }

    /**
     * Returns instances of the Enum class of all Enum constants
     *
     * @return static[] name in key, Enum instance in value
     */
    public static function values()
    {
        $values = [];

        foreach (static::toArray() as $key => $value) {
            $values[$key] = $value;
        }

        return $values;
    }

    /**
     * @return array
     */
    public static function labels(): array
    {
        $result = [];

        foreach (static::toArray() as $value) {
            $result[$value] = static::getLabel($value);
        }

        return $result;
    }

    static function getLabel($value) {
        return trans('core/base::enums.statuses.'.$value);
    }

    /**
     * @return string
     */
    public function label(): ?string
    {
        return static::getLabel($this->getValue());
    }
}
