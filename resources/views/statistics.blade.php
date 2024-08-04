@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Note:</strong> Ces statistiques consomment des API pour récupérer les données.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <h1 class="text-center">Statistiques des Tâches</h1>
        <div class="row">
            <div class="col-md-4">
                <canvas id="dailyChart"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="weeklyChart"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Récupérer les données via les API
            fetch('/api/statistics/daily')
                .then(response => response.json())
                .then(data => {
                    // Créer le graphique quotidien
                    new Chart(document.getElementById('dailyChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Total Tâches', 'Tâches Complètes'],
                            datasets: [{
                                label: 'Statistiques Quotidiennes',
                                data: [data.total_tasks, data.completed_tasks],
                                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });

            fetch('/api/statistics/weekly')
                .then(response => response.json())
                .then(data => {
                    // Créer le graphique hebdomadaire
                    new Chart(document.getElementById('weeklyChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Total Tâches', 'Tâches Complètes'],
                            datasets: [{
                                label: 'Statistiques Hebdomadaires',
                                data: [data.total_tasks, data.completed_tasks],
                                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });

            fetch('/api/statistics/monthly')
                .then(response => response.json())
                .then(data => {
                    // Créer le graphique mensuel
                    new Chart(document.getElementById('monthlyChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Total Tâches', 'Tâches Complètes'],
                            datasets: [{
                                label: 'Statistiques Mensuelles',
                                data: [data.total_tasks, data.completed_tasks],
                                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
@endsection
