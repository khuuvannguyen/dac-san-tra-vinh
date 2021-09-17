<?php
class Rest extends DB
{
    function backup()
    {
        $tables = array();
        $result = mysqli_query($this->con, "SHOW TABLES");

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        $sqlScript = "";
        foreach ($tables as $table) {

            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($this->con, $query);
            $row = mysqli_fetch_row($result);

            $sqlScript .= "\n\n" . $row[1] . ";\n\n";


            $query = "SELECT * FROM $table";
            $result = mysqli_query($this->con, $query);

            $columnCount = mysqli_num_fields($result);

            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\n";
        }
        return $sqlScript;
    }

    function query($query)
    {
        $qr = $query;
        $type = explode(" ", filter_var(strtolower(trim($qr, " "))));
        $array = array();
        switch ($type[0]) {
            case 'select':
                try {
                    if ($result = mysqli_query($this->con, $qr)) {
                        $temp = mysqli_query($this->con, $qr);
                        if (mysqli_fetch_field($temp)) {
                            array_push($array, "<table border='1' width='100%'>");
                            array_push($array, "<tr style='text-align:center;'>");
                            while ($col = mysqli_fetch_field($result)) {
                                array_push($array, "<td>$col->name</td>");
                            }
                            array_push($array, "</tr>");
                            while ($row = mysqli_fetch_array($result)) {
                                array_push($array, "<tr>");
                                foreach ($row as $key => $value) {
                                    if (gettype($key) == "string") {
                                        array_push($array, "<td>$value</td>");
                                        // echo "<br>";
                                    }
                                }
                                array_push($array, "</tr>");
                                // echo "<br>";
                            }
                            array_push($array, "</table>");
                        }
                    } else {
                        array_push($array, "FALSE");
                    }
                } catch (TypeError $e) {
                    array_push($array, "FALSE");
                }
                break;

            default:
                $this->con->begin_transaction();
                if (mysqli_query($this->con, $qr)) {
                    $this->con->commit();
                    array_push($array, "TRUE");
                } else {
                    $this->con->rollback();
                    array_push($array, "FALSE");
                }
                break;
        }
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}
