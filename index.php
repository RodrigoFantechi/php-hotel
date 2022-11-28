<?php


$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

$array = $hotels;

if (isset($_GET['parking'])) {
    $array = checkHotelWithParking( $_GET['parking'], $_GET['rate'], $hotels);
}

function checkHotelWithParking($park, $rate, $hotels){
    
    $newArray = [];
    if ($park == 'si') {
        $park = true;
    } else {
        $park = false;
    }
    foreach ($hotels as $hotel) {
        if ($hotel['parking'] == $park && $hotel['vote'] >= $rate) {
            array_push($newArray, $hotel);
        }
    }
    return $newArray;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>

    <div class="container d-flex flex-column align-items-center justify-content-center pt-5">
        <?php if (empty($_GET['parking'])) : ?>
            <h4>selezionare opzione parcheggio</h4>
        <?php endif ?>
        <form action="index.php" method="get" class="my-5 d-flex flex-column align-items-center">
            <div class="mb-3">
                <label for="parking" class="form-label">Parking</label>
                <select class="form-select form-select-lg" name="parking" id="parking">
                    <option selected disabled='disabled'>Tutti</option>
                    <option value="si">Parking SI</option>
                    <option value="no">Parking NO</option>
                </select>
            </div>
            <div class="mb-3 d-flex align-items-center ">
                <label for="rate" class="form-label mb-0">Rate</label>
                <input type="range"  class="mx-2" name="rate" id="rate" value="1" min="1" max="5" oninput="this.nextElementSibling.value = this.value">
                <output>1</output>
            </div>
            <div class="button d-flex gap-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            </div>

        </form>
        <table>
            <thead>
                <tr>
                    <?php foreach ($hotels[0] as $key => $hotel) { ?>
                        <th class="p-3"> <?= $key ?> </th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($array as $key => $hotel) { ?>
                    <tr>
                        <?php foreach ($hotel as $key => $element) { ?>
                            <?php if ($key == 'parking' && $element == true) {
                                $element = 'si';
                            } elseif ($key == 'parking' && $element == false) {
                                $element = 'no';
                            }
                            ?>
                            <td class="p-3"> <?= $element ?> </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>