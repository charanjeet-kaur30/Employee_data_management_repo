<!DOCTYPE html>
<html>
<head>
    <title>Report Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: red;
            font-size: 50px;
        }
        .report-details {
            margin-top: 20px;
        }
        .report-details p {
            font-size: 14px;
            line-height: 1.6;
        }
        .hd{
            color: green;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <h1>Report Details</h1>
    <div class="report-details">
        <p><strong class="hd">Title:</strong> <?php echo $report['title']; ?></p>
        <p><strong class="hd">Description:</strong> <?php echo $report['description']; ?></p>
        <p><strong class="hd">Date:</strong> <?php echo $report['date']; ?></p>
    </div>
</body>
</html>
