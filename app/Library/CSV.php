<?php

namespace App\Library;

use App\Exceptions\InvalidCsvException;
use App\Library\CSV\Columns;
use App\Library\CSV\Validate\Type;
use App\Library\CSV\Validate\Value;
use League\Csv\Statement;

class CSV extends Report {

    /**
     * @var \League\Csv\Reader
     */

    private \League\Csv\Reader $reader;
    /**
     * @var \League\Csv\Statement
     */

    private Statement $statement;
    /**
     * @var array
     */
    private array $csvColumns;

    /**
     * @param \League\Csv\Reader $reader
     * @param \League\Csv\Statement $statement
     */

    public function __construct(\League\Csv\Reader $reader, Statement $statement)
    {
        $this->reader = $reader;
        $this->statement = $statement;
    }
    /**
     * @return int
     */

    /**
     * @return array
     */
    public function filterOptions(): array
    {
        return Columns::selectable($this->csvColumns);
    }

    /**
     * @return bool
     * @throws \App\Exceptions\InvalidCsvException
     * @throws \League\Csv\Exception
     */
    public function validate(): bool
    {
        $this->reader->setHeaderOffset(0);
        $records = $this->statement->process($this->reader);

        $this->validateHeader($records->getHeader());

        $this->validateContent($records);

        return true;
    }

    /**
     * @param array $header
     * @throws \App\Exceptions\InvalidCsvException
     */
    private function validateHeader(array $header): void
    {
        $this->csvColumns = $header;

        if (count(array_diff(Columns::REQUIRED, $this->csvColumns)))
        {
            throw new InvalidCsvException('Incorrect CSV Columns');
        }
    }

    /**
     * @param \League\Csv\TabularDataReader $records
     * @throws \App\Exceptions\InvalidCsvException
     */
    private function validateContent(\League\Csv\TabularDataReader $records)
    {
        $numberOfRecords = 0;
        foreach ( $records as $key => $record )
        {
            $validate[] = $record;
            if ($key % 4 == 0)
            {
                $this->validateGroup($validate, $key);
                $validate = [];
            }
            $numberOfRecords ++;
        }
        if ($numberOfRecords < 4 || $numberOfRecords % 4 !== 0)
        {
            throw new InvalidCsvException('Invalid CSV file');
        }
    }

    /**
     * @param array $group
     * @return void
     * @throws \App\Exceptions\InvalidCsvException
     */
    private function validateGroup(array $group, $key): void
    {
        for ( $i = 0; $i < 4; $i ++ )
        {
            if ($i !== 0)
            {
                foreach ( Columns::REQUIRED as $column )
                {
                    if (!call_user_func(Type::class . "::{$column}", $group[$i][$column]))
                    {
                        throw new InvalidCsvException('Incorrect type at line ' . ($key - 1));
                    };
                    if (!call_user_func(Value::class . "::{$column}", $group[$i][$column], $group[$i - 1][$column]))
                    {
                        throw new InvalidCsvException('Incorrect value at line ' . ($key - 1));
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    public function findBestMatch(): array
    {
        $records = $this->statement->process($this->reader);

        $filterIndex = array_search($this->getFilter(), $this->csvColumns);

        $team = [];
        foreach ( $records as $record )
        {
            if ($record[$this->csvColumns[$filterIndex]] == $this->getFilterValue())
            {
                if (array_key_exists($record['racer'], $team))
                {
                    if ($team[$record['racer']] > (float) $record['time'])
                    {
                        $team[$record['racer']] = (float) $record['time'];
                    }
                } else
                {
                    $team[$record['racer']] = (float) $record['time'];
                }
            }
        }
        asort($team);

        return array_slice($team, 0, 4, true);
    }
}
