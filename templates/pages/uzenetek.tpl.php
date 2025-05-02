<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center activity">
                <div><i class="fa fa-envelope-o"></i><span class="ml-2">Beérkezett Üzenetek</span></div>
                <div><span class="activity-done"> (<?php
    $host = 'localhost';
    $dbname = 'receptek'; 
    $username = 'root';     
    $password = '';

                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $pdo->query("SELECT COUNT(*) FROM kapcsolat");
                        $messageCount = $stmt->fetchColumn();
                        echo $messageCount;
                        $pdo = null;
                    } catch (PDOException $e) {
                        echo "Hiba";
                    }
                    ?>)</span></div>
                <div class="icons"><i class="fa fa-search"></i><i class="fa fa-ellipsis-h"></i></div>
            </div>
            <div class="mt-3">
                <ul class="list list-inline">
                    <?php

                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT nev, email, szoveg FROM kapcsolat ORDER BY nev ASC";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($results) {
                            foreach ($results as $row) {
                                echo '<li class="d-flex justify-content-between">';
                                echo '<div class="d-flex flex-row align-items-center"><i class="fa fa-user checkicon"></i>';
                                echo '<div class="ml-2">';
                                echo '<h6 class="mb-0">' . htmlspecialchars($row['nev']) . '</h6>';
                                echo '<div class="d-flex flex-row mt-1 text-black-50 date-time">';
                                echo '<div><i class="fa fa-envelope-o"></i><span class="ml-2">' . htmlspecialchars($row['email']) . '</span></div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div><span class="text-black-50">' . htmlspecialchars($row['szoveg']) . '</span></div>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="text-center">Nincsenek beérkezett üzenetek.</li>';
                        }

                        $pdo = null;

                    } catch (PDOException $e) {
                        echo '<li class="text-center text-danger">Database error: ' . htmlspecialchars($e->getMessage()) . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>