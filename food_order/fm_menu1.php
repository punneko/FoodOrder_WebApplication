<?php include('connect.php') ?>

<?php

if(isset($_POST["submit"])){
  // รับข้อมูล cartForSend และ status จากฟอร์ม
  
if(isset($_COOKIE['FoodOrder'])) {
    $cookieValue = $_COOKIE['FoodOrder'];

   
  $food = $_POST['food'];

  $status = $_POST['status'];


  
  // วนลูปผ่านข้อมูลใน $food
  $foodList = '';
  foreach($food as $row){
    $foodList .= $row . ",";
  }

  // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลลงในฐานข้อมูล
  $sql2 = "INSERT INTO orders (id, food, status) VALUES ('', '$cookieValue', '$status')";

  // ส่งคำสั่ง SQL ไปที่ฐานข้อมูล
  $res2=mysqli_query($conn, $sql2);

} 


}


?>

<!DOCTYPE html>
<html>
    <html lang="th">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
    Fēngqù Málà
</title>
<link rel="shortcut icon" href="../images/malatang.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/fm.css">

</head>
<body>
  <a class="langB">TH</a>  
  <a class="langB" href="fm_menu.php">EN</a>   
<h1 class="FM" style="text-align: left;"><img src="../images/malatang_h1.png" style="height: 50px;" > Fēngqù Málà </h1>


<button class="tablink" onclick="openPage('soup', this, '#990000')" id="defaultOpen">น้ำซุป</button>
<button class="tablink" onclick="openPage('noodle', this, '#990000')">เส้น</button>
<button class="tablink" onclick="openPage('meat', this, '#990000')">เนื้อสัตว์</button>
<button class="tablink" onclick="openPage('vegetables', this, '#990000')">ผัก</button>
<button class="tablink" onclick="openPage('additional', this, '#990000')">องค์ประกอบเพิ่มเติม</button>
<button class="tablink" onclick="openPage('receipt', this, '#990000')">สรุปรายการ</button>


<!-- ตะกร้า -->

<!-- Soup -->
<div id="soup" class="tabcontent">
    <h1 style="color: #990000; font-size: 100px; margin-top: 0; background: -webkit-linear-gradient(#fb6565, #f31e1e);
  background-clip: text; -webkit-text-fill-color: transparent;">น้ำซุป</h1>
  <div class="menu">
    <?php
      $sql = "SELECT * FROM foodTH WHERE active = 'Yes' AND category_id = 2 ";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          //get the value
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $category_id = $row['category_id'];
          $active = $row['active'];
      ?>

          <div class="menu-item">
            <?php 
              if($image_name == "") {
                echo "<div>Image not Available.</div>";
              }else{
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Mala(mild)">
                <?php
              }
            ?>
            <h2><?php echo $title?></h2>
            <p><?php echo $description?></p>
            <p><?php echo $price?></p>
            <button class="del" style="padding: 20px;" onclick="delFromCart('<?php echo $title; ?>', '<?php echo $price; ?>')"> ลบ </button>
            <button class="add" onclick="addToCart('<?php echo $title; ?>', '<?php echo $price; ?>')">เพิ่ม</button>
          </div>
      <?php
        }
      } else {
        echo "<div class='error'>Food not Found.</div>";
      }
      ?>
    <!-- เพิ่มเมนูเพิ่มได้ตามต้องการ -->
  </div>
  
  
  <a onclick="openPage('noodle', this)" class="next">เลือกเส้น &raquo;</a><br><br>
</div>

<!-- Noodles -->
<div id="noodle" class="tabcontent">
  <h1 style="color: #990000; font-size: 100px; margin-top: 0; background: -webkit-linear-gradient(#fb6565, #f31e1e);
  background-clip: text; -webkit-text-fill-color: transparent;">เส้น</h1>
  <div class="menu">
    <?php
      $sql = "SELECT * FROM foodTH WHERE active = 'Yes' AND category_id = 3 ";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          //get the value
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $category_id = $row['category_id'];
          $active = $row['active'];
      ?>

          <div class="menu-item">
            <?php 
              if($image_name == "") {
                echo "<div>Image not Available.</div>";
              }else{
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Mala(mild)">
                <?php
              }
            ?>
            <h2><?php echo $title?></h2>
            <p><?php echo $description?></p>
            <p><?php echo $price?></p>
            <button class="del" style="padding: 20px;" onclick="delFromCart('<?php echo $title; ?>', '<?php echo $price; ?>')">ลบ</button>
            <button class="add" onclick="addToCart('<?php echo $title; ?>', '<?php echo $price; ?>')">เพิ่ม</button>
          </div>
      <?php
        }
      } else {
        echo "<div class='error'>Food not Found.</div>";
      }
      ?>
    
    </div>
    <a onclick="openPage('soup', this)" class="previous">&laquo; เลือกซุป</a>
    <a onclick="openPage('meat', this)" class="next">เลือกเนื้อ &raquo;</a><br><br>
</div>
  
