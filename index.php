<?php

require_once('bootstrap.php');
include('sambung.php');
session_start();


if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    $is = 0;

}
else{
    if($_SESSION['Status'] == 'user'){
    $is = 1;}
    else if ($_SESSION['Status'] == 'admin'){
        $is = 2;}
        else if ($_SESSION['Status'] == 'manager'){
        $is = 3;}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with LeadMark landing page.">
    <meta name="author" content="Devcrud">
    <title>CRSST WAREHOUSE </title>
    <style>
            .headerdrop {
            float: left;
            position: relative;
        }

        .headerdrop .headerdropbtn {
            font-size: 13px;
            font-weight: 600;
            border: none;
            outline: none;
            color: #444;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .headerdropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1001;
        }

        .headerdropdown-content a {
            float: none;
            color: #000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .headerdropdown-content a:hover {
            background-color: #ddd;
        }

        .headerdrop:hover .headerdropdown-content {
            display: block;
        }
        #log {
            display:hide;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;

            z-index: 1002;
            border-radius: 0px;


            overflow-y: auto;
        }
       #sign {
           display:none;
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;

            z-index: 1002;
            border-radius: 0px;
            padding: 20px;

            overflow-y: auto; 
        }
        #background-overlay {
            display:none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1001;
            border: none;}

        .blur {
            filter: blur(5px);
            pointer-events: none;
            user-select: none;
        }
#close {
    position: absolute;
    top: 40px;
    right: 5px;
    cursor: pointer;
    font-size: 20px;
    z-index: 1003;
    color: black;
    background-color: white;
    border: none;
    outline: none;
    padding: 5px;
    border-radius: 50%;
    margin-left : 10px;
}
     
    </style>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + LeadMark main styles -->
	<link rel="stylesheet" href="assets/css/leadmark.css">
	<link rel="stylesheet" href="loader.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- page Navigation -->
    <nav class="navbar custom-navbar navbar-expand-md navbar-light fixed-top" data-spy="affix" data-offset-top="10">
        <div class="container">
            <a class="navbar-brand" href="#">
               CRSST
            </a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">                     
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/warehouse/u_inoutbound">Control</a>
                    </li>
                    <div class="headerdrop">
                    <li class="nav-item">
                        <a class="nav-link headerdropbtn">More</a>
                    </li>
                     <div class="headerdropdown-content">
                    <?php if ($is == 1) { ?>  
                      <a href="http://localhost/warehouse/more_payment">Payment</a>
                      <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound History</a>
                    <?php } elseif ($is == 2) { ?>      
                      <a href="http://localhost/warehouse/a_signup">Signup Admin Account</a>
                      <a href="http://localhost/warehouse/m_signup">Signup Manager Account</a>
                      <a href="http://localhost/warehouse/a_list_account">Manage Account </a>
                      <a href="http://localhost/warehouse/more_payment">Payment</a>
                      <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
                      <a href="http://localhost/warehouse/chart">Data Analysis</a>
                      <a href="http://localhost/warehouse/a_block_more">Block</a>
                    <?php } elseif ($is == 3) { ?>  
                      <a href="http://localhost/warehouse/chart">Data Analysis</a>
                      <a href="http://localhost/warehouse/more_payment">Payment</a>
                      <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
                    <?php } else { ?>        
                      <a href="http://localhost/warehouse/more_payment">Payment</a>
                      <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
                    <?php } ?>
                      </div>
                    </div>
                    <?php if($is == 0){ ?>
                             <li class="nav-item">
                                    <a class="nav-link" href="http://localhost/warehouse/main?login">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://localhost/warehouse/main?signup">Signup</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="al_logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/warehouse/al_profile">Profile</a>
                    </li> 
                   <?php } ?>  
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Of Second Navigation -->
    <?php
    include("loading.html");
    ?>
    <!-- Page Header -->
    <header class="header">
        <div class="overlay">
            <h1 class="subtitle">CRSST Warehouse</h1>
            <h1 class="title">Automated Warehouse</h1>  
        </div>
        <div style="z-index:10000;">
        <?php
        include("cube.html")
            ?></div>
        <div class="shape">
            <svg viewBox="0 0 1500 200">
                <path d="m 0,240 h 1500.4828 v -71.92164 c 0,0 -286.2763,-81.79324 -743.19024,-81.79324 C 300.37862,86.28512 0,168.07836 0,168.07836 Z"/>
            </svg>
            
        </div>  
        <div class="mouse-icon"><div class="wheel"></div></div>
        
    </header>
    <!-- End Of Page Header -->

    <!-- Service Section -->
    <section  id="service" class="section pt-0">
        
        <div class="container">
            
            <h6 class="section-title text-center">Our Service</h6>
            <h6 class="section-subtitle text-center mb-5 pb-3">
