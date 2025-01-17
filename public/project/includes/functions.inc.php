<?php
require('dbh.inc.php');

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
    $result = null;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputProfile($name, $email, $username) {
    $result = null;
    if (empty($name) || empty($email) || empty($username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// function emptyInputAddProduct($productname, $productprice, $productdescription) {
//     $result = null;
//     if (empty($name) || empty($email) || empty($username)) {
//         $result = true;
//     }
//     else {
//         $result = false;
//     }
//     return $result;
// }

function invalidUid($username) {
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result= null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
    $result = null;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function usernameoremailExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function usernameExists($conn, $username) {
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function usernameExistsProfile($conn, $username, $userid) {
    $sql = "SELECT * FROM users WHERE usersUid = ? AND NOT usersId='" .$userid. "' ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function emailExistsProfile($conn, $email, $userid) {
    $sql = "SELECT * FROM users WHERE usersEmail = ? AND NOT usersId='" .$userid. "' ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// function invalidImage($profile_image) {
//     $check = getimagesize($profile_image);
//     $image_type = $check[2];

// 	if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
// 	{
// 		return false;
// 	}
//     else if ($check == null) {
// 	    return false;
//     }
//     else {
//         return true;
//     }
// }

function createUser($conn, $name, $email, $username, $pwd, $fileNameNew) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, usersImage) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd, $fileNameNew);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    LoginUser($conn, $username, $pwd);
}


function emptyInputLogin($username, $pwd) {
    $result = null;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function LoginUser($conn, $username, $pwd) {
    $uidExists = usernameoremailExists($conn, $username, $username);
    // $emailExists = emailExists($conn, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["username"] = $uidExists["usersName"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["useremail"] = $uidExists["usersEmail"];
        $_SESSION["ismanager"] = $uidExists["isManager"];
        $_SESSION["userimg"] = $uidExists["usersImage"];
        $_SESSION["userpwd"] = $uidExists["usersPwd"];

        header("location: ../index.php");
        exit();
    }
}

// function LoginUserAfterUpdate($conn, $username, $pwd) {
//     $uidExists = usernameoremailExists($conn, $username, $username);
//     // $emailExists = emailExists($conn, $username);

//     if ($uidExists === false) {
//         header("location: ../login.php?error=wronglogin");
//         exit();
//     }

//     $pwdHashed = $uidExists["usersPwd"];
//     $checkPwd = password_verify($pwd, $pwdHashed);

//     if ($checkPwd === false) {
//         header("location: ../login.php?error=wronglogin");
//         exit();
//     }
//     else if ($checkPwd === true) {
//         session_start();
//         $_SESSION["userid"] = $uidExists["usersId"];
//         $_SESSION["username"] = $uidExists["usersName"];
//         $_SESSION["useruid"] = $uidExists["usersUid"];
//         $_SESSION["useremail"] = $uidExists["usersEmail"];
//         $_SESSION["ismanager"] = $uidExists["isManager"];
//         // $_SESSION["profileimg"] = $uidExists["profileImg"];
//         $_SESSION["userpwd"] = $uidExists["usersPwd"];

//         header("location: ../index.php");
//         exit();
//     }
// }




function showUsers($conn) {
    $sql = "SELECT * FROM users;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../select.php?error=stmtfailed");
        exit();
    }
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['usersEmail'] . "<br>";
        }
    }
}

function emptyInputAddProduct($productname, $productdesc, $price) {
    $result = null;
    if (empty($productname) || empty($productdesc) || empty($price)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidProductName($productname) {
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $productname)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


function productNameExists($conn, $productname) {
    $sql = "SELECT * FROM products WHERE productsName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../add_product.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $productname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function notInt($price) {
    if (is_int($price)) {
        return false;
    }
    else {
        return true;
    }
}


function createProduct($conn, $productname, $price, $adderid, $productdesc, $fileTmpName) {
    $sql = "INSERT INTO products (productsName, productsPrice, productAddedByUserId, productsDescription, productsImage) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../add_product.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $productname, intval($price), intval($adderid), $productdesc, $fileTmpName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../products.php?inf=productcreated");
    exit();
}

function createReview($conn, $reviewname, $stars, $reviewTime, $reviewcontent, $userid, $productid, $fileNameNew) {
    $sql = "INSERT INTO reviews (reviewsName, productsId, reviewsImage, usersId, reviewsContent, stars, reviewsDate) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../products.php?error=test");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssssss",$reviewname,$productid, $fileNameNew,$userid,$reviewcontent,$stars, $reviewTime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../product.php?id=' . $productid . '");
    exit();
}


