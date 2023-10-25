<?php
session_start();
// error_reporting(0);
require '../conn.php';

function generate_joms_request_id($request_id)
{
    if ($request_id == "") {
        $request_id = date("ymdh");
        $rand = substr(md5(microtime()), rand(0, 26), 5);
        $request_id = 'JOMS:' . $request_id;
        $request_id = $request_id . '' . $rand;
    }
    return $request_id;
}

function update_notif_count_joms_request($conn)
{
    $sql = "UPDATE `notif_joms_request` SET `new_joms_request`= new_joms_request + 1 WHERE interface = 'AME3'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function validate_date($date) {
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
        return true;
    } else {
        return false;
    }
}

function check_csv($file, $conn)
{
    // READ FILE
    $csvFile = fopen($file, 'r');
    // SKIP FIRST LINE MAIN
    fgetcsv($csvFile);
    // SKIP 2ND LINE HEADER EXAMPLE
    fgetcsv($csvFile);

    $hasError = 0;
    $hasBlankError = 0;
    $hasBlankErrorArr = array();

    $row_valid_arr = array(0,0);

    $notValidDateRequested = array();
    $notValidRequiredDeliveryDate = array();

    $message = "";
    $check_csv_row = 2;

    while (($line = fgetcsv($csvFile)) !== false) {
        $check_csv_row++;

        // Check if the row is blank or consists only of whitespace
        if (empty(implode('', $line))) {
            continue; // Skip blank lines
        }

        $date_r = str_replace('/', '-', $line[9]);
        $is_valid_date_requested = validate_date($date_r);
        $date_rdd = str_replace('/', '-', $line[11]);
        $is_valid_required_delivery_date = validate_date($date_rdd);

        // CHECK IF BLANK DATA
        if ($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[5] == '' || $line[6] == '' || $line[7] == '' || $line[8] == '' || $line[9] == '' || $line[10] == '' || $line[11] == '') {
            // IF BLANK DETECTED ERROR
            $hasBlankError++;
            $hasError = 1;
            array_push($hasBlankErrorArr, $check_csv_row);
        }

        // CHECK ROW VALIDATION
        if ($is_valid_date_requested == false) {
            $hasError = 1;
            $row_valid_arr[0] = 1;
            array_push($notValidDateRequested, $check_csv_row);
        }
        if ($is_valid_required_delivery_date == false) {
            $hasError = 1;
            $row_valid_arr[1] = 1;
            array_push($notValidRequiredDeliveryDate, $check_csv_row);
        }
    }
    
    fclose($csvFile);

    if ($hasError == 1) {
        if ($row_valid_arr[0] == 1) {
            $message = $message . 'Invalid Date Requested on row/s ' . implode(", ", $notValidDateRequested) . '. ';
        }
        if ($row_valid_arr[1] == 1) {
            $message = $message . 'Invalid Required Delivery Date on row/s ' . implode(", ", $notValidRequiredDeliveryDate) . '. ';
        }

        if ($hasBlankError >= 1) {
            $message = $message . 'Blank Cell Exists on row/s ' . implode(", ", $hasBlankErrorArr) . '. ';
        }
    }
    return $message;
}

if (isset($_POST['upload'])) {
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            // Check CSV before importing
            $chkCsvMsg = check_csv($_FILES['file']['tmp_name'], $conn);

            if ($chkCsvMsg == '') {
                // If no errors found

                //READ FILE
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // SKIP FIRST LINE MAIN
                fgetcsv($csvFile);
                // SKIP 2ND LINE HEADER EXAMPLE
                fgetcsv($csvFile);
                // PARSE
                $error = 0;

                while (($line = fgetcsv($csvFile)) !== false) {
                    // Check if the row is blank or consists only of whitespace
                    if (empty(implode('', $line))) {
                        continue; // Skip blank lines
                    }
                    $carmaker = $line[0];
                    $carmodel = $line[1];
                    $product = $line[2];
                    $jigname = $line[3];
                    $drawing_no = $line[4];
                    $type = $line[5];
                    $qty = $line[6];
                    $purpose = $line[7];
                    $budget = $line[8];
                    $date_requested = $line[9];
                    $requested_by = $line[10];
                    $required_delivery_date = $line[11];
                    $remarks = $line[12];

                    $date_r = str_replace('/', '-', $date_requested);
                    $date_requested = date("Y-m-d", strtotime($date_r));

                    $date_rdd = str_replace('/', '-', $required_delivery_date);
                    $required_delivery_date = date("Y-m-d", strtotime($date_rdd));

                    $request_id = '';
                    $request_id = generate_joms_request_id($request_id);

                    $insert = "INSERT INTO joms_request(`request_id`, `carmaker`, `carmodel`, `product`, `jigname`, `drawing_no`, `type`, `qty`, `purpose`, `budget`, `date_requested`, `requested_by`, `required_delivery_date`, `remarks`, `uploaded_by`, `section`) VALUES ('$request_id','$carmaker','$carmodel','$product','$jigname','$drawing_no','$type','$qty','$purpose','$budget','$date_requested','$requested_by','$required_delivery_date','$remarks','" . $_SESSION['fullname'] . "','" . $_SESSION['section'] . "')";
                    $stmt = $conn->prepare($insert);
                    if ($stmt->execute()) {
                        update_notif_count_joms_request($conn);
                        $error = 0;
                    } else {
                        $error = $error + 1;
                    }
                }

                fclose($csvFile);

                if ($error == 0) {
                    //update_notif_count_joms_request($conn);
                    echo '<script>
                        var x = confirm("SUCCESS!");
                        if(x == true){
                            location.replace("../../page/requester/import_request.php");
                        }else{
                            location.replace("../../page/requester/import_request.php");
                        }
                    </script>';
                } else {
                    echo '<script>
                        var x = confirm("WITH ERROR! # OF ERRORS ' . $error . ' ");
                        if(x == true){
                            location.replace("../../page/requester/import_request.php");
                        }else{
                            location.replace("../../page/requester/import_request.php");
                        }
                    </script>';
                }
            } else {
                // If errors found
                echo '<script>
                        var x = confirm("' . $chkCsvMsg . '");
                        if(x == true){
                            location.replace("../../page/requester/import_request.php");
                        }else{
                            location.replace("../../page/requester/import_request.php");
                        }
                    </script>';
            }
        } else {
            echo '<script>
                        var x = confirm("CSV FILE NOT UPLOADED!");
                        if(x == true){
                            location.replace("../../page/requester/import_request.php");
                        }else{
                            location.replace("../../page/requester/import_request.php");
                        }
                    </script>';
        }
    } else {
        echo '<script>
                        var x = confirm("INVALID FILE FORMAT!");
                        if(x == true){
                            location.replace("../../page/requester/import_request.php");
                        }else{
                            location.replace("../../page/requester/import_request.php");
                        }
                    </script>';
    }

}

// KILL CONNECTION
$conn = null;
?>