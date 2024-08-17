<?php 

session_start();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Note Taking App</title>
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #3a7bd5;
            --background-color: #f5f7fa;
            --text-color: #333;
            --card-color: #ffffff;
            --border-color: #e1e4e8;
            --delete-color: #e74c3c;
            --edit-color: #2ecc71;
            --logout-color: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: var(--card-color);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .username {
            font-weight: bold;
            color: var(--primary-color);
        }

        .logout-btn {
            background-color: var(--logout-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #e67e22;
        }

        .note-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }

        .note-title, .note-content, .note-image-url, .note-code {
            font-size: 1rem;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        .note-title:focus, .note-content:focus, .note-image-url:focus, .note-code:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .note-content, .note-code {
            resize: vertical;
            min-height: 100px;
        }

        .note-code {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f4f4f4;
        }

        .save-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .save-btn:hover {
            background-color: var(--secondary-color);
        }

        .notes-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .note {
            background-color: var(--card-color);
            border: 1px solid var(--border-color);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .note:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .note h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
            padding-right: 60px;
        }

        .note p {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .note img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .note pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
            font-size: 0.9rem;
        }

        .note-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }

        .edit-btn, .delete-btn {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .edit-btn {
            color: var(--edit-color);
        }

        .delete-btn {
            color: var(--delete-color);
        }

        .edit-btn:hover, .delete-btn:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>


    <div class="container">
        <div class="header">
            <h1>Note Taking App</h1>
            <div class="user-info">
                <span class="username">Welcome,<?php echo $_SESSION['username'] ?></span>
            </div>
        </div>
        <form class="note-form" method="post">
            <input type="text" class="note-title" placeholder="Note Title"  name="title">
            <textarea class="note-content" placeholder="Write your note here..."  name="notesbody"></textarea>
            <input type="url" class="note-image-url" placeholder="Image URL (optional)" name="img">
            <button type="submit" class="save-btn" name="update-btn">Update Note</button>
        </form>
        <div class="notes-list">

        </div>
    </div>

</body>
</html>


<?php 

if(isset($_POST['update-btn'])){
    $title=$_POST['title'];
    $notesbody=$_POST['notesbody'];
    $img=$_POST['img'];


    $username=$_SESSION['username'];
    $tablename=$username."_notes";
    $id= $_GET['id']; 

    $conn=mysqli_connect('localhost','root','','mynotesapp');

    $sql1="UPDATE `$tablename`
    SET `title`='$title' WHERE `id`=$id";

    $sql2="UPDATE `$tablename`
    SET `note_body`='$notesbody' WHERE `id`=$id";

    $sql3="UPDATE `$tablename`
    SET `image`='$img' WHERE `id`=$id";



    // echo $title;
    // var_dump($title);
    // var_dump(empty($title));
    // var_dump($_POST);


    if(!empty($title)){
        mysqli_query($conn,$sql1);
    }

    if(!empty($notesbody)){
        mysqli_query($conn,$sql2);
    }

    if(!empty($img)){
        mysqli_query($conn,$sql3);
    }



    echo '<script> location.replace("http://localhost/Nots_app/notes.php")</script>';
    // http://localhost/Nots_app/notes.php







}












?>