Discover our cutting-edge fully automated warehouse solution, offering effortless drop-off, customizable storage options, 24/7 accessibility, advanced security measures, real-time monitoring, efficient retrieval, seamless integration with logistics, scalability, and flexibility for businesses and individuals seeking efficient and convenient storage solutions.</h6>


        </div>
    </section>
    <!-- End OF Service Section -->

    <!-- About Section -->
    <section class="section" id="about">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 pr-md-5 mb-4 mb-md-0">
                    <h6 class="section-title mb-0">About </h6>
                    <h6 class="section-subtitle mb-4">CRSST Warehouse</h6>
                    <p >CRSST which is Centre of Remote Sensing & Surveillance Technologies is in MMU Malacca, MMU Cyberjaya and Nusajaya. CRSST setup is in 1996 and fully operational at 1197. </p>
                    <img src="assets/imgs/about.jpg" alt="" class="w-100 mt-3 shadow-sm">
                </div>
                <div class="col-md-6 pl-md-5">
                    <div class="row">
                        <div class="col-6">
                            <img src="assets/imgs/about-1.jpg" alt="" class="w-100 shadow-sm">
                        </div>
                        <div class="col-6">
                            <img src="assets/imgs/about-2.jpg" alt="" class="w-100 shadow-sm">
                        </div>
                        <div class="col-12 mt-4">
                            <p>The primary aim of CRSST is to promote the growth of research and development in the areas of advanced remote sensing and surveillance technologies, which encompasses advanced remote sensing systems, vision-based surveillance solutions, and their related applications. In 1997 to 2005 CRSST was named as Remote Sensing group, 2006 – 2010 was named as Centre for Applied EM and in 2011 until now is CRSST.</p>

                        </div>
                    </div>
                </div>
            </div>              
        </div>
    </section>
    <!-- End OF About Section -->

    <!-- Blog Section -->
    <section class="section" id="blog">
        <div class="container">
            <h6 class="section-title mb-0 text-center">Medal</h6>
            <h6 class="section-subtitle mb-5 text-center">Gold Medal in 2023 INVENTX Event</h6>
            <div class="row">
                <div class="col-md-4" style="  position: relative; width: 100%; padding-right: auto; padding-left: auto; margin: 0 auto;border: 1px solid rgba(0, 0, 0, 0.125);">
                <img src="assets/imgs/Inventx.jpg" alt="" class="card-img-top w-100" style="  ">
                        <div class="card-body">                         
                            <h6 class="card-title">I049</h6>
                            <p>Smart Inbound Management System</p>
                            <a href="https://inventx.mmu.edu.my/booth.html#I049" class="small text-muted">Go To The Article</a>
                     
                    </div>
                </div>

          
        </div>
        </div>
    </section>
    <!-- End of Blog Section -->

    <!-- Testmonial Section -->
    <section class="section" id="testmonial">
        <div class="container">
            <h6 class="section-title text-center mb-0">Admin</h6>
            <h6 class="section-subtitle mb-5 text-center"></h6>
            <div class="row">
                <div class="col-md-4 my-3 my-md-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-3" src="assets/imgs/avatar.jpg" alt="">
                                <div class="media-body">
                                    <h6 class="mt-1 mb-0">Zack Tai</h6>
                                    <small class="text-muted mb-0">ZackTai@gmail.com</small>     
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-3 my-md-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-3" src="assets/imgs/avatar-1.jpg" alt="">
                                <div class="media-body">
                                    <h6 class="mt-1 mb-0">Sylvester Ong</h6>
                                    <small class="text-muted mb-0">Sylvester@gmail.com</small>      
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-3 my-md-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-3" src="assets/imgs/avatar-2.jpg" alt="">
                                <div class="media-body">
                                    <h6 class="mt-1 mb-0">Samuel Ong</h6>
                                    <small class="text-muted mb-0">Samuel@gmail.com</small>        
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- End of Testmonial Section -->

    <!-- Contact Section -->
    <section id="contact" class="section has-img-bg pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 my-3">
                    <h6 class="mb-0">Phone</h6>
                    <p class="mb-4">011-3099 1764</p>

                    <h6 class="mb-0">Address</h6>
                    <p class="mb-4">Jalan Ayer Keroh Lama, 75450 Bukit Beruang, Melaka</p>

                    <h6 class="mb-0">Email</h6>
                    <p class="mb-0">crsstwarehouse@gmail.com</p>
                    <p></p>
                </div>
                <div class="col-md-7">
                    <form>
                        <h4 class="mb-4">Location</h4>
                        <div class="form-row">
 
