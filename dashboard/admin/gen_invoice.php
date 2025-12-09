<?php
require '../../include/db_conn.php';
page_protect();
$etid = $_GET['etid'];
$pid = $_GET['pid'];
$uid = $_GET['id'];

$sql = "SELECT * FROM users u 
        INNER JOIN enrolls_to e ON u.userid=e.uid 
        INNER JOIN plan p ON p.pid=e.pid 
        WHERE userid='$uid' AND e.et_id='$etid'";
$res = mysqli_query($con, $sql);
if ($res) {
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>SPORTS CLUB | Invoice</title>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }

    .invoice-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .invoice-header img {
        max-width: 120px;
        height: auto;
    }

    .invoice-header h2 {
        margin: 0;
        color: #333;
    }

    .invoice-header div {
        text-align: right;
        color: #555;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: left;
        font-size: 14px;
    }

    table th {
        background-color: #6c8397;
        color: #fff;
        border-bottom: 2px solid #555;
    }

    .invoice-details p {
        margin: 6px 0;
        font-size: 15px;
    }

    .signature {
        margin-top: 50px;
        text-align: right;
        font-weight: bold;
        font-size: 14px;
    }

    .print-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.2s;
    }

    .print-btn:hover {
        background-color: #43a047;
    }
</style>

<script>
function myFunction() {
    var prt = document.getElementById("print");
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write('<html><head><title>Invoice</title>');
    WinPrint.document.write('<style>body{font-family:Roboto,sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left;}th{background-color:#6c8397;color:#fff;}</style>');
    WinPrint.document.write('</head><body >');
    WinPrint.document.write(prt.innerHTML);
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>

</head>

<body>
<button class="print-btn" onclick="myFunction()">PRINT INVOICE</button>

<div id="print" class="invoice-container">

    <div class="invoice-header">
        <div><img src="msc_logo_Blanc-1.png" alt="Gym Logo"></div>
        <div>
            <h2>TITAN GYM</h2>
            <p>Sotai Chenijan</p>
            <p>Jorhat</p>
        </div>
        <div>
            <p><strong>Serial No:</strong> <?php echo $row['et_id'] ?></p>
            <p><strong>Date:</strong> <?php echo $row['paid_date'] ?></p>
        </div>
    </div>

    <div class="invoice-details">
        <p><strong>Received with thanks from:</strong> <?php echo $row['username'] ?></p>
        <p><strong>Amount:</strong> ₹<?php echo $row['amount'] ?></p>
        <p><strong>Membership Plan:</strong> <?php echo $row['planName'] ?></p>
    </div>

    <div class="signature">
        Signature
    </div>

</div>
</body>
</html>
