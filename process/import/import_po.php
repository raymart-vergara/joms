<?php
session_start();
// error_reporting(0);
require '../conn.php';
if (isset($_POST['upload'])) {
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
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
                $date_reply_quotation = $line[18];
                $leadtime = $line[19];
                $quotation_no = $line[20];
                $unit_price_jpy = $line[21];
                $unit_price_usd = $line[22];
                $total_amount = $line[23];

                $fsib_no = $line[24];
                $fsib_code = $line[25];
                $date_sent_to_internal_signatories = $line[26];
                //po

                $target_approval_date_of_quotation = $line[27];
                $approval_date_of_quotation = $line[28];
                $target_date_submission_to_purchasing = $line[29];
                $actual_date_of_submission_to_purchasing = $line[30];
                $target_po_date = $line[31];
                $po_date = $line[32];
                $po_no = $line[33];
                $ordering_additional_details = $line[34];
                // $car_model_for_formula = $line[35];
                $supplier = $line[35];
                // $start_of_usage = $line[37];
                // $required_delivery_date2 = $line[38];
                $etd = $line[36];
                $eta = $line[37];
                $actual_arrival_date = $line[38];
                $invoice_no = $line[39];
                $classification = $line[40];
                $remarks2 = $line[41];

                // CHECK IF BLANK DATA
                if (
                    $line[0] == '' || $line[27] == '' || $line[28] == '' || $line[29] == '' || $line[30] == '' ||
                    $line[31] == '' || $line[32] == '' || $line[33] == '' || $line[34] == '' || $line[35] == '' ||
                    $line[36] == '' || $line[37] == '' || $line[38] == '' || $line[39] == '' || $line[40] == '' ||
                    $line[41] == ''
                ) {
                    // IF BLANK DETECTED ERROR += 1
                    $error = $error + 1;
                } else {

                    $date_tadoq = DateTime::createFromFormat('Y-m-d', $target_approval_date_of_quotation);
                    $target_approval_date_of_quotation = $date_tadoq->format('Y-m-d');

                    $date_adoq = DateTime::createFromFormat('Y-m-d', $approval_date_of_quotation);
                    $approval_date_of_quotation = $date_adoq->format('Y-m-d');

                    $date_tdstp = DateTime::createFromFormat('Y-m-d', $target_date_submission_to_purchasing);
                    $target_date_submission_to_purchasing = $date_tdstp->format('Y-m-d');

                    $date_adostp = DateTime::createFromFormat('Y-m-d', $actual_date_of_submission_to_purchasing);
                    $actual_date_of_submission_to_purchasing = $date_adostp->format('Y-m-d');

                    $date_tpd = DateTime::createFromFormat('Y-m-d', $target_po_date);
                    $target_po_date = $date_tpd->format('Y-m-d');

                    $date_pd = DateTime::createFromFormat('Y-m-d', $po_date);
                    $po_date = $date_pd->format('Y-m-d');

                    // $date_sou = DateTime::createFromFormat('m/d/Y', $start_of_usage);
                    // $start_of_usage = $date_sou->format('Y-m-d');

                    // $date_rdd = DateTime::createFromFormat('m/d/Y', $required_delivery_date2);
                    // $required_delivery_date2 = $date_rdd->format('Y-m-d');

                    $date_aad = DateTime::createFromFormat('Y-m-d', $actual_arrival_date);
                    $actual_arrival_date = $date_aad->format('Y-m-d');

                    // $date_r = DateTime::createFromFormat('m/d/Y', $date_requested);
                    // $date_requested = $date_r->format('Y-m-d');
                    // $date_rdd = DateTime::createFromFormat('m/d/Y', $required_delivery_date);
                    // $required_delivery_date = $date_rdd->format('Y-m-d');

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
                        $insert = "INSERT INTO joms_po_process(`request_id`, `target_approval_date_of_quotation`, `approval_date_of_quotation`, `target_date_submission_to_purchasing`, `actual_date_of_submission_to_purchasing`, `target_po_date`, `po_date`, `po_no`, `ordering_additional_details`, `supplier`, `etd`, `eta`, `actual_arrival_date`, `invoice_no`, `classification`, `remarks`, `uploaded_by`) 
                                    VALUES ('$request_id', '$target_approval_date_of_quotation', '$approval_date_of_quotation', '$target_date_submission_to_purchasing', '$actual_date_of_submission_to_purchasing', '$target_po_date', '$po_date', '$po_no', '$ordering_additional_details', '$supplier', '$etd', '$eta', '$actual_arrival_date', '$invoice_no', '$classification', '$remarks2', '" . $_SESSION['fullname'] . "')";
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
                                        target_approval_date_of_quotation = '$target_approval_date_of_quotation',
                                        approval_date_of_quotation = '$approval_date_of_quotation',
                                        target_date_submission_to_purchasing = '$target_date_submission_to_purchasing',
                                        actual_date_of_submission_to_purchasing = '$actual_date_of_submission_to_purchasing',
                                        target_po_date = '$target_po_date',
                                        po_date = '$po_date',
                                        po_no = '$po_no',
                                        ordering_additional_details = '$ordering_additional_details',
                                        supplier = '$supplier',
                                        etd = '$etd', 
                                        eta = '$eta',
                                        actual_arrival_date = '$actual_arrival_date',
                                        invoice_no = '$invoice_no',
                                        classification = '$classification',
                                        remarks = '$remarks2', 
                                        uploaded_by = '" . $_SESSION['fullname'] . "' WHERE request_id = '$request_id'";
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
                        var x = confirm("CSV FILE NOT UPLOADED! # OF ERRORS ' . $error . ' ");
                        if(x == true){
                            location.replace("../../page/purchasing/set_rfq_po.php");
                        }else{
                            location.replace("../../page/purchasing/set_rfq_po.php");
                        }
                    </script>';
        }
    } else {
        echo '<script>
                        var x = confirm("INVALID FILE FORMAT! # OF ERRORS ' . $error . ' ");
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