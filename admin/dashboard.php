<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png" type="image/png">
    <title>IFJR - DashBoard</title>
    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat';
    }
    </style>
</head>

<body>

    <?php
  session_start();

  if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header("Location: ../login.php");
    exit();
  }
  include 'panel.php'; ?>
    <div class="dashboard-main">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="dashboard-title-text">
                        <h2>Dashboard</h2>
                        <p class="text-grey">Vous pouvez ici retrouver la liste totale chiffrée des formations ainsi que
                            des utilisateurs enregistrés / ayant fait une demande de contact.</p>
                    </div>
                    <button type="button" class="fs-18 text-grey-blue">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                </div>
            </div>

            <div class="overview-section p-4">
                <div class="row overview-section-title">
                    <h4>Nombres d'utilisateurs</h4>
                    <p class="small text-grey">Graphiques du nombre d'utilisateurs</p>
                </div>

                <div class="row">
                    <div class="col-8">
                        <canvas id="formation-chart"></canvas>
                    </div>
                    <div class="col-4">
                        <h5>Nombre de formations</h5>
                        <h2 id="formation-count">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-Ky7IQ7mgHCQ01k0cFQDb8V87Wwj9f51G1bmPc6fVTeIKUuFEIvZ2tMq8P0pdwTzv" crossorigin="anonymous">
    </script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1"></script>

    <script>
    var chart;

    $(document).ready(function() {
        function countFormations() {
            $.ajax({
                url: "count_formations.php",
                method: "GET",
                success: function(response) {
                    var formationsCountData = parseInt(response);

                    $("#formation-count").text(formationsCountData);

                    chart.data.datasets[0].data.push(formationsCountData);

                    var currentDate = new Date();
                    var currentMonth = currentDate.getMonth();
                    var currentYear = currentDate.getFullYear();
                    var months = [];
                    for (var i = 5; i >= 0; i--) {
                        var month = currentMonth - i;
                        var year = currentYear;
                        if (month < 0) {
                            month = 12 + month;
                            year -= 1;
                        }
                        var label = getMonthLabel(month) + ' ' + year;
                        months.push(label);
                    }
                    chart.data.labels = months;

                    chart.update();
                },
                error: function() {
                    console.log("Erreur lors de la requête AJAX pour récupérer les données.");
                }
            });
        }

        function getMonthLabel(month) {
            var monthNames = [
                "Jan", "Fév", "Mar", "Avr", "Mai", "Juin",
                "Juil", "Août", "Sep", "Oct", "Nov", "Déc"
            ];
            return monthNames[month];
        }

        var ctx = document.getElementById('formation-chart').getContext('2d');
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [], 
                datasets: [{
                    label: 'Formations créées',
                    data: [],
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        setInterval(function() {
            countFormations();
        }, 5000);

        countFormations();
    });
    </script>

</body>

</html>