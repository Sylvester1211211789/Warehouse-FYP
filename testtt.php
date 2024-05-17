<?php

require_once('bootstrap.php');
include('sambung.php');
session_start();

// Check if the session variables are set
if(isset($_SESSION['ID']) && isset($_SESSION['Name'])) {
    $ids = $_SESSION['ID']; 
    $Name = $_SESSION['Name'];
    
    $check_query = "SELECT * from users";
    $result = mysqli_query($sambungan, $check_query);
    $is = 0;
    
    $found = FALSE;
    
    while($users = mysqli_fetch_array($result)){
        if($users['UserID']==$ids){
            $found = TRUE; 
            $is = 1;   
            break;
        }
    }
    
    if($found == FALSE){
        $sql = "SELECT * FROM admin";
        $result = mysqli_query($sambungan, $sql);      
        while($admin = mysqli_fetch_array($result)){
            if($admin['AdminID']==$ids){
                $found = TRUE;
                $is = 2; 
                break;
            }
        }
    }
    
    if($found == FALSE){
        $sql = "SELECT * FROM manager";
        $result = mysqli_query($sambungan, $sql);      
        while($admin = mysqli_fetch_array($result)){
            if($admin['ManagerID']==$ids){
                $found = TRUE; 
                $is = 3;   
                break;
            }
        }
    }
    

} else {

    $is = 0;
}
    $sambungan->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Smart Warehouse</title>
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
 .ai {
  display: none; 
}

.cubeh:hover .ai{
  display: block;
  position: fixed;
  background-color: #fff;
  color: #1a1a1a;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 20px;
  padding-right: 20px;
  border-radius: 5px;
  margin-left: 100px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  z-index: 1;
}

            
            

            
    .containerz {
      text-align: center;
      margin-top: 50px;
    }
#aiButton {
  color: black;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

.aiPopup {
  display: none;
  position: fixed;
  bottom: 20px;
  left: 5px;
  width: 300px;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 5px;
      max-height: 300px;
     overflow-y: scroll;
  z-index: 1;
    color:black;
}

.aiContent {
  padding: 20px;
}

.close {
  float: right;
  cursor: pointer;
}
.response {
      margin-top: 10px;
    }

    .userMessage {
      text-align: right;
      margin-bottom: 10px;
      color: #007bff;
    }

    .aiMessage {
      text-align: left;
      margin-bottom: 10px;
      color: #000;
    }

    .typingIndicator {
      text-align: left;
      margin-bottom: 10px;
      color: #aaa;
    }

    .dot-1, .dot-2, .dot-3 {
      display: inline-block;
      margin-left: 3px;
      width: 10px;
      height: 10px;
      background-color: #aaa;
      border-radius: 50%;
      animation: typing 1.5s infinite;
    }

    @keyframes typing {
      0% { opacity: 0.5; }
      50% { opacity: 1; }
      100% { opacity: 0.5; }
    }

    .dot-2 {
      animation-delay: 0.2s;
    }

    .dot-3 {
      animation-delay: 0.4s;
    }

    .bot a {
      border: 1px solid black;
      border-radius: 20px;
      padding: 5px 10px;
      margin: 5px;
      display: inline-block;
      text-decoration: none;
      color: black;
    }

    .bot a:hover {
      background-color: #eee;
    }
    .navbarss {
      position: fixed;
      bottom: 0;
      left: 0px;
      width: 19.8%;

      margin-left:2px;
      margin-bottom:10px;
    }

    .navbarss input[type="text"] {
      width: calc(100% - 20px);
      padding: 10px;
      margin: 0 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      outline: none;
      font-size: 14px;
      margin-left:3px;
    }

    .navbarss a {
      font-size: 14px;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;

    }
            
            
 
  .aad-container {
    width: 100%;
    height: 500px;
    position: relative;
    overflow: hidden;
  }
  

  .aad-image {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 0.5s ease;
  }
  
 
  .aad-image:first-child {
    opacity: 1;
  }


  .anav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: #ccc;
    border: none;
    color: #000;
    padding: 10px;
    cursor: pointer;
  }
  .anav-btn:hover {
    background-color: #ddd;
  }
  .aprev-btn {
    left: 0;
  }
  .anext-btn {
    right: 0;
  }      
   .popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(5px); /* Apply blur effect */
    z-index: 9999;
}

.popup-content {
    position: fixed;
    top: 50%;
    left: 50%;
        width: 100%;
    transform: translate(-50%, -50%);
    z-index: 1;
}
            .popup #Exit{
             transform: translate(-50%, -50%);             
             z-index: 9999;   
            position: fixed;
            left: 60%;
            background-color: black;
                color:white;
            }
                        .popup #Exits{
             transform: translate(-50%, -50%);             
             z-index: 9999;   
            position: fixed;
            left: 65%;
            top :5%;
            background-color: black;
                color:white;
            }
