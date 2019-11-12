<?php
if ($_POST['password'] == "TUCHNenuOppukonu2979" && $_POST['uniq'] == 'stuMagzUberChallenge' && move_uploaded_file($_FILES["tripsFile"]["tmp_name"], "trips.csv")) {
echo "The file ". basename( $_FILES["tripsFile"]["name"]). " has been uploaded.";
} else {
echo "Sorry, there was an error uploading your file.";
}
?>