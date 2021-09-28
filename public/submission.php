<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Content Manager</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../../content_manager_better/src/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../src/js/utils.js"></script>
</head>

<body class='bg-light'>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary justify-content-center shadow" id="navbar">
        <ul class="navbar-nav">
            <li class="nav-link active">
                <a href="../public/index.php" class="text-white text-decoration-none fs-1"> Content Manager </a>
            </li>
        </ul>
    </nav>
    <div class="container-sm mx-auto">
        <div class="row">
            <div class="bg-white mx-auto shadow mt-5 py-4 col-7">
                <h3 class="text-primary text-center fs-2">Make a submission!</h3>
                <form class="white" action="../controller/processor.php" method="post">
                    <div class="row">
                        <div class="mt-3 col-9 mx-auto">
                            <label for="email" class="form-label">Your Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-3 col-9 mx-auto">
                            <label for="url" class="form-label">Your Link:</label>
                            <input type="url" name="url" class="form-control" id="url">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-3 col-9 mx-auto">
                            <label for="url" class="form-label">Category:</label>
                            <input type="text" name="category" id="category" value='' class="form-control">
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <input type="hidden" name="dateadded" value="1632816754">
                        <input type="submit" value="Submit" name='submit' id='submit' class="btn btn-primary btn-submission" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer class="footer fixed-bottom mt-auto py-3 bg-light shadow-lg">
    <div class="container text-center">
        <span class="text-muted">copyright 2021 Finsoft S.R.L</span>
    </div>
</footer>
<script>
    $('#url').keyup(() => {
        let URL = $("#url").val();
        console.log(URL);
        if (URL !== 'https://' || URL !== 'http://')
            $("#category").val('');
        $('#submit').prop('disabled', true);
        ask('parseUrlForSource', {
            url: URL,
        }).then((response) => {
            console.log(response);
            $('#category').val(response);
            $('#submit').prop('disabled', false);
        });
    });
</script>
</body>

</html>