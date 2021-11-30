<?php

namespace App\Library\CSV;

final class Columns {

    /**
     *
     */
    const EXCLUDE = [ 'racer', 'turn', 'time' ];

    /**
     *
     */
    const REQUIRED = [ 'racer', 'turn', 'time', 'race', 'year', 'country' ];

    /**
     * @param array $csvColumns
     * @return array
     */
    public static function selectable(array $csvColumns): array
    {
        return array_values(array_diff($csvColumns, self::EXCLUDE));
    }

}
