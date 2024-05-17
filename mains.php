<?php

require_once('bootstrap.php');
include('sambung.php');
session_start();
include('head.html');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cube_style.css">
    <link rel="stylesheet" href="bodystyle.css"> 
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7fd; /* Light blue background */
            color: #333; /* Dark gray text */
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1e90ff; /* Medium blue header */
            color: #fff; /* White text */
            padding: 20px;
            text-align: center;
        }
        footer {
            background-color: #1e90ff; /* Medium blue footer */
            color: #fff; /* White text */
            padding: 10px;
            width: 100%;
            bottom: 0;
        }
        main {
            padding: 20px;
        }
        h1 {
            margin: 0;
        }


        }

    </style>
    <title>Smart Warehouse</title>
        <style>


</style>
</head>
<body>
                  <div class="aad-container">
  <img class="aad-image" src="pps.png" alt="Advertisement Image 1" data-link="http://localhost/warehouse/inbound.php">
  <img class="aad-image" src="warehouses.png" alt="Advertisement Image 2" data-link="http://localhost/warehouse/inbound.php">

                      
</div>         
              <div class="cubeh" id="aiButton">
        <div id="message">
          <p>Chat CUBE</p>
        </div>

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
    <header> 
        <div class="head_text">
        <h1>CRSST WAREHOUSE</h1>
        
      </div>

        
    </header>

    <main>


        
        
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

</main>
    <footer>
                
        &copy; 2023 CRSST Warehouse
        <div class="footer">By Sylvester, Samuel & Tai</div>
    </footer>

    <script>
   

        
        
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
            addMessage("If you don't have any account you can click <a href='http://localhost/warehouse/u_signup'>Create Account</a> or if you want to manage account information, you can click below button.<div class='bot'><a href='http://localhost/warehouse/al_update_name'>Manage Account</a> <br>'Back' to go back to Menu", "aiMessage");
            clearTypingIndicator();
          }, 2000); 
        } else if (choice === "bound" || choice === "Bound") {
                  hideButtons();
          addUserMessage("Inbound & Outbound");
          addTypingIndicator();
          setTimeout(function() {
            addMessage("For Inbound Outbound and location, you can click the bottom button .  <div class='bot'> <a href='http://localhost/warehouse/u_inoutbound'>In/outbound</a></div> If you have any other problem or queries, you can contact our support team at CRSSTWare@gmail.com.", "aiMessage");
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
        
        
        
        
          // JavaScript to change the image on button click or automatically after a delay
  const images = document.querySelectorAll('.aad-image');
  let currentIndex = 0;
  let autoSwipeTimer;

  function changeImage(step) {
    clearTimeout(autoSwipeTimer);
    images[currentIndex].style.opacity = '0';
    currentIndex = (currentIndex + step + images.length) % images.length;
    images[currentIndex].style.opacity = '1';
    autoSwipeTimer = setTimeout(() => changeImage(1), 5000); // Change image automatically after 5 seconds
  }



  // Add link functionality to images
  const adLinks = document.querySelectorAll('.aad-image');
  adLinks.forEach(link => {
    link.addEventListener('click', () => {
      const url = link.getAttribute('data-link');
      window.open(url, '_blank');
    });
  });

  // Start automatic forward swiping initially
  autoSwipeTimer = setTimeout(() => changeImage(1), 5000); // Change image automatically after 5 seconds
    </script>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>