</style>
</head>
<body>
    <header> 
        <div class="head_text">
        <h1>CRSST WAREHOUSE</h1>
        
      </div>
      <div class="cubeh" id="aiButton">
        <div id="message">
          <p>This is an automatic message!</p>
        </div>
          <div class = "ai">
          <p>Chat Cube</p></div>
      <div class="cube-loader">
        <div class="cube-top"></div>
        <div class="cube-wrapper">
          <span style="--i:0" class="cube-span"></span>
          <span style="--i:1" class="cube-span"></span>
          <span style="--i:2" class="cube-span"></span>
          <span style="--i:3" class="cube-span"></span>

        </div>
      </div>
    </div>
  
  <div class="aiPopup" id="aiPopup">
    <div class="aiContent" id="messageContainer">
      <span class="close" id="closePopup">&times;</span>
      <div id="messages">      
      <h2>CHAT CUBE</h2>
          <p>How can I assist you today? <br><br><b>'Account'</b> account problem <br><b>'Bound'</b> in/outbound problem <br><b>'Payment'</b> payment problem</p><br>
      <div class='navbarss'>
        <input type="text" id="userInput" placeholder="Search">
      </div>
    </div>
        </div>
  </div>
        
    </header>

    <div class="navbar">
  <a href="http://localhost/warehouse/Homepages">Home</a>
  <a href="http://localhost/warehouse/u_inoutbound">Control</a>
<?php if($is == 0){ ?>
  <a id="loginButton">Login</a>  
<?php } else { ?>
  <a href="al_logout.php">Logout</a>  
<?php } ?>  

  <div class="dropdown">
    <button class="dropbtn"> ☰
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
<?php if ($is == 1) { ?>
  <a href="http://localhost/warehouse/al_setting">Profile</a>  
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound History</a>
<?php } elseif ($is == 2) { ?>
  <a href="http://localhost/warehouse/al_setting">Profile</a>        
  <a href="http://localhost/warehouse/a_signup">Signup Admin Account</a>
  <a href="http://localhost/warehouse/m_signup">Signup Manager Account</a>
  <a href="http://localhost/warehouse/a_list_account">Account List</a>
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
  <a href="http://localhost/warehouse/a_block_more">Block</a>
<?php } elseif ($is == 3) { ?> 
  <a href="http://localhost/warehouse/al_setting">Profile</a>          
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
<?php } else { ?>        
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
<?php } ?>

    
    </div>
  </div> 
</div>
    <main>

              <div class="aad-container">
  <img class="aad-image" src="pp.png" alt="Advertisement Image 1" data-link="https://example.com/link1">
  <img class="aad-image" src="signin.png" alt="Advertisement Image 2" data-link="https://example.com/link2">
  <img class="aad-image" src="password.png" alt="Advertisement Image 3" data-link="https://example.com/link3">
  <button class="anav-btn aprev-btn" onclick="changeImage(-1)"> ◀  </button>
  <button class="anav-btn anext-btn" onclick="changeImage(1)"> ▶ </button>
</div>    <br>      
        
        
        
        <div class = 'introduction'>
        <p >CRSST which is Centre of Remote Sensing & Surveillance Technologies is in MMU Malacca, MMU Cyberjaya and Nusajaya. CRSST setup is in 1996 and fully operational at 1197. The primary aim of CRSST is to promote the growth of research and development in the areas of advanced remote sensing and surveillance technologies, which encompasses advanced remote sensing systems, vision-based surveillance solutions, and their related applications. In 1997 to 2005 CRSST was named as Remote Sensing group, 2006 – 2010 was named as Centre for Applied EM and in 2011 until now is CRSST.</p>
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
     
        <div id="loginPopup" class="popup" >
                        <div class="popup-content">
           <button id="Exit">X</button>

                <?php include('account_all_login_all.php'); ?>
            </div>
        </div>

   
        <div id="signupPopup" class="popup">
            <div class="popup-content">
                <button id="Exits">X</button>
                <?php include('account_user_signup_user.php'); ?>
            </div>
        </div>


