<?php declare(strict_types=1);

namespace bizley\migration\table;

use yii\base\BaseObject;

/**
 * Class TablePrimaryKey
 * @package bizley\migration\table
 */
class TablePrimaryKey extends BaseObject
{
    public const GENERIC_PRIMARY_KEY = 'PRIMARYKEY';

    /**
     * @var string
     */
    public $name;
    /**
     * @var array
     */
    public $columns = [];

    /**
     * Checks if primary key is composite.
     * @return bool
     */
    public function isComposite(): bool
    {
        return \count($this->columns) > 1;
    }

    /**
     * Renders the key.
     * @param TableStructure $table
     * @param int $indent
     * @return string
     */
    public function render(TableStructure $table, int $indent = 8): string
    {
        return str_repeat(' ', $indent) . "\$this->addPrimaryKey('"
            . ($this->name ?: self::GENERIC_PRIMARY_KEY)
            . "', '" . $table->renderName() . "', ['"
            . implode("', '", $this->columns)
            . "']);";
    }

    /**
     * Adds column to the key.
     * @param string $name
     */
    public function addColumn(string $name): void
    {
        if (!\in_array($name, $this->columns, true)) {
            $this->columns[] = $name;
        }
    }
}
