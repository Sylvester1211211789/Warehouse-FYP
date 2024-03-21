<!DOCTYPE html>
<html lang="en">
<head>
    <style>

.navbar {

  padding-left: 580px;
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  padding-left:20px;
  float:left;
  font-size: 24px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
 float:left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 26px;  
  border: none;
  outline: none;
  color: white;
  padding: 8px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;

}

.navbar a:hover, .dropdown:hover .dropbtn {

  color:red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #1a1a1a;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  font-size: 20px;
  float: none;
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: darkgrey;
}

.dropdown:hover .dropdown-content {
  display: block;
}
        
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Smart Warehouse</title>
</head>
<body>
    <header> 
        <div class="head_text">
        <h1>CRSST WAREHOUSE</h1>
      </div>

    </header>
<div class="navbar">
  <a href="admin_main.html">Home</a>
  <a href="array.php">Control</a>
  <a href="account_setting.php">Profile</a>
  <div class="dropdown">
    <button class="dropbtn"> ☰
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="payment_more.php">Payment</a>
      <a href="#news">In/Outbound List</a>
    </div>
  </div> 
</div>

    <main>
        <div class = 'introduction'>
        <p style="margin-left:100px; margin-right:100px; font-size:25px; margin-top:150px; color:rgb(255, 255, 255); font-family: 'Arial', sans-serif;   text-align: center;">CRSST which is Centre of Remote Sensing & Surveillance Technologies is in MMU Malacca, MMU Cyberjaya and Nusajaya. CRSST setup is in 1996 and fully operational at 1197. The primary aim of CRSST is to promote the growth of research and development in the areas of advanced remote sensing and surveillance technologies, which encompasses advanced remote sensing systems, vision-based surveillance solutions, and their related applications. In 1997 to 2005 CRSST was named as Remote Sensing group, 2006 – 2010 was named as Centre for Applied EM and in 2011 until now is CRSST.</p>
    </div>
    <div class="row">
        <div class="column">
          <img src="https://www.ssents.com/hubfs/optomize-warehouse-space-with-pallet-racks-1.jpeg#keepProtocol" alt="Snow" style="width:100%">
      
        </div>
        <h2 style="text-align:center;">Space Optimization</h2>
       <p class="texts">
            Auto warehouses make better use of available space by utilizing vertical
             storage systems, compact storage configurations, and optimized layouts. 
             This allows businesses to store more goods in a smaller footprint,<br> ultimately 
             saving on storage costs. </p>
          
      
      </div>
      <div class="row">
        <div class="columnss">
          <img src="https://th.bing.com/th/id/OIP.y3Zgshtf48P03jBOe0dTHwHaEo?pid=ImgDet&rs=1" alt="Snow" style="width:100%">
      
        </div>
        <h2 style="text-align:center; margin-top:100px;">Increased Efficiency</h2>
          <p class="texts">Auto warehouses utilize advanced robotics, conveyors,
             and computer systems to automate the storage and retrieval of goods.
              This results in significantly faster and more efficient handling of 
              inventory compared to manual methods. It reduces the need for human 
             intervention, leading to higher productivity.</p>
          
      
      </div>
      
      <div class = 'introductions'>
      
        <h1 style="text-align:center; margin-top:10px;">Award <br>    <img width="100" height="50" src="https://inventx.mmu.edu.my/img/i-logo.png"></h1>
        <p style="margin-left:100px; margin-right:100px; font-size:25px; margin-top:15px; color:rgb(255, 255, 255); font-family: 'Arial', sans-serif;   text-align: center;">Gold Medal in Creating Smart Inbound Management in INVENTX 2023</p>
        <div class="container">
          <a href="https://www.youtube.com/watch?v=1I6pmVsmGEU" >
          <img width="520" height="280" src="pp.png" >
          <div class="overlay">
              <div class="text">Ctrl + Right Click to watch our Smart Inbound Management Video</div>
            </div>
                </a></div>
    </div> 
</main>
    <footer>
        &copy; 2023 CRSST Warehouse
        <div class="footer">By Sylvester, Samuel & Tai</div>
    </footer>

    <script>

 
      function showMessage() {
        const message = document.getElementById('message');
        message.style.display = 'block';
    

        setTimeout(function() {
          message.style.display = 'none';
        }, 4000); 
      }
    

      showMessage();
        
    </script>
</body>
</html>

