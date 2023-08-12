<?php
$dbInfo = json_decode(file_get_contents(__DIR__ .'/db.json'),true)['db'];
$servername = $dbInfo["servername"];
$username = $dbInfo["username"];
$password =  $dbInfo["password"];
$dbname = $dbInfo["name"];
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$createAccount = function ($username, $password, $email, $phone) use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO users (username, password, name, email, phone) 
        VALUES (:username, :password, :name, :email, :phone)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        echo "New records created successfully";
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
};
$checkUsernameAvailabilty = function ($username) use ($conn) {
    //returns true if name is already taken
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT COUNT(u.username) AS num FROM users u WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return (bool)$stmt->fetchAll(PDO::FETCH_ASSOC)[0]["num"];
    } catch (PDOException $e) {
    }
};
$register = function ($username, $password, $name, $email, $phone) use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO users (username, password, name, email, phone) 
        VALUES (:username, :password, :name, :email, :phone)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
};
$login = function ($username, $password) use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT u.password,u.id FROM users u WHERE u.username = :username AND u.deactivate = '0';");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 1) { //only want one result
            return (password_verify($password, $result[0]['password']) ? $result[0]['id'] : false);
        }
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
};
$getUser = function ($id) use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT u.id,u.username, u.name, u.pfp, u.role, u.email, u.phone FROM users u WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC)['0'];
    } catch (PDOException $e) {
        return false;
    }
};
$reviewSnippets = function () use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT r.rating, r.testimony, CASE WHEN r.userid = 0 THEN 'anonymous' ELSE u.username END AS username FROM `reviews` r LEFT JOIN `users` u ON r.userid = u.id ORDER BY rating DESC LIMIT 6;");
        $result = $stmt->execute();
        if ($result) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
};
$reviews = function ($rating = 5) use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT r.rating, r.testimony, CASE WHEN r.userid = 0 THEN 'anonymous' ELSE u.username END AS username, CASE WHEN r.userid = 0 THEN NULL ELSE u.pfp END AS pfp FROM `reviews` r LEFT JOIN `users` u ON r.userid = u.id  WHERE r.rating <= :rating ORDER BY rating DESC;");
        $stmt->bindParam(':rating', $rating);
        $result = $stmt->execute();
        if ($result) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
};
$usernames = function () use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("select id, username from users");
        $result = $stmt->execute();
        if ($result) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
};
$booking = function ($breed, $weight, $date, $time, $name, $size, $neutered, $userid) use ($conn) {
    try {
        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO bookings (breed, weight, date, time, name, size, neutered, userid) VALUES (:breed, :weight, :date, :time, :name, :size, :neutered, :userid)");
        // Bind the parameter values
        $stmt->bindParam(':breed', $breed);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':neutered', $neutered);
        $stmt->bindParam(':userid', $userid);
        return (bool)$stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
};
$dashboardItems = function () use ($conn) {
    try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT b.id, b.breed, b.weight, b.date, b.time, b.name as pet_name, b.size, b.neutered, b.userid, b.fulfilled,
            u.username, u.name AS user_name, u.email, u.phone
            FROM bookings b INNER JOIN users u ON b.userid = u.id
            ORDER BY 
                CASE
                    WHEN b.date > CURDATE() THEN 0
                    WHEN b.date = CURDATE() THEN
                        CASE
                            WHEN b.time > CURTIME() THEN 0
                            ELSE 1
                        END
                    ELSE 1
                END ASC, b.date ASC, b.time ASC;");
        $result = $stmt->execute();
        if ($result) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
};
function sqlclose(&$conn)
{
    $conn = null;
}