function updateUser($conn, $name, $email, $username, $userid, $pwdHashed, $fileName, $fileTmpName, $fileSize, $fileError, $fileDelete) {
    require('dbh.inc.php');
    // $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end(explode('.', $fileName)));
    $allowed = array('jpg','jpeg','png','pdf');
    
    if ($fileDelete) {
        $fileNameNew = null;
        $sql = "UPDATE users SET usersName='" . $name . "',usersEmail='" . $email . "',usersUid='" . $username . "',usersImage='" . $fileNameNew . "' WHERE usersId='" .$userid. "' ";
        mysqli_query($conn, $sql);
    }
    else if ($fileDelete!=true) {
        if ($fileSize!=0) {
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 2000000) {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = '../profileimg/'.$fileNameNew;
                        move_uploaded_file($fileTmpName,$fileDestination);
                        $sql = "UPDATE users SET usersName='" . $name . "',usersEmail='" . $email . "',usersUid='" . $username . "',usersImage='" . $fileNameNew . "' WHERE usersId='" .$userid. "' ";
                        mysqli_query($conn, $sql);
                    }
                    else {
                        header("location: ../profile.php?error=imgtoobig");
                        exit();
                    }
                }
                else {
                    header("location: ../profile.php?error=unknown");
                    exit();
                }
            }
            else {
                echo 'you cannot upload this file';
                header("location: ../profile.php?error=typeunaccept");
                exit();
            }
        }
        else {
            $sql = "UPDATE users SET usersName='" . $name . "',usersEmail='" . $email . "',usersUid='" . $username . "' WHERE usersId='" .$userid. "' ";
            mysqli_query($conn, $sql);
        }
    }
    $emailExists = emailExists($conn, $email);
    $pwdHashedP = $emailExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($pwdHashed == $pwdHashedP) {
        session_start();
        $_SESSION["userid"] = $emailExists["usersId"];
        $_SESSION["username"] = $emailExists["usersName"];
        $_SESSION["useruid"] = $emailExists["usersUid"];
        $_SESSION["useremail"] = $emailExists["usersEmail"];
        $_SESSION["ismanager"] = $emailExists["isManager"];
        $_SESSION["userpwd"] = $emailExists["usersPwd"];
        $_SESSION["userimg"] = $emailExists["usersImage"];

        header("location: ../profile.php?inf=profilechanged");
        exit();
    }
    else {
        header("location: ../profile.php?error=wronglogin");
        exit();
    }
}

function updateProduct2($conn, $productname, $productprice, $productdescription,$productquantity, $productid,$fileName, $fileTmpName, $fileSize, $fileError, $fileDelete) {
    require('dbh.inc.php');
    // $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end(explode('.', $fileName)));
    $allowed = array('jpg','jpeg','png','pdf');
    if ($fileDelete) {
        $fileNameNew = null;
        $sql = "UPDATE products SET productsName='" . $productname . "',productsPrice='" . $productprice . "',productsDescription='" . $productdescription . "',productsQuantity='" . $productquantity . "', productsImage='" . $fileNameNew . "' WHERE productsId='" .$productid. "' ";
        mysqli_query($conn, $sql);
        header("location: ../product.php?id=' . $productid . '");
    }
    else if ($fileDelete!=true) {
        if ($fileSize!=0) {
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 2000000) {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = '../productimg/'.$fileNameNew;
                        move_uploaded_file($fileTmpName,$fileDestination);
                        $sql = "UPDATE products SET productsName='" . $productname . "',productsPrice='" . $productprice . "',productsDescription='" . $productdescription . "',productsQuantity='" . $productquantity . "',productsImage='" . $fileNameNew . "' WHERE productsId='" .$productid. "' ";
                        mysqli_query($conn, $sql);
                        header("location: ../product.php?id=' . $productid . '");

                    }
                    else {
                        header("location: ../product.php?id=' . $productid . '?error=imgtoobig");
                        exit();
                    }
                }
                else {
                    header("location: ../product.php?id=' . $productid . '?error=unknown");
                    exit();
                }
            }
            else {
                echo 'you cannot upload this file';
                header("location: ../product.php?id=' . $productid . '?error=typeunaccept");
                exit();
            }
        }
        else {
            $sql = "UPDATE products SET productsName='" . $productname . "',productsPrice='" . $productprice . "',productsDescription='" . $productdescription . "', productsQuantity='" . $productquantity . "' WHERE productsId='" .$productid. "' ";
            mysqli_query($conn, $sql);
            header("location: ../product.php?id=' . $productid . '");
        }
    }
}


function updateProduct($conn,$productid, $productname, $productprice, $productdescription, $file) {
    require('dbh.inc.php');
    $sql = "UPDATE products SET productsName='" . $productname . "',productsPrice='" . $productprice . "',productsDescription='" . $productdescription . "' WHERE productsId='" .$productid. "' ";
    mysqli_query($conn, $sql);
    

    // $uidExists = usernameoremailExists($conn, $username, $email);
    $emailExists = emailExists($conn, $email);
    $pwdHashed = $emailExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($pwdHashed == $pwdHashedP) {
        session_start();
        $_SESSION["userid"] = $emailExists["usersId"];
        $_SESSION["username"] = $emailExists["usersName"];
        $_SESSION["useruid"] = $emailExists["usersUid"];
        $_SESSION["useremail"] = $emailExists["usersEmail"];
        $_SESSION["ismanager"] = $emailExists["isManager"];
        $_SESSION["userpwd"] = $emailExists["usersPwd"];
        $_SESSION["userimg"] = $emailExists["usersImage"];

        header("location: ../profile.php?succes=profilechanged");
        exit();
    }
    else {
        header("location: ../profile.php?error=wronglogin");
        exit();
    }

    // header("location: ../profile.php");
    // exit();
}