<a>
<div >

 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4500.617004215777!2d102.27251227853642!3d2.2484461584168516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e56b9710cf4b%3A0x66b6b12b75469278!2sMultimedia%20University!5e0!3m2!1sen!2sus!4v1715257751570!5m2!1sen!2sus" width="380" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                           
                    
    </div></a></div>                        
                    </form>
                </div>
            </div>
            <!-- Page Footer -->
            <footer class="mt-5 py-4 border-top border-secondary">
                <p class="mb-0 small">&copy; <script>document.write(new Date().getFullYear())</script>, CRSST Warehouse Created By <a href="https://www.devcrud.com" target="_blank">Sylvester, Samuel & Tai.</a></p>     
            </footer>
            <!-- End of Page Footer -->  
        </div>
    </section>
    <div id="background-overlay" style="displaye:none;"></div>
	    <div id="log" style="display:none;">
    <div id="close" style="position: absolute; top: 70px; right: 30px; cursor: pointer; z-index: 1003;" onclick="closeForm()">x</div>
        <?php include('account_all_login_all.php'); ?>
    </div>
    <div id="sign" style="display:none;">
   <div id="close" style="cursor: pointer; z-index: 1003; top:30px; right:30px;" onclick="closeForms()">x</div>
        <?php include('account_user_signup_user.php'); ?>
    </div>
	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
	<script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Isotope -->
    <script src="assets/vendors/isotope/isotope.pkgd.js"></script>

    <!-- LeadMark js -->
    <script src="assets/js/leadmark.js"></script>
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
   </script>
     <script>
        function openForm() {
            document.getElementById("log").style.display = "block";
            document.getElementById("background-overlay").style.display = "block";          
            document.getElementById("sign").style.display = "none";
            document.getElementById("main-content").classList.add("blur");
        }
        function closeForm() {
            document.getElementById("log").style.display = "none";            document.getElementById("background-overlay").style.display = "none";   
            document.getElementById("main-content").classList.remove("blur");
        }
        function openForms() {
            document.getElementById("background-overlay").style.display = "block";            
            document.getElementById("sign").style.display = "block";
            document.getElementById("log").style.display = "none";
            document.getElementById("main-content").classList.add("blur");
        }
        function closeForms() {
            document.getElementById("sign").style.display = "none";
                        document.getElementById("background-overlay").style.display = "none";   
            document.getElementById("main-content").classList.remove("blur");
        }
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('login')) {
                openForm();
            } else if (urlParams.has('signup')) {
                openForms();
            }
        }
    </script>   

</body>
</html>
