<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table {
            border-collapse: collapse ;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid  #ddd;
        }
        img {
            width: 60px;
            height: 60px;
        }
    </style>
    <title>Document</title>
</head>
<body>
<?php
$customer_list = [
    "1" => ["name" => "Mai Văn Linh",
        "day_of_birth" => "1983-08-20",
        "sex" => "Nam",
        "address" => "Hà Nội",
        "profile" => "1.jpg"],
    "2" => ["name" => "Linh đẹp zai",
        "day_of_birth" => "1990-07-25",
        "sex" => "Nam",
        "address" => "Hà Nội",
        "profile" => "1.jpg"],
    "3" => ["name" => "Linh kube",
        "day_of_birth" => "1996-06-20",
        "sex" => "Nam",
        "address" => "Hà Nội",
        "profile" => "1.jpg"],
    "4" => ["name" => "Linh ngáo ngơ",
        "day_of_birth" => "1988-05-20",
        "sex" => "Nam",
        "address" => "Hà Nội",
        "profile" => "1.jpg"],
    "5" => ["name" => "Linh Pro",
        "day_of_birth" => "1902-04-20",
        "sex" => "Nam",
        "address" => "Hà Nội",
        "profile" => "1.jpg"],

];

function searchBydate($customers,$from_date,$to_date) {
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer["day_of_birth"]) > strtotime($to_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer["day_of_birth"]) > strtotime($to_date)))
            continue;
//        if (!empty($from_name) && (strtotime($customer["name"]) > strtotime($to_name)))
//            continue;
//        if (!empty($to_name) && (strtotime($customer["name"]) > strtotime($to_name)))
//            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

?>

<?php

$from_date = NULL;
$to_date = NULL;
$from_name = NULL;
$to_name = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
//    $from_name = $_POST["from"];
//    $to_name = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);

?>
<form method="post">
    <span>From:
        <input type="text" name="from" placeholder="yyyy-mm-dd && name">
    </span>
    <span>To:
        <input type="text" name="to" placeholder="yyyy-mm-dd && name">
    </span>
    <span>
        <input type="submit" name="search" value="search">
    </span>
</form>



<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>

    <?php if(count($filtered_customers) === 0):?>
        <tr>
            <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
        </tr>
    <?php endif; ?>


    <?php foreach($filtered_customers as $index=> $customer): ?>
        <tr>
            <td><?php echo $index + 1;?></td>
            <td><?php echo $customer['name'];?></td>
            <td><?php echo $customer['day_of_birth'];?></td>
            <td><?php echo $customer['sex'];?></td>
            <td><?php echo $customer['address'];?></td>
            <td><div class="profile"><img src="<?php echo $customer['profile'];?>"/></div>
            </td>
        </tr>


    <?php endforeach; ?>
</table>
</body>
</html>