function deleteProduct($conn, $deleted_product) {
    require('dbh.inc.php');
    $sql = "DELETE FROM products WHERE productsName='" .$deleted_product. "';";
    mysqli_query($conn, $sql);
}
function deleteFromSC($conn, $cartid) {
    require('dbh.inc.php');
    $sql = "DELETE FROM shopping_cart WHERE cartId='" .$cartid. "';";
    mysqli_query($conn, $sql);
}

function isBoss() {
    if ( !( $_SESSION['useremail'] === 'christiaan.vlas@gmail.com' ) || !( $_SESSION['useremail'] === 'stef.delnoye@gmail.com' ) ) {
        return false;
    }
    else {
        return true;
    }
}

function deleteEmployee($conn, $deleted_employee) {
    require('dbh.inc.php');
    $sql = "UPDATE users SET isManager = 0 WHERE usersEmail='" .$deleted_employee. "';";
    mysqli_query($conn, $sql);   
}

function addEmployee($conn, $deleted_employee) {
    require('dbh.inc.php');
    $sql = "UPDATE users SET isManager = 1 WHERE usersEmail='" .$deleted_employee. "';";
    mysqli_query($conn, $sql);   
}

function productName($conn, $productId) {
    $sql = "SELECT * FROM products WHERE productsId = '" .$productId. "';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: products.php?error=stmtfailed");
        exit();
    }
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "<br>". $row['productsName'] . "<br>";
            $productname = $row['productsName'];
        }
    }
    return $productname;

}

function returnEmail($conn, $userid) {
    $sql = "SELECT * FROM users WHERE usersId = '" .$userid. "';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: products.php?error=stmtfailed");
        exit();
    }
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row["usersEmail"];
        }
    }
}

function countLikesReview($conn, $reviewid) {
    $sql = "SELECT * FROM likereview WHERE reviewsId = '" .$reviewid. "'";

    if ($result=mysqli_query($conn,$sql)) {
        $rowcount=mysqli_num_rows($result);
        return $rowcount; 
    }
}

function likeReview($conn, $reviewid, $userid, $productid) {
    $sql = "INSERT INTO likereview (reviewsId, usersId) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../products.php?error=likestmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $reviewid, $userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../product.php?id=".$productid);
    exit();
}

function unLikeReview($conn, $reviewid, $userid, $productid) {
    $sql = "DELETE FROM likereview WHERE reviewsId='" .$reviewid. "' AND usersId='" .$userid. "';";
    mysqli_query($conn, $sql);
    header("location: ../product.php?id=".$productid);
    exit();
}

function isLiked($conn, $reviewid, $userid) {
    $sql = "SELECT * FROM likereview WHERE usersId = ? AND reviewsId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../products.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $userid, $reviewid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return true;
    }
    else {
        return false;
    }
    mysqli_stmt_close($stmt);
}


function addToShoppingCart($conn, $userid, $productid, $productq) {
    $sql = "SELECT * FROM shopping_cart WHERE usersId = ? AND productsId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../products.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $userid, $productid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        $newq = $row["productQ"] + $productq;
        $sql = "UPDATE shopping_cart SET productQ='" . $newq  . "' WHERE cartId='" .$row["cartId"]. "' ";
        mysqli_query($conn, $sql);
        header("location: ../products.php?inf=productadded");
        exit();

    }
    else {
        $sql = "INSERT INTO shopping_cart (usersId, productsId, productQ) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../product.php?id=' . $productid . '");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $userid, $productid, $productq);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../products.php?inf=productadded");
        exit();
    }
}

function countProducts($conn, $userid) {
    // $sql = "SELECT * FROM shopping_cart WHERE usersId = '" .$userid. "'";

    // if ($result=mysqli_query($conn,$sql)) {
    //     $rowcount=mysqli_num_rows($result);
    //     return $rowcount; 
    // }

    $sql = "SELECT SUM(productQ) FROM shopping_cart where usersId='".$userid."';";
    $result = mysqli_query($conn, $sql);
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: products.php?error=stmtfailed");
        exit();
    }
    while($row = mysqli_fetch_array($result)){
        $countproduct = $row['SUM(productQ)'];
    }
    return $countproduct;
}

function countPrice($conn, $userid) {
    $sql2 = "SELECT * FROM shopping_cart WHERE usersId = '" .$userid. "'";
    // $sql = "SELECT price, COUNT(*) FROM employees GROUP BY department_id;";

    // if ($result=mysqli_query($conn,$sql)) {
    //     $rowcount=mysqli_num_rows($result);
    //     return $rowcount; 
    // }
}

function idToPrice($conn, $productid) {
    $sql = "SELECT * FROM products WHERE productsId = '" .$productid. "';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: products.php?error=stmtfailed");
        // change later!!!
        exit();
    }
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $price = $row['productsPrice'];
            return $price;
        }
    }
}