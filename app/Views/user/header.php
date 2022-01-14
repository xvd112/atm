<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM System | <?= $title; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url(); ?>/mine.css">

</head>

<body>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>

    <div class="nav">
        <div class="col" style="margin: 12px;">
            <h5><b>Welcome, <?= session()->fname; ?> <?= session()->lname; ?></b></h5>
            <p style="line-height: 0;">Saldo : <b style="color:#00a5e3"><?= $saldo ?></b></p>
        </div>
        <div class="col" style="margin: 15px;" align="right">
            <a href=" <?= base_url(); ?>/akun" class="btn btn-outline-success" tabindex="-1" role="button"><i class="fas fa-home"></i></a>
            <a href=" <?= base_url(); ?>/home/logout" class="btn btn-outline-success" tabindex="-1" role="button">Logout</a>
        </div>
    </div>