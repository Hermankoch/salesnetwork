<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>Document</title>
</head>
<body>
  <?php include_once('inc/loginform.php'); ?>
  <div class="page-wrapper">
    <?php include_once('inc/header.html'); ?>
    <section class="section-row fs-entrepreneur">
      <div class="column">
        <div class="first-text-container">
          <h1 class="first-section-h1">Let's connect you to new possibilities</h1>
          <h2>I am an entrepreneur</h2>
          <p>We offer solutions that will increase your revenue and reach.</p>
          <p>Forget local. Think national</p>
        </div>
      </div>
      <div class="column">
        
      </div>
    </section>
    <section class="section-row ss-entrepreneur">
      <h1 class="orange-heading">Sign up to new possibilities</h1>
      <div class="ent-signup-container">
        <form class="ent-signup-form" action="core/ent_register.php" method="post" enctype="multipart/form-data" id="signup">
          <p class="form-text">Personal Info</p>

          <input class="inputText" type="text" name="name" value="" placeholder="Name">
          <input type="text" name="surname" placeholder="Surname">
          <input type="text" name="contact" placeholder="Contact No" pattern="[0-9]{10}">
          <input type="email" name="email" placeholder="Email" required>
          <?php if(isset($_GET['password']) && !empty($_GET['password'])){
              echo '<div id="error" class="alert alert-danger" role="alert">'.htmlspecialchars($_GET['password']).'</div>';
          } ?>
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="password-verify" placeholder="Verify Password" required>
          <p class="form-text">Location</p>
          <select name="province">
            <option value="province">Province</option>
          </select>
          <select name="city">
            <option value="city">City</option>
          </select>
            <input type="text" name="company-name" placeholder="Company Name">
              <p class="form-text">Company Info</p>
          <select name="registered" required>
            <option value="">Are you a registered company?</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
          <p class="form-text t-center">Attach company certificate</p>
          <?php
          if(isset($_GET['filetype']) && !empty($_GET['filetype'])){
              echo '<div id="error" class="alert alert-danger" role="alert">'.htmlspecialchars($_GET['filetype']).'</div>';
          }
          if(isset($_GET['file']) && !empty($_GET['file'])){
            echo '<div id="error" class="alert alert-danger" role="alert">'.htmlspecialchars($_GET['file']).'</div>';
          }
          ?>
          <div><label class="custom-file-upload" for="fileToUpload" title="Only PDF/Word">
            Browse
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="checkFileUploaded()" required>
          </label><span id="file-name" class="fileinfo">Max: 2 MB File: PDF/Word</span></div>
          <?php if(isset($_GET['filesize']) && !empty($_GET['filesize'])){
              echo '<div id="error" class="alert alert-danger" role="alert">'.htmlspecialchars($_GET['filesize']).'</div>';
          } ?>
          <select id="website" onchange="addLink();" name="website">
            <option value="">Do you have a website?</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
          <div id="addWebsite">
          </div>
          <input type="text" name="social" placeholder="Social Media Link">
          <select name="ps">
            <option value="p">Products</option>
            <option value="s">Services</option>
            <option value="ps">Both</option>
          </select>
          <textarea cols="1" rows="5" name="description" placeholder="Please describe your products and/or services:"></textarea>
          <button class="btn-rounded" type="submit" name="submit">Send Application</button>
        </form>
      </div>

    </section>
  </div>
  <script>
  function addLink(){
    var web = document.getElementById('website');
    var add = document.getElementById('addWebsite');
    if(web.selectedIndex == 1){
      add.innerHTML = "<input type='text' name='websitelink' value='' placeholder='Website link'>"
    }else {
      add.innerHTML = '';
    }
  }
  function checkFileUploaded(){
    var fileSize = document.getElementById('fileToUpload').files[0].size;
    var fileName = document.getElementById('fileToUpload').files[0].name;
    var fileExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    fileExt = fileExt.toLowerCase();
    var fileExtArr = ["odt", "docx", "dotx", "pdf","dot", "doc"];
    var flag = false;
    for (var i = 0; i < fileExtArr.length; i++) {
      if(fileExtArr[i] == fileExt){
        flag = true;
      }
    }
    if(flag && fileSize < 2100000){
      document.getElementById('file-name').textContent = fileName +' '+ Math.round(fileSize / 1000).toFixed(1)+'Kb';
      document.getElementById('file-name').classList.remove('alert');
      document.getElementById('file-name').classList.remove('alert-danger');
    }else {
      document.getElementById('file-name').classList.add('alert');
      document.getElementById('file-name').classList.add('alert-danger');
      document.getElementById('file-name').textContent = 'Check file: '+fileExt+' '+ Math.round(fileSize / 1000).toFixed(1)+'Kb';
    }
  }

  </script>
  <script src="inc/login.js"></script>
</body>
</html>
