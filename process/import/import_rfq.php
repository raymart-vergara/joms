<?php
session_start();
// error_reporting(0);
require '../conn.php';

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

    $message = "";
    $check_csv_row = 2;

    while (($line = fgetcsv($csvFile)) !== false) {
        $check_csv_row++;

        // Check if the row is blank or consists only of whitespace
        if (empty(implode('', $line))) {
            continue; // Skip blank lines
        }

        // CHECK IF BLANK DATA
        if (
            $line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' ||
            $line[7] == '' || $line[8] == '' || $line[9] == '' || $line[10] == '' || $line[11] == '' || $line[12] == '' ||
            $line[13] == '' || $line[15] == '' || $line[16] == '' || $line[17] == '' || $line[18] == '' || $line[19] == '' ||
            $line[20] == '' || $line[21] == '' || $line[22] == '' || $line[23] == '' || $line[24] == '' || $line[25] == '' || $line[26] == ''
        ) {
            // IF BLANK DETECTED ERROR
            $hasBlankError++;
            $hasError = 1;
            array_push($hasBlankErrorArr, $check_csv_row);
        }
    }
    ;
    fclose($csvFile);

    if ($hasError == 1) {
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
                //READ FILE
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // SKIP FIRST LINE
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
                    //pending
                    $request_id = $line[0];
                    $status = $line[1];
                    $carmaker = $line[2];
                    $carmodel = $line[3];
                    $product = $line[4];
                    $jigname = $line[5];
                    $drawing_no = $line[6];
                    $type = $line[7];
                    $qty = $line[8];
                    $purpose = $line[9];
                    $budget = $line[10];
                    $date_requested = $line[11];
                    $requested_by = $line[12];
                    $required_delivery_date = $line[13];
                    $remarks = $line[14];
                    //rfq
                    $date_of_issuance_rfq = $line[15];
                    $rfq_no = $line[16];
                    $target_date_reply_quotation = $line[17];

                    $date_reply_quotation = $line[18];
                    $leadtime = $line[19];
                    $quotation_no = $line[20];
                    $unit_price_jpy = $line[21];
                    $unit_price_usd = $line[22];
                    $total_amount = $line[23];

                    $fsib_no = $line[24];
                    $fsib_code = $line[25];
                    $date_sent_to_internal_signatories = $line[26];


                    //$date_i_rfq = DateTime::createFromFormat('m/d/Y', $date_of_issuance_rfq);
                    //$date_of_issuance_rfq = $date_i_rfq->format('Y-m-d');
                    //$date_tdrq = DateTime::createFromFormat('m/d/Y', $target_date_reply_quotation);
                    //$target_date_reply_quotation = $date_tdrq->format('Y-m-d');

                    $date_rq = str_replace('/', '-', $date_reply_quotation);
                    $date_reply_quotation = date("Y-m-d", strtotime($date_rq));

                    // $date_rq = DateTime::createFromFormat('Y-m-d', $date_reply_quotation);
                    // $date_reply_quotation = $date_rq->format('Y-m-d');

                    $date_dis = str_replace('/', '-', $date_sent_to_internal_signatories);
                    $date_sent_to_internal_signatories = date("Y-m-d", strtotime($date_dis));


                    // $date_dis = DateTime::createFromFormat('Y-m-d', $date_sent_to_internal_signatories);
                    // $date_sent_to_internal_signatories = $date_dis->format('Y-m-d');

                    // CHECK DATA
                    $prevQuery = "SELECT request_id FROM joms_request WHERE request_id = '$request_id' AND status = 'open'";
                    $res = $conn->prepare($prevQuery);
                    $res->execute();
                    if ($res->rowCount() > 0) {
                        foreach ($res->fetchALL() as $x) {
                            $request_id = $x['request_id'];
                        }

                        $query = "UPDATE joms_rfq_process SET 
                    date_reply_quotation = '$date_reply_quotation', 
                    leadtime = '$leadtime', 
                    quotation_no = '$quotation_no', 
                    unit_price_jpy = '$unit_price_jpy', 
                    unit_price_usd = '$unit_price_usd', 
                    total_amount = '$total_amount', 
                    fsib_no = '$fsib_no',
                    fsib_code = '$fsib_code',
                    date_sent_to_internal_signatories = '$date_sent_to_internal_signatories',
                    c_uploaded_by = '" . $_SESSION['fullname'] . "',
                    c_date_updated = '$server_date_time'
                    WHERE request_id = '$request_id'";

                        $stmt = $conn->prepare($query);
                        if ($stmt->execute()) {
                            $error = 0;
                        } else {
                            $error = $error + 1;
                        }

                    } else {
                        echo '<script>alert("No Data")</script>';
                    }
                }

                fclose($csvFile);
                if ($error == 0) {
                    echo '<script>
        var x = confirm("SUCCESS! # OF ERRORS ' . $error . ' ");
        if(x == true){
            location.replace("../../page/purchasing/set_rfq_po.php");
        }else{
            location.replace("../../page/purchasing/set_rfq_po.php");
        }
    </script>';
                }
            } else {
                echo 
                    '<script>
                        var x = confirm("' . $chkCsvMsg . ' ");
                        if(x == true){
                            location.replace("../../page/purchasing/set_rfq_po.php");
                        }else{
                            location.replace("../../page/purchasing/set_rfq_po.php");
                        }
                    </script>';
            }

        } else {
            echo 
                '<script>
                    var x = confirm("CSV FILE NOT UPLOADED!");
                    if(x == true){
                        location.replace("../../page/purchasing/set_rfq_po.php");
                    }else{
                        location.replace("../../page/purchasing/set_rfq_po.php");
                    }
                </script>';
        }
    } else {
        echo '<script>
        var x = confirm("INVALID FILE FORMAT!");
        if(x == true){
            location.replace("../../page/purchasing/set_rfq_po.php");
        }else{
            location.replace("../../page/purchasing/set_rfq_po.php");
        }
    </script>';
    }

}

// KILL CONNECTION
$conn = null;
?>