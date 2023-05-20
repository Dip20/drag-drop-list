<?php
require_once "./paths.php";

$get_data = select_data("squad", '*', '', '', $conn);

$sql = "SELECT p.id as squad_id, p.name, s.id as score_id, s.score, s.orders FROM `score_board` s LEFT JOIN squad p ON p.id = s.squad_id ORDER BY s.orders ASC ";
$get_score  = query($sql, $conn);
$score_data = mysqli_fetch_all($get_score, MYSQLI_ASSOC);


$check_squad      = query("SELECT group_concat(squad_id) as squad_ids FROM score_board", $conn);
$check_squad_data = mysqli_fetch_assoc($check_squad);

$validate_squad = array();
if (!empty($check_squad_data)) {
    $validate_squad = explode(",", $check_squad_data['squad_ids']);
}

// echo '<pre>';
// print_r($validate_squad);
// exit;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Drag and Drop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>

<style>
    .ghost {
        opacity: 0.4;
    }

    .list-group {
        margin: 20px;
    }
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Pridict Player X1</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <h4 class="m-3 text-center">Predict Your Player X1</h4>



    <div class="container">
        <div class="card shadow">
            <div class="card-body">

                <div id="demo" class="row justify-content-center">

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">Our Squad</div>
                            <div class="card-body">
                                <div id="items-1" class="list-group col">
                                    <?php while ($data = mysqli_fetch_assoc($get_data)) {

                                        if (!in_array($data['id'], $validate_squad)) { ?>

                                            <div id="item-<?= $data['id'] ?>" data-id="<?= $data['id'] ?>" class="list-group-item nested-1"><?= $data['name'] ?></div>

                                    <?php }
                                    } ?>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">Predict Your Player X1</div>
                            <div class="card-body">
                                <div id="items-2" class="list-group col">
                                    <?php foreach ($score_data as $score) { ?>
                                        <div id="item-2.1" data-id="<?= $score['squad_id'] ?>" class="list-group-item nested-1"><?= $score['name'] ?></div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">Score</div>
                            <div class="card-body">
                                <div id="items-3" class="list-group col">
                                    <div class="list-group-item nested-1 score_input_group">
                                        <?php foreach ($score_data as $score) { ?>
                                            <input type="text" class="form-control" name="score[]" value="<?= $score['score'] ?>" class="score_input" placeholder="Score">

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>
                <div class="group text-center">
                    <button class="btn btn-sm btn-primary mx-1" data-toggle="modal" data-target="#exampleModal">Add Player</button>
                    <a  href="<?= base_url('view.php')?>" class="btn btn-sm btn-info mx-1">View Score</a>
                    <button id="predict" class="btn btn-sm btn-success mx-1">Predict</button>
                </div>
            </div>
        </div>
    </div>



    <!-- bootstrap modal start here -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('save_squad.php') ?>" class="add_squad">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Player To Squad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <label for="">Name</label>
                                    <input type="text" name="name" required class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <label for="">Jersey No.</label>
                                    <input type="text" name="jersey_no" required class="form-control" placeholder="Enter Jersey No.">
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <label for="">Type</label>
                                    <input type="text" name="type" required class="form-control" placeholder="Enter Type">
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="error-msg my-1"></label>
                    <label class="form_proccessing text-success my-1"></label>
                    <div class="modal-footer">
                        <input type="hidden" name="save_squad" value="<?= rand() ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- bootstrap modal ends here -->



    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script>
        // List 1
        $('#items-1').sortable({
            // group: 'list',
            group: 'shared', // set both lists to same group
            animation: 200,
            ghostClass: 'ghost',
            onSort: reportActivity,

        });

        // List 2
        $('#items-2').sortable({
            // group: 'list',
            group: 'shared', // set both lists to same group
            animation: 200,
            ghostClass: 'ghost',
            onSort: manage_score,
        });

        $('#predict').click(function() {
            var sort1 = $('#items-1').sortable('toArray');
            console.log(sort1);
            var sort2 = $('#items-2').sortable('toArray');
            console.log(sort2);

            var _score = $('input[name="score[]"]').map(function() {
                return parseInt(this.value); // $(this).val()
            }).get();

            console.log(_score);

            $.ajax({
                type: "POST",
                url: "<?= base_url('predict.php') ?>",
                data: {
                    players: sort2,
                    score: _score
                },
                dataType: "json",
                success: function(response) {
                    if (response.st == "success") {
                        alert(response.msg);
                        location.reload();
                    } else {
                        alert(response.msg);
                        console.log(response.msg);
                    }

                },
                error: function(err) {
                    alert("Somethig went wrong");

                    console.log(err);
                },
                timeout: 3000 // sets timeout to 3 seconds
            });

        });

        // Report when the sort order has changed
        function reportActivity() {
            console.log('The sort order has changed');
        };

        function manage_score() {
            var html = '<input type="text" class="form-control" name="score[]" class="score_input" placeholder="Score">';
            $(".score_input_group").append(html)
        };



        $('.add_squad').on('submit', function(e) {
            e.preventDefault();

            $(".save_btn").prop("disabled", true);
            $('.error-msg').html('');
            $('.form_proccessing').html('Please wait...');
            var aurl = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: aurl,
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.st == "success") {
                        alert(response.msg);
                        $(".save_btn").prop("disabled", false);
                        $('.form_proccessing').html(response.msg);
                        location.reload();
                    } else {
                        $(".save_btn").prop("disabled", false);
                        $('.error-msg').html(response.msg);
                        $('.form_proccessing').html('');
                    }

                },
                error: function(err) {
                    $(".save_btn").prop("disabled", false);
                    $('.form_proccessing').html('');
                    alert("Something went wrong!!!!");
                    $('.error-msg').html(err);
                    console.log(err);
                }
            });

        });
    </script>

</body>

</html>