<!-- Meats -->
<div id="meat" class="tabcontent">
  <h1 style="color: #990000; font-size: 100px; margin-top: 0; background: -webkit-linear-gradient(#fb6565, #f31e1e);
  background-clip: text; -webkit-text-fill-color: transparent;">เนื้อสัตว์</h1>
  <div class="menu">
    <?php
      $sql = "SELECT * FROM foodTH WHERE active = 'Yes' AND category_id = 4 ";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          //get the value
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $category_id = $row['category_id'];
          $active = $row['active'];
      ?>

          <div class="menu-item">
            <?php 
              if($image_name == "") {
                echo "<div>Image not Available.</div>";
              }else{
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Mala(mild)">
                <?php
              }
            ?>
            <h2><?php echo $title?></h2>
            <p><?php echo $description?></p>
            <p><?php echo $price?></p>
            <button class="del" style="padding: 20px;" onclick="delFromCart('<?php echo $title; ?>', '<?php echo $price; ?>')">ลบ</button>
            <button class="add" onclick="addToCart('<?php echo $title; ?>', '<?php echo $price; ?>')">เพิ่ม</button>
          </div>
      <?php
        }
      } else {
        echo "<div class='error'>Food not Found.</div>";
      }
      ?>
    <!-- เพิ่มเมนูเพิ่มได้ตามต้องการ -->
  </div>
  <a onclick="openPage('noodle', this)" class="previous">&laquo; เลือกเส้น</a>
  <a onclick="openPage('vegetables', this)" class="next">เลือกผัก &raquo;</a><br><br>
</div>

<!-- Vegetables -->
<div id="vegetables" class="tabcontent">
  <h1 style="color: #990000; font-size: 100px; margin-top: 0; background: -webkit-linear-gradient(#fb6565, #f31e1e);
  background-clip: text; -webkit-text-fill-color: transparent;">ผัก</h1>
  <div class="menu">
    <?php
      $sql = "SELECT * FROM foodTH WHERE active = 'Yes' AND category_id = 5 ";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          //get the value
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $category_id = $row['category_id'];
          $active = $row['active'];
      ?>

          <div class="menu-item">
            <?php 
              if($image_name == "") {
                echo "<div>Image not Available.</div>";
              }else{
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Mala(mild)">
                <?php
              }
            ?>
            <h2><?php echo $title?></h2>
            <p><?php echo $description?></p>
            <p><?php echo $price?></p>
            <button class="del" style="padding: 20px;" onclick="delFromCart('<?php echo $title; ?>', '<?php echo $price; ?>')">ลบ</button>
            <button class="add" onclick="addToCart('<?php echo $title; ?>', '<?php echo $price; ?>')">เพิ่ม</button>
          </div>
      <?php
        }
      } else {
        echo "<div class='error'>Food not Found.</div>";
      }
      ?>
    <!-- เพิ่มเมนูเพิ่มได้ตามต้องการ -->
  </div>
  <a onclick="openPage('meat', this)" class="previous">&laquo; เลือกเนื้อ</a>
  <a onclick="openPage('additional', this)" class="next">เลือกเพิ่มเติม &raquo;</a><br><br>
</div>

<!-- Additional -->
<div id="additional" class="tabcontent">
  <h1 style="color: #990000; font-size: 100px; margin-top: 0; background: -webkit-linear-gradient(#fb6565, #f31e1e);
  background-clip: text; -webkit-text-fill-color: transparent;" >องค์ประกอบเพิ่มเติม</h1>
  <div class="menu">
    <?php
      $sql = "SELECT * FROM foodTH WHERE active = 'Yes' AND category_id = 6 ";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          //get the value
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $category_id = $row['category_id'];
          $active = $row['active'];
      ?>

          <div class="menu-item">
            <?php 
              if($image_name == "") {
                echo "<div>Image not Available.</div>";
              }else{
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Mala(mild)">
                <?php
              }
            ?>
            <h2><?php echo $title?></h2>
            <p><?php echo $description?></p>
            <p><?php echo $price?></p>
            <button class="del" style="padding: 20px;" onclick="delFromCart('<?php echo $title; ?>', '<?php echo $price; ?>')">ลบ</button>
            <button class="add" onclick="addToCart('<?php echo $title; ?>', '<?php echo $price; ?>')">เพิ่ม</button>
          </div>
      <?php
        }
      } else {
        echo "<div class='error'>Food not Found.</div>";
      }
      ?>
    <!-- เพิ่มเมนูเพิ่มได้ตามต้องการ -->
  </div>
  <a onclick="openPage('vegetables', this)" class="previous">&laquo; เลือกผัก</a>
  <a onclick="openPage('receipt', this)" class="next">ชำระเงิน &raquo;</a><br><br>
</div>

