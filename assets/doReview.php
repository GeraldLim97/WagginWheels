<?php 
if ($_POST['submit']=='Submit Review!'){
    $testimony = filter_var($_POST['testimonial'], FILTER_SANITIZE_SPECIAL_CHARS);
    $rating = preg_replace("([^0-5])", "", $_POST['rating']);;
    $userid = $_SESSION['id']??0;
    try {
        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO reviews (testimony, rating, userid) VALUES (:testimony, :rating, :userid);");
        // Bind the parameter values
        $stmt->bindParam(':testimony', $testimony);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $alertMsg = "Review Submitted";
        $alertLevel = 1;
    } catch (PDOException $e) {
        $alertLevel = 2;
        $alertMsg = "An error has occured, try again later!";
    }
}
?>