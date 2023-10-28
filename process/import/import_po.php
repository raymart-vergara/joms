<?php
session_start();
// error_reporting(0);
require '../conn.php';

function validate_date($date)
{
    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
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

    $row_valid_arr = array(0, 0, 0);

    $notValidApprovalDateOfQuotation = array();
    $notValildTargetDateSubmissionPurchasing = array();
    $notValidAcutalDateSumbmissionPurchasing = array();
    $notVaidTargetPODate = array();
    $notValidPODate = array();
    $notValidActualArrivalDate = array();

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
            $line[0] == ''  || $line[27] == '' || $line[28] == '' || $line[29] == '' || $line[30] == '' ||
            $line[31] == '' || $line[32] == '' || $line[33] == '' || $line[34] == '' || $line[35] == '' ||
            $line[36] == '' || $line[37] == '' || $line[38] == '' || $line[39] == '' || $line[40] == '' ||
            $line[41] == ''
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
                    $item_code = $line[18];
                    $date_reply_quotation = $line[19];
                    $leadtime = $line[20];
                    $quotation_no = $line[21];
                    $unit_price_jpy = $line[22];
                    $unit_price_usd = $line[23];
                    $unit_price_php = $line[24];
                    $total_amount = $line[25];
                    $fsib_no = $line[26];
                    $fsib_code = $line[27];
                    $date_sent_to_internal_signatories = $line[28];
                    $target_approval_date_of_quotation = $line[29];
                    //po
                    $approval_date_of_quotation = $line[30];
                    $target_date_submission_to_purchasing = $line[31];
                    $actual_date_of_submission_to_purchasing = $line[32];
                    $target_po_date = $line[33];
                    $po_date = $line[34];
                    $po_no = $line[35];
                    $supplier = $line[36];
                    $etd = $line[37];
                    $eta = $line[38];
                    $actual_arrival_date = $line[39];
                    $invoice_no = $line[40];
                    // $classification = $line[42];
                    $remarks2 = $line[41];

                    // CHECK IF BLANK DATA
                    $date_adoq = str_replace('/', '-', $approval_date_of_quotation);
                    $approval_date_of_quotation = date("Y-m-d", strtotime($date_adoq));

                    $date_tdstp = str_replace('/', '-', $target_date_submission_to_purchasing);
                    $target_date_submission_to_purchasing = date("Y-m-d", strtotime($date_tdstp));

                    $date_adostp = str_replace('/', '-', $actual_date_of_submission_to_purchasing);
                    $actual_date_of_submission_to_purchasing = date("Y-m-d", strtotime($date_adostp));

                    $date_tpd = str_replace('/', '-', $target_po_date);
                    $target_po_date = date("Y-m-d", strtotime($date_tpd));

                    $date_pd = str_replace('/', '-', $po_date);
                    $po_date = date("Y-m-d", strtotime($date_pd));

                    $date_aad = str_replace('/', '-', $actual_arrival_date);
                    $actual_arrival_date = date("Y-m-d", strtotime($date_aad));

                    // CHECK DATA
                    $prevQuery = "SELECT joms_request.id FROM joms_request 
                         LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id 
                         WHERE joms_request.request_id = '$request_id' AND joms_request.status = 'open' AND joms_rfq_process.date_of_issuance_rfq != ''";

                    $res = $conn->prepare($prevQuery);
                    $res->execute();
                    if ($res->rowCount() > 0) {
                        foreach ($res->fetchALL() as $x) {
                            $id = $x['id'];
                        }
                        $insert = "INSERT INTO joms_po_process(`request_id`, `approval_date_of_quotation`, `target_date_submission_to_purchasing`, `actual_date_of_submission_to_purchasing`, `target_po_date`, `po_date`, `po_no`, `supplier`, `etd`, `eta`, `actual_arrival_date`, `invoice_no`,`remarks`, `po_uploaded_by`) 
                         VALUES ('$request_id', '$approval_date_of_quotation', '$target_date_submission_to_purchasing', '$actual_date_of_submission_to_purchasing', '$target_po_date', '$po_date', '$po_no',  '$supplier', '$etd', '$eta', '$actual_arrival_date', '$invoice_no', '$remarks2', '" . $_SESSION['fullname'] . "')";
                        $stmt = $conn->prepare($insert);
                        if ($stmt->execute()) {
                            // $error = 0;
                            $stmt = NULL;
                            $query = "UPDATE joms_request SET status = 'closed' WHERE id = '$id'";
                            $stmt = $conn->prepare($query);
                            if ($stmt->execute()) {
                                $error = 0;
                            } else {
                                $error = $error + 1;
                            }
                        } else {
                            $error = $error + 1;
                        }

                    } else {
                        $stmt = NULL;

                        $query = "SELECT joms_request.request_id FROM joms_request 
                         LEFT JOIN joms_rfq_process ON joms_rfq_process.request_id = joms_request.request_id 
                         WHERE joms_request.request_id = '$request_id'  AND joms_request.status = 'closed' AND joms_rfq_process.date_of_issuance_rfq != ''";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            foreach ($stmt->fetchALL() as $j) {
                                $request_id = $j['request_id'];
                                $stmt = NULL;
                                $query = "UPDATE joms_po_process SET 
                               
                                approval_date_of_quotation = '$approval_date_of_quotation',
                                target_date_submission_to_purchasing = '$target_date_submission_to_purchasing',
                                actual_date_of_submission_to_purchasing = '$actual_date_of_submission_to_purchasing',
                                target_po_date = '$target_po_date',
                                po_date = '$po_date',
                                po_no = '$po_no',
                                -- ordering_additional_details = '$ordering_additional_details',
                                supplier = '$supplier',
                                etd = '$etd', 
                                eta = '$eta',
                                actual_arrival_date = '$actual_arrival_date',
                                invoice_no = '$invoice_no',
                                -- classification = '$classification',
                                remarks = '$remarks2', 
                                po_uploaded_by = '" . $_SESSION['fullname'] . "' WHERE request_id = '$request_id'";
                                $stmt = $conn->prepare($query);
                                if ($stmt->execute()) {
                                    $error = 0;
                                } else {
                                    $error = $error + 1;
                                }
                            }
                        }
                    }
                }

                fclose($csvFile);
                if ($error == 0) {
                    echo '<script>
                    var x = confirm("SUCCESS!");
                    if(x == true){
                        location.replace("../../page/purchasing/set_rfq_po.php");
                    }else{
                        location.replace("../../page/purchasing/set_rfq_po.php");
                    }
                </script>';
                } else {
                    echo '<script>
                    var x = confirm("WITH ERROR! # OF ERRORS ' . $error . '");
                    if(x == true){
                        location.replace("../../page/purchasing/set_rfq_po.php");
                    }else{
                        location.replace("../../page/purchasing/set_rfq_po.php");
                    }
                </script>';
                }
            } else {
                echo '<script>
                var x = confirm("' . $chkCsvMsg . '");
                            if(x == true){
                                location.replace("../../page/purchasing/set_rfq_po.php");
                            }else{
                                location.replace("../../page/purchasing/set_rfq_po.php");
                            }
                        </script>';
            }

        } else {
            echo '<script>
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