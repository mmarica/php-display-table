<?php
namespace Mmarica\DisplayTable\Input;


/**
 * CSV File Input Class
 */
class CsvFileInput extends AbstractInput
{
    const CSV_LENGTH = 'csv_length';
    const CSV_DELIMITER = 'csv_delimiter';
    const CSV_ENCLOSURE = 'csv_enclosure';
    const CSV_ESCAPE = 'csv_escape';

    /**
     * Csv File Input constructor
     *
     * @param string $filename    The csv file path and name
     * @param int    $headerCount (optional) The number of lines from the file that should be considered as header
     * @param array  $csvOptions  (optional) CSV specific options
     * @throws \Exception
     */
    public function __construct($filename, $headerCount = 1, $csvOptions = [])
    {
        // apply csv options (if any) over defaults
        $length = isset($csvOptions[self::CSV_LENGTH]) ? $csvOptions[self::CSV_LENGTH] : 16384;
        $delimiter = isset($csvOptions[self::CSV_DELIMITER]) ? $csvOptions[self::CSV_DELIMITER] : ',';
        $enclosure = isset($csvOptions[self::CSV_ENCLOSURE]) ? $csvOptions[self::CSV_ENCLOSURE] : '"';
        $escape = isset($csvOptions[self::CSV_ESCAPE]) ? $csvOptions[self::CSV_ESCAPE] : '\\';

        $handle = fopen($filename, 'r');

        if ($handle === false) {
            throw new \Exception(sprintf('Cannot open file "%s"', $filename));
        }

        $index = 0;
        while(true) {
            $line = fgetcsv($handle, $length, $delimiter, $enclosure, $escape);

            if ($line === false)
                break;

            if ($index < $headerCount)
                $this->_headerRows[] = $line;
            else
                $this->_dataRows[] = $line;

            $index++;
        }

        fclose($handle);
    }
}