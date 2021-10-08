<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Content Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../content_manager_better/src/css/style.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                <form class="white" action="../src/php/processor.php" method="post">
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
                    <!-- hidden source -->
                    <input name="source" id="source" value='' type="hidden" class="form-control">

                    <div class="row">
                        <div class="mt-3 col-9 mx-auto">
                            <label for="tags" class="form-label">Tags:</label>
                            <select class="tags form-control" name="tags" multiple="multiple">
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-3 col-9 mx-auto">
                            <label for="format" class="form-label">Choose the format:</label>
                        </div>
                        <div class="row">
                            <div class="mt-3 col-9 mx-auto">
                                <input class="form-check-input" type="radio" name="format" id="format" value="audio">
                                <label class="form-check-label" for="format">
                                    Audio
                                </label>
                                <input class="form-check-input" type="radio" name="format" id="format" value="video">
                                <label class="form-check-label" for="format">
                                    Video
                                </label>
                                <input class="form-check-input" type="radio" name="format" id="format" value="immagine">
                                <label class="form-check-label" for="format">
                                    Picture
                                </label>
                                <input class="form-check-input" type="radio" name="format" id="format" value="testo">
                                <label class="form-check-label" for="format">
                                    Text
                                </label>
                            </div>
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
    $(document).on('keyup mouseup', '#url', () => {
        // $('#url').on('keyup', () => {
        let URL = $("#url").val();
        console.log(URL);
        if (!URL.match(/^https?:\/\//i))
            $("#source").val('');
        $('#submit').prop('disabled', true);
        ask('parseUrlForSource', {
            url: URL,
        }).then((response) => {
            console.log(response);
            $('#source').val(response);
            $('#submit').prop('disabled', false);
            let source = $("#source").val();
            ask('populateSelectTags', {
                source
            }).then((response) => {
                $('.tags').select2({
                    data: response.split(','),
                });
            });
        });
    });
    $('.tags').select2({
        data: []
    });
</script>
<!-- <script>
    $(document).ready(function() {
        $("input[type='radio']").on('click', function() {
            let format = $("input[name='format']:checked").val();
            console.log(format);
        })
    });
</script> -->
</body>

</html>