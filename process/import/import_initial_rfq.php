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

                // $date_reply_quotation = $line[17];
                // $leadtime = $line[18];
                // $quotation_no = $line[19];
                // $unit_price_jpy = $line[20];
                // $unit_price_usd = $line[21];
                // $total_amount = $line[22];

                // CHECK IF BLANK DATA
                if ($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' || $line[7] == '' || $line[8] == '' || $line[9] == '' || $line[10] == '' || $line[11] == '' || $line[12] == '' || $line[13] == '' || $line[15] == '' || $line[16] == '' || $line[17] == '') {
                    // IF BLANK DETECTED ERROR += 1
                    $error = $error + 1;
                } else {
                    $date_i_rfq = DateTime::createFromFormat('Y-m-d', $date_of_issuance_rfq);
                    $date_of_issuance_rfq = $date_i_rfq->format('Y-m-d');
                    $date_tdrq = DateTime::createFromFormat('Y-m-d', $target_date_reply_quotation);
                    $target_date_reply_quotation = $date_tdrq->format('Y-m-d');
                  

                    // CHECK DATA
                    $prevQuery = "SELECT id FROM joms_request WHERE request_id = '$request_id' AND status = 'pending'";
                    $res = $conn->prepare($prevQuery);
                    $res->execute();
                    if ($res->rowCount() > 0) {
                        foreach ($res->fetchALL() as $x) {
                            $id = $x['id'];
                        }

                        $insert = "INSERT INTO joms_rfq_process(`request_id`, `date_of_issuance_rfq`, `rfq_no`, `target_date_reply_quotation`, `i_uploaded_by`) VALUES ('$request_id','$date_of_issuance_rfq','$rfq_no','$target_date_reply_quotation', '" . $_SESSION['fullname'] . "')";
                        $stmt = $conn->prepare($insert);
                        if ($stmt->execute()) {
                            // $error = 0;
                            $stmt = NULL;
                            $query = "UPDATE joms_request SET status = 'open' WHERE id = '$id'";
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

                        $query = "SELECT request_id FROM joms_request WHERE request_id = '$request_id' AND status != 'pending'";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            foreach ($stmt->fetchALL() as $j) {
                                $request_id = $j['request_id'];

                                $stmt = NULL;
                                $query = "UPDATE joms_rfq_process SET date_of_issuance_rfq = '$date_of_issuance_rfq', rfq_no = '$rfq_no', target_date_reply_quotation = '$target_date_reply_quotation', i_uploaded_by = '" . $_SESSION['fullname'] . "', i_date_updated = '$server_date_time' WHERE request_id = '$request_id'";
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
                            var x = confirm("WITH ERROR! # OF ERRORS ' . $error . ' ");
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