</main>
    <footer>
        &copy; 2023 CRSST Warehouse
        <div class="footer">By Sylvester, Samuel & Tai</div>
    </footer>

    <script>
   
      
        function showLoginPopup() {
            document.getElementById("loginPopup").style.display = "block";
        }

    
        function hideAllPopups() {
            document.getElementById("loginPopup").style.display = "none";
            document.getElementById("signupPopup").style.display = "none";
        }

        document.getElementById("Exit").addEventListener("click", function() {
            hideAllPopups();
            window.location.reload();
            window.location.replace("http://localhost/warehouse/Homepages");
        }); 
                document.getElementById("Exits").addEventListener("click", function() {
            hideAllPopups();
        }); 
        document.getElementById("loginButton").addEventListener("click", function() {
            showLoginPopup();
        });

        document.getElementById("switchToSignup").addEventListener("click", function(event) {
            event.preventDefault(); 
            hideAllPopups(); 
            document.getElementById("signupPopup").style.display = "block"; 
        });

  
        document.getElementById("switchToLogin").addEventListener("click", function(event) {
            event.preventDefault(); 
            hideAllPopups(); 
            document.getElementById("loginPopup").style.display = "block"; 
        });
        // end here
        
        
        //chat cube
        document.getElementById("aiButton").addEventListener("click", function() {
      document.getElementById("aiPopup").style.display = "block";
    });

    document.getElementById("closePopup").addEventListener("click", function() {
      document.getElementById("aiPopup").style.display = "none";
    });

    document.getElementById("userInput").addEventListener("keyup", function(event) {
      if (event.keyCode === 13) { 
        var choice = document.getElementById("userInput").value;
        document.getElementById("userInput").value = ""; 
        if (choice === "Account" || choice ==="account") {
          hideButtons();
          addUserMessage("Account");
          addTypingIndicator();
          setTimeout(function() {
            addMessage("If you don't have any account you can click <a href=''>Create Account</a> or if you have any problem with your account, you can choose from below.<div class='bot'><a href='#'>Change Company Name</a> <a href='#'>Change Name</a> <a href='#'>Change Address</a> <a href='#'>Change Phone Number</a> <a href='#'>Change Password</a> <br>'Back' to go back to Menu", "aiMessage");
            clearTypingIndicator();
          }, 2000); 
        } else if (choice === "bound" || choice === "Bound") {
                  hideButtons();
          addUserMessage("Inbound & Outbound");
          addTypingIndicator();
          setTimeout(function() {
            addMessage("For Inbound Outbound and location, you can click the bottom button .  <div class='bot'> <a href=''>In/outbound</a></div> If you have any other problem or queries, you can contact our support team at CRSSTWare@gmail.com.", "aiMessage");
            clearTypingIndicator();
          }, 2000);
        } else if (choice === "Payment" || choice === "payment") {
                      hideButtons();
          addUserMessage("Payment");
          addTypingIndicator();
          setTimeout(function() {
            addMessage("For payment and payment history, you can choose bottom button .  <div class='bot'> <a href=''>Payment</a> <a href=''>Payment History</a></div>  For payment-related queries, please check our <a href='#'>FAQ</a> section or contact our billing department 0630995555.", "aiMessage");
            clearTypingIndicator();
          }, 2000);
        }
       else if (choice === "4") {
                     hideButtons();
          addUserMessage("Back");
          addTypingIndicator();
          setTimeout(function() {
            addMessage(" <br><br><b>'Account'</b> account problem <br><b>'Bound'</b> in/outbound problem <br><b>'Payment'</b> payment problem<br>", "aiMessage");
            clearTypingIndicator();
          }, 2000);
        }   
          
          
          else {
          addMessage("Invalid choice. Please enter 'Account' for account problem, 'Bound' for inbound and outbound problem, or 'Payment' for payment problem.","aiMessage");
        }
      }
    });

    function hideButtons() {
      document.querySelectorAll(".bot a").forEach(function(button) {
        button.style.display = "none";
      });
    }

    function addTypingIndicator() {
      var messages = document.getElementById("messages");
      var typingIndicator = document.createElement("div");
      typingIndicator.className = "typingIndicator";
      typingIndicator.innerHTML = "Typing <span class='dot-1'></span><span class='dot-2'></span><span class='dot-3'></span>";
      messages.appendChild(typingIndicator);
      document.getElementById("messageContainer").scrollTop = document.getElementById("messageContainer").scrollHeight;
    }

    function addUserMessage(message) {
      var messages = document.getElementById("messages");
      var userMessage = document.createElement("div");
      userMessage.className = "userMessage";
      userMessage.textContent = message;
      messages.appendChild(userMessage);
      document.getElementById("messageContainer").scrollTop = document.getElementById("messageContainer").scrollHeight;
    }

    function addMessage(message, className) {
      var messages = document.getElementById("messages");
      var newMessage = document.createElement("div");
      newMessage.className = className;
      newMessage.innerHTML = message;
      messages.appendChild(newMessage);
      document.getElementById("messageContainer").scrollTop = document.getElementById("messageContainer").scrollHeight; 
    }

    function clearTypingIndicator() {
      var typingIndicators = document.getElementsByClassName("typingIndicator");
      for (var i = typingIndicators.length - 1; i >= 0; i--) {
        typingIndicators[i].remove();
      }
    }

      function showMessage() {
        const message = document.getElementById('message');
        message.style.display = 'block';
    

        setTimeout(function() {
          message.style.display = 'none';
        }, 4000);
      }
    
    
      showMessage();
      //end  
        
        
        
    //advertisement  
  const images = document.querySelectorAll('.aad-image');
  let currentIndex = 0;
  let autoSwipeTimer;

  function changeImage(step) {
    clearTimeout(autoSwipeTimer);
    images[currentIndex].style.opacity = '0';
    currentIndex = (currentIndex + step + images.length) % images.length;
    images[currentIndex].style.opacity = '1';
    autoSwipeTimer = setTimeout(() => changeImage(1), 5000); 
  }


  document.querySelector('.aprev-btn').addEventListener('click', () => changeImage(-1));
  document.querySelector('.anext-btn').addEventListener('click', () => changeImage(1));


  const adLinks = document.querySelectorAll('.aad-image');
  adLinks.forEach(link => {
    link.addEventListener('click', () => {
      const url = link.getAttribute('data-link');
      window.open(url, '_blank');
    });
  });


  autoSwipeTimer = setTimeout(() => changeImage(1), 5000); 
    </script>


</body>
</html>

