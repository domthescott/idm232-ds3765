<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>hwk03</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@400;700&display=swap" rel="stylesheet">

  <link href="stylesheet.css" rel="stylesheet">
</head>

<?php

$servername = "mysql.domthescott.tech";
$username = "domthescott";
$password = "Gemma1211!";
$dbname = "domthescottcookbook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo '<!DOCTYPE html>';
echo '<html>';

// Omitted head section as it typically remains constant across pages

echo '<body>';

echo '<div id="navbar"><h5>FoodFind   </h5></div>';
echo '<div class="backdiv">';
echo '    <a href="" class="back">Back</a>';
echo '</div>';

echo '<div class="recipecontentholder">';
echo '<div class="recipecontenttop">';

echo '    <div class="nameandimage">';
echo '        <img class="recipeimage" src="images/0101_2PV1_Broccoli-Bucatini-Fettucine_18403_WEB_high_feature.jpg">';
echo '        <div class="recipenameandingredients">';

$sql = "SELECT Title FROM recipes WHERE id = 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<h2 class="recipename">' . $row["Title"] . '</h2>';
    }
} else {
    echo "0 results";
}

$sqlDescription = "SELECT Description FROM recipes WHERE id = 2";
$resultDescription = $conn->query($sqlDescription);

// Check if there is a result
if ($resultDescription->num_rows > 0) {
    // Fetch the data and output it
    while ($row = $resultDescription->fetch_assoc()) {
        echo '<p>' . $row["Description"] . '</p>';
    }
} else {
    echo "No description found for id 2";
}

echo '        </div>';
echo '    </div>';

echo '    <div class="ingredients">';
echo '        <img id= "ingredientimagelist" src="Images/0101_ING_FPP_large_feature.webp">';
echo '        <div>';
echo '        <h3 class="ingredientstitle">';
echo '            Ingredients';
echo '        </h3>';

$sqlIngredients = "SELECT `All Ingredients` FROM recipes WHERE id = 2";
$resultIngredients = $conn->query($sqlIngredients);

// Check if there is a result
if ($resultIngredients->num_rows > 0) {
    // Fetch the data
    $rowIngredients = $resultIngredients->fetch_assoc();

    // Split ingredients by *
    $ingredientsArray = explode('*', $rowIngredients['All Ingredients']);

    // Output each ingredient with a bullet point and line break
    echo '<ul>';
    foreach ($ingredientsArray as $ingredient) {
        echo '<li>' . trim($ingredient) . '</li>';
    }
    echo '</ul>';
} else {
    echo "No ingredients found for id 2";
}




echo '    </div>';
echo '    </div>';
echo ' </div>';

echo ' <div class="recipecontentbottom">';
echo '   <div class="stepscontainer">';
echo '    <h2 class="stepsheader">Steps</h2>';

$sqlImageSources = "SELECT `Step IMGs` FROM recipes WHERE id = 2";
$resultImageSources = $conn->query($sqlImageSources);

$sqlSteps = "SELECT `All Steps` FROM recipes WHERE id = 2";
$resultSteps = $conn->query($sqlSteps);

// Check for errors
if ($resultImageSources === false || $resultSteps === false) {
    echo "Error in the query: " . $conn->error;
} else {
    // Fetch the data
    $rowImageSources = $resultImageSources->fetch_assoc();
    $rowSteps = $resultSteps->fetch_assoc();

    // Explode image sources and steps by *
    $imageSourcesArray = explode('*', $rowImageSources["Step IMGs"]);
    $stepsArray = explode('*', $rowSteps['All Steps']);

    // Determine the maximum count to loop through both arrays
    $maxCount = max(count($imageSourcesArray), count($stepsArray));

    // Output <img> and <p> elements in alternating fashion
    for ($i = 0; $i < $maxCount; $i++) {
        // Output <p> element if there is a corresponding step
        if (isset($stepsArray[$i])) {
            echo '<p class="steps">' . $stepsArray[$i] . '</p>';
        }

        // Output <img> element if there is a corresponding image source
        if (isset($imageSourcesArray[$i])) {
            echo '<img src="images/' . $imageSourcesArray[$i] . '" alt="Step Image" class="step"><br>';
        }
    }
}







// Repeat the process for each step...

echo '    </div>';
echo ' </div>';

echo '</div>';

echo '<footer>';
echo '    <div class="footer-container">';
echo '        <div class="footer-left">';
echo '            FoodFind - Dominic Scott';
echo '        </div>';
echo '        <div class="footer-right">';
echo '            IDM 232 - Assignment 3';
echo '        </div>';
echo '    </div>';
echo '</footer>';

echo '</body>';
echo '</html>';
$conn->close();
?>