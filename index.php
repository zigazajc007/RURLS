<?php
require "settings.php";

if(isset($_GET[$parameter])){
    $json = json_decode(file_get_contents("urls.json"), true);
    if(isset($_GET[$parameter])) header("Location: " . $json[$_GET[$parameter]]);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="description" content="RURLS is free and open source URL shortener">
    <meta name="keywords" content="RURLS, Rabbit URL shortener, URL shortener">
    <meta name="author" content="Rabbit Company LLC">
    <title><?php echo $name; ?></title>
    <link rel="icon" type="image/png" href="images/logo.png" />
    <link href="css/tabler.min.css" rel="stylesheet"/>
  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center py-4">
      <div class="container-tight py-6">
        <div class="text-center mb-4">
          <a href="."><img src="images/logo.png" height="150" alt=""></a>
        </div>
        <form class="card card-md" action="generate_url.php" method="post" autocomplete="off">
          <div class="card-body">

            <div class="mb-3">
              <label class="form-label">URL</label>
              <input type="text" name="old_url" class="form-control" placeholder="Enter url">
            </div>
            <div class="mb-3">
              <label class="form-label">New URL</label>
              <div class="input-group input-group-flat">
                <span class="input-group-text" id="new_url_domain"><?php echo $domain . "?" . $parameter . "="; ?></span>
                <input type="text" name="new_url" id="new_url" value="<?= $_GET["newurl"]; ?>" class="form-control ps-0" autocomplete="off">
                <span class="input-group-text"><a href="#" onclick="CopyToClipboard();" class="link-secondary" title="Copy" data-bs-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="8" y="8" width="12" height="12" rx="2" /><path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" /></svg><a></span>
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Generate URL</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <?php if($_GET["info"] != ""){ ?>
            <div class="alert alert-important alert-<?= $_GET["color"]; ?> alert-dismissible" style="position: fixed; bottom: 0; left: 0; margin: 30px;" role="alert">
              <div class="d-flex">
                  <?= $_GET["info"]; ?>
              </div>
              <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
    <?php } ?>

    <script>

        function CopyToClipboard() {
          var textArea = document.createElement("textarea");

          textArea.value = document.getElementById("new_url_domain").innerHTML + document.getElementById("new_url").value;

          // Avoid scrolling to bottom
          textArea.style.top = "0";
          textArea.style.left = "0";
          textArea.style.position = "fixed";

          document.body.appendChild(textArea);
          textArea.focus();
          textArea.select();
          textArea.setSelectionRange(0, 99999);

          document.execCommand('copy')

          document.body.removeChild(textArea);
        }

    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tabler.min.js"></script>
  </body>
</html>
