<?php
require_once "./paths.php";

$get_data = select_data("squad", '*', '', '', $conn);

$sql = "SELECT p.id as squad_id, p.name, p.jersey_no, p.type, s.* FROM `score_board` s LEFT JOIN squad p ON p.id = s.squad_id ORDER BY s.orders ASC ";
$get_score  = query($sql, $conn);
$score_data = mysqli_fetch_all($get_score, MYSQLI_ASSOC);

function rand_color()
{
    return sprintf('#%04X', mt_rand(0, 0xFFFFFF));
}


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
    <h4 class="m-3 text-center">Playing X1</h4>

    <div class="container-fluid">
        <div class="row justiy-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <canvas id="chart-pie-stats" width="600" height="400"></canvas>
                </div>
            </div>
            <div class="col-lg-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jursey No.</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        /**
                         * This block of core will help me to print table data &
                         * also i will use this to prepare data whic required in chart js
                         * It will save addtional loop and efficiency
                         */
                        if (!empty($score_data)) {
                            $count = count($score_data);
                            for ($i = 0; $i < $count; $i++) {
                                $lables[] = '"' .  ucfirst($score_data[$i]['name']) . '"';
                                $rand_color[] = '"' .   rand_color() . '"';
                                $stat_data[] = $score_data[$i]['score'];

                        ?>
                                <tr>
                                    <td><?= $score_data[$i]['jersey_no'] ?></td>
                                    <td><?= $score_data[$i]['name'] ?></td>
                                    <td><?= $score_data[$i]['type'] ?></td>
                                    <td><?= $score_data[$i]['score'] ?></td>
                                </tr>

                        <?php }
                        } ?>
                    </tbody>
                </table>
                <a href="<?= base_url('index.php') ?>" class="btn btn-sm btn-info mx-1">Back</a>

            </div>
        </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        var oilCanvas = document.getElementById("chart-pie-stats");

        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 16;

        var oilData = {
            labels: [
                <?= implode(",", $lables) ?>
            ],
            datasets: [{
                data: [<?= implode(",", $stat_data) ?>],
                backgroundColor: [
                    <?= implode(",", $rand_color) ?>

                ]
            }]
        };

        var pieChart = new Chart(oilCanvas, {
            type: 'doughnut',
            data: oilData
        });
    </script>

</body>

</html>