<div id="receipt" class="tabcontent">
  
  <div class="cart">
    <h1 style="font-size: 100px; margin-top: 1%; background: -webkit-linear-gradient(#fb6565, #f31e1e);
    background-clip: text; -webkit-text-fill-color: transparent; text-align: center;">สรุปรายการ</h1>
    
     <h1 style="color:#990000; text-align: center; font-size: 55px;"><img src="../images/cart.png" style="height: 35px;">คิวของคุณคือ</h1>
     <?php
        // Include your database connection file
        include('connect.php');

        // Write SQL query to select just one ID from the orders table
        $sql = "SELECT id FROM orders";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
        // Output data of the first (and only) row
            $row = mysqli_fetch_assoc($result);
            echo "<h2 style='color:#990000; text-align: center; font-size: 55px;'>" . $row["id"]+1 . "</h2>";
        } else {
            echo "<h2 style='color:#990000; text-align: center; font-size: 55px;'>". "ไม่มีคิว" . "</h2>";
        }

        // Close the connection
        mysqli_close($conn);
    ?>  
    <!-- ตัวคำนวณ -->
    <div id="cartContent"></div>
    <p style="color: black; font-size: 30px; background-color: rgb(245, 128, 128); border-radius: 10px;">ทั้งหมด: ฿<span id="totalPrice">0</span></p>
    <form class="" action="" method="post">
        <div id="food" name="food[]"></div>
        <p>โปรดเลือกวิธีการชำระเงิน</p>
        <input type="radio" name="status" value="Paid">พร้อมเพย์</input>
        <input type="radio" name="status" value="Paid">เงินสด</input>
        <p>หากชำระเงินเรียบร้อยแล้ว กรุณากดสั่งสินค้า</p>
        <button type="submit" class="submit" name="submit">สั่งสินค้า</button>
    </form>
    
  </div>
  <a onclick="openPage('soup', this)" class="next">สั่งอาหารรายการถัดไป &raquo;</a><br><br>
</div>





<script>



  function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
  }
  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();

  let cart = [];
    let totalPrice = 0;
    let currentCount = 0;
    console.log("cart" , cart)
    function addToCart(productName, price) {
      let currentCount = localStorage.getItem('totalPrice');
      currentCount = parseInt(currentCount) || 0;
      currentCount += price;
      
        let existingItem = cart.find(item => item.name === productName);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({name: productName, quantity: 1, price: price});
        }
        updateCart();
        
       console.log("cart" , cart)
       
     

       var FoodArr = cart.map(item => item.name);

        localStorage.setItem("FoodArr", JSON.stringify(FoodArr))
        console.log(FoodArr);

        var FoodArr = cart.map(item => item.name);
        var jsonFoodArr = JSON.stringify(FoodArr);

        document.cookie = 'FoodOrder=' + jsonFoodArr + '; path=/;';
        // sendCartToServer(FoodArr);
       

   

     

    }
    function delFromCart(productName, price){
      let currentCount = localStorage.getItem('totalPrice');
      currentCount = parseInt(currentCount) || 0;
      currentCount += price;
      console.log("cart before del" , cart)

        cart = cart.filter(item => item.name !== productName);
      console.log("filter" , cart)
      // localStorage.removeItem("cart_local")
      
        var newData = cart.map(item => item.name);
        localStorage.setItem("newData" , JSON.stringify(cart)) 
        console.log(newData);

      let index = cart.findIndex(item => item.name === productName);
         console.log("index of product" , index)
        if (index !== -1) {

            if (cart[index].quantity === 1) {
                cart.splice(index, 1);
                console.log(cart[index])
            } else {
                cart[index].quantity--;
            }
        }

      updateCart();
    }

    function removeFromCart(productName) {
      let currentCount = localStorage.getItem('totalPrice');
      currentCount = parseInt(currentCount) || 0;
      currentCount -= price;

      let index = cart.findIndex(item => item.name === productName);
        if (index !== -1) {
            if (cart[index].quantity === 1) {
                cart.splice(index, 1);
            } else {
                cart[index].quantity--;
            }
        }
        updateCart();
    }

    function updateCart() {
        let cartContent = document.getElementById("cartContent");
        let totalPriceElement = document.getElementById("totalPrice");
        cartContent.innerHTML = "";
        totalPrice = 0;
        cart.forEach(item => {
            totalPrice += item.quantity * item.price;
            cartContent.innerHTML += `<p>${item.name} x ${item.quantity} </p>`;
            
        });
        totalPriceElement.innerText = totalPrice.toFixed(2);
    }
     function sendCartToServer(FoodArr) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send('dynamicData=' + encodeURIComponent(JSON.stringify(FoodArr)));
        }
    
    function toggleLanguage() {
      var thaiContent = document.querySelector('.thai-content');
      var englishContent = document.querySelector('.english-content');

      if (thaiContent.style.display === 'none') {
        thaiContent.style.display = 'block';
        englishContent.style.display = 'none';
      } else {
        thaiContent.style.display = 'none';
        englishContent.style.display = 'block';
      }
    }
    let newData = localStorage.getItem("newData");
    let foods = cart.map(item => item.name);
    for (x of foods){
        document.getElementById('food').innerHTML += x;
    }
  </script>
   
</body>